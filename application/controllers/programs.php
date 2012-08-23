<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programs extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('tooltip', 'spanish');
		$this->lang->load('form_results', 'spanish');
		$this->load->model('countries_model','Countries');
		$this->load->model('languages_model','Languages');
		$this->load->model('programs_model','Programs');
		$this->load->model('licenses_model','Licenses');
		$this->load->model('categories_model','Categories');
	}
	
	public function view()
	{
		$this->load->helper('text');
		
		$data = array(
			'programs' => $this->Programs->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('programs/view',$data);
		$this->load->view('footer');		
	}
	
	public function _render_form($id_program = False)
	{
		if(False !== $id_program)
			$this->Programs->id = $id_program;
		
		$program = (False !== $id_program) ? $this->Programs->get_id() : $this->Programs;
		
		$license_list 		= $this->Licenses->get_for_select();
		$categories_list 	= $this->Categories->get_for_select();
						
		$form  = form_open('programs/save',array('class' => 'well ajax_form', 'id' => 'save-licenses-form'));
		
		if(False !== $id_program)
		{
			$form .= form_hidden('id',$id_program);
			$form .= form_hidden('action_type','update');
		}
		
		$form .= form_hidden('our_valuation',$program->our_valuation);
		
		$form .= open_control();
		$form .= form_label('Name','name');
		$form .= form_input('name',$program->name);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Slug','slug');
		$form .= form_input('slug',$program->slug);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Oficial Site Url','official_site_url');
		$form .= form_input('official_site_url',$program->official_site_url);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Official Download','official_download');
		$form .= form_input('official_download',$program->official_download);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Oficial Contact','official_contact');
		$form .= form_input('official_contact',$program->official_contact);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Download Size','size');
		$form .= form_input('size',$program->size);
		$form .= close_control();

		$form .= open_control();
		$form .= form_label('Our valuation','our_valuation');
		
		$form .= '<div class="ratings-form-program alert alert-alert" id="ratings-options">';
			for($i = 1; $i <= 5; $i++):
				$css_class = ($program->our_valuation >= $i) ? 'icon-star' : 'icon-star-empty';
				$form .= '<i class="set-rate '.$css_class.'" id="star'.$i.'" rel="'.$i.'"></i>';
			endfor;
		$form .= '</div>';
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('License','id_license');
		$form .= form_dropdown('id_license',$license_list,$program->id_license);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Category','id_category');
		$form .= form_dropdown('id_category',$categories_list,$program->id_category);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Color','color');
		$form .= form_input('color',$program->color);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Url Background','url_background');
		$form .= form_input('url_background',$program->url_background);
		$form .= close_control();

		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Save','id' => 'save-licenses'));
		$form .= form_close();
		
		return $form;
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('', '|');
		$this->form_validation->set_rules('name', 'Name{name}', 'required');
		$this->form_validation->set_rules('slug', 'Slug{slug}', 'required');
		$this->form_validation->set_rules('official_site_url', 'Official site url{official_site_url}', 'required');
		$this->form_validation->set_rules('official_download', 'Official Download{official_download}', 'required');
		$this->form_validation->set_rules('size', 'Download Size{size}', 'required');
		$this->form_validation->set_rules('our_valuation', 'Our Valuation{our_valuation}', 'required');
		$this->form_validation->set_rules('id_license', 'License{id_license}', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('id_category', 'Category{id_category}', 'required|is_natural_no_zero');
		
		if ($this->form_validation->run() == FALSE)
		{
			$response = array(
				'status' => 'fail',
				'fileds' => format_error(validation_errors()),
				'message' => str_replace('{count}', count(format_error(validation_errors())), $this->lang->line('form_results_license_fail_save')),
			);
		}
		else
		{
			$response = array(
				'status' => 'win',
				'message' => $this->lang->line('form_results_license_win'),
			);
				
			if(False !== $this->input->post('id'))
				$this->Programs->id = $this->input->post('id');
				
			$this->Programs->name 				= $this->input->post('name');
			$this->Programs->slug 				= $this->input->post('slug');
			$this->Programs->official_site_url 	= $this->input->post('official_site_url');
			$this->Programs->official_download 	= $this->input->post('official_download');
			$this->Programs->official_contact 	= $this->input->post('official_contact');
			$this->Programs->size 				= $this->input->post('size');
			$this->Programs->our_valuation 		= $this->input->post('our_valuation');
			$this->Programs->id_license 		= $this->input->post('id_license');
			$this->Programs->id_category 		= $this->input->post('id_category');
			$this->Programs->color 				= $this->input->post('color');
			$this->Programs->url_background 	= $this->input->post('url_background');
			
			$this->Programs->save();
		}
		
		header('Content-type: application/json');
		echo json_encode($response);
	}
	
	private function _render_upload_icon_form($id_program)
	{
		if(False !== $id_program)
			$this->Programs->id = $id_program;
		
		$program = (False !== $id_program) ? $this->Programs->get_id() : $this->Programs;
		
		$form  = form_open_multipart('programs/do_icon_upload',array('class' => 'well aajax_form', 'id' => 'save-licenses-form'));
		$form .= form_hidden('id',$id_program);
		
		$form .= open_control();
		$form .= form_label('Icon Name','name');
		$form .= form_input('name');
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Slug (url name)','slug');
		$form .= form_input('slug');
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Icon File','userfile');
		$form .= form_upload('userfile');
		$form .= close_control();

		$form .= '<hr />';

		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Save','id' => 'save-licenses'));
		$form .= form_close();
		
		return $form;
		
	}
	
	public function do_icon_upload()
	{
		$this->load->model('icons_model','Icons');
		
		$id_program = $this->input->post('id');
		
		if(False !== $id_program)
			$this->Programs->id = $id_program;
		
		$program = (False !== $id_program) ? $this->Programs->get_id() : $this->Programs;
		
		$config['upload_path'] 		= './uploads/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '2000';
		$config['max_width']  		= '256';
		$config['max_height']  		= '256';
		
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		
		$data = array();
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('slug', 'Slug name', 'required');
		
		if (!$this->upload->do_upload() || $this->form_validation->run() == FALSE)
		{
			$data['status'] = 'fail';
			$data['errors'] = $this->upload->display_errors();
			$data['verrors'] = validation_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$this->load->library('image_lib');
			
			$this->Icons->name 			= $this->input->post('name');
			$this->Icons->slug 			= $this->input->post('slug');
			$this->Icons->id_program 	= $id_program;
			$this->Icons->is_main		= $this->input->post('is_main');
			$this->Icons->ext 			= $file_data['file_ext'];
			$this->Icons->width 		= $file_data['image_width'];
			$this->Icons->height 		= $file_data['image_height'];
			$this->Icons->size 			= $file_data['file_size'];
			$this->Icons->save();
			
			$new_name = $file_data['file_path'] . $this->input->post('slug') . $file_data['file_ext'];
			rename($file_data['full_path'], $new_name);
			chmod ($new_name, 0777);
			
			$data['status'] = 'win';
			$data['icon'] = $this->Icons;
			$data['icon_data'] = $file_data;
		}
		
		$data['program'] = $program;
		
		$this->load->view('header');
		$this->load->view('programs/do_icon_upload',$data);
		$this->load->view('footer');
	}
	
	public function upload_icon($id_program)
	{
		if(False !== $id_program)
			$this->Programs->id = $id_program;
		
		$program = (False !== $id_program) ? $this->Programs->get_id() : $this->Programs;
		
		$data = array(
			'form' => $this->_render_upload_icon_form($id_program),
			'program' => $program,
		);
		
		$this->load->view('header');
		$this->load->view('programs/upload_icon',$data);
		$this->load->view('footer');		
	}
	
	public function add_edit($id_program = False)
	{
		if(False !== $id_program)
			$this->Programs->id = $id_program;
	
		$program = (False !== $id_program) ? $this->Programs->get_id() : $this->Programs;
	
		$data = array(
			'form' => $this->_render_form($id_program),
			'program' => $program,
		);
	
		$this->load->view('header');
		$this->load->view('programs/add_edit',$data);
		$this->load->view('footer');
	}
	
	
}