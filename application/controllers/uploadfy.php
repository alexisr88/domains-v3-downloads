<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadfy extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('slugify');
		$this->load->model('templates_model','Templates');
		$this->load->model('programs_model','Programs');	
	}
	
	public function do_template_upload($id_domain,$folder_name,$program_name)
	{
		$this->load->model('domains_model','Domains');
		
		if(False !== $id_domain)
			$this->Domains->id = $id_domain;
		
		$domains = (False !== $id_domain) ? $this->Domains->get_id() : $this->Domains;
		
		$folder_name = slugify(urldecode($folder_name));
		$base_upload = "./uploads/templates/{$domains->id}/{$folder_name}/";
		
		$extension = explode('.',$_FILES['userfile']['name']);
		$extension = $extension[count($extension)-1];
		
		$folder['images'] 	= array('gif','jpg','jpeg','png','swf');
		$folder['js'] 		= array('js');
		$folder['css'] 		= array('css');
		$folder['index'] 		= array('php','icon');
		
		foreach($folder as $type => $mimes):
			if(in_array($extension,$mimes)) { 
				if($type != 'index')
					$upload_path = "./uploads/templates/{$domains->id}/{$folder_name}/$type";
				if($type == 'index')
					$upload_path = "./uploads/templates/{$domains->id}/{$folder_name}/";
		}
		endforeach;		
					
		$config['upload_path'] 		= $upload_path;
		$config['allowed_types'] 	= '*';
		$config['max_size']			= '60000';
		
		if(False === is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'], 0777, True);
			chmod($config['upload_path'], 0777);
		}
	
		$this->load->library('upload', $config);
	
		if (!$this->upload->do_upload())
		{
			$data['status'] = 'fail';
			$data['errors'] = $this->upload->display_errors();
			
			var_dump($this->upload->display_errors());
		}
		else
		{
			$file_data = $this->upload->data();	
					
			$template_name = "$id_domain-$folder_name-".uniqid();
			
			$program = $this->Programs->get_by_name(urldecode($program_name));
			
			$this->Templates->id_domain  = $id_domain;
			$this->Templates->id_program = $program->id;
			$this->Templates->path = $base_upload;
			$this->Templates->name = $template_name;
			
			$this->Templates->save();
			echo "1";
		}
	
	
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