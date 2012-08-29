<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadfy extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
	}
		
	public function do_upload($id_program)
	{	
		$this->load->model('icons_model','Icons');
		
		$config['upload_path'] 		= './uploads/'.$id_program;
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '2000';
		$config['overwrite']		= True;
		
		if(False === is_dir($config['upload_path'])) 
		{ 
			mkdir($config['upload_path'], 0777);
			chmod($config['upload_path'], 0777);
		}
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload())
		{
			echo $this->upload->display_errors();
		}
		else
		{
			/*
			 * get file data, rename and set permisions
			 */
			$file_data 	= $this->upload->data();
			$new_name 	= $file_data['file_path'] . $file_data['raw_name'] . $file_data['file_ext'];
			
			rename($file_data['full_path'], $new_name);
			chmod ($new_name, 0777);
			
			$config['image_library'] 	= 'gd2';
			$config['source_image']		= $new_name;
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']	 		= 250;
			$config['height']			= 100;
			
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			
			/*
			 * save screenshots
			 */
			$this->Icons->name 			= $file_data['file_name'];
			$this->Icons->slug 			= $file_data['raw_name'];
			$this->Icons->id_program 	= $id_program;
			$this->Icons->is_main		= False;
			$this->Icons->ext 			= $file_data['file_ext'];
			$this->Icons->width 		= $file_data['image_width'];
			$this->Icons->height 		= $file_data['image_height'];
			$this->Icons->size 			= $file_data['file_size'];
			$this->Icons->type 			= 'ss';
			$this->Icons->thumb 		= $file_data['raw_name'] . '_thumb' . $file_data['file_ext'];
			$this->Icons->save();
			
			echo '1';
		}	
	}
	
}