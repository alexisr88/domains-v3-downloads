<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Splash_content extends CI_Controller {
	
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
		$this->load->model('splash_content_model','Splash');
	}
		
	public function view()
	{
		$this->load->helper('text');
		
		$data = array(
			'splashs' => $this->Splash->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('splash_content/view',$data);
		$this->load->view('footer');		
	}
		
	public function save()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('', '|');
		$this->form_validation->set_rules('title', 'Title{title}', 'required');
		$this->form_validation->set_rules('text', 'Content text{text}', 'required');
		$this->form_validation->set_rules('id_language', 'Id Language{id_language}', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('program_name', 'Program name{program_name}', 'required|callback_program_name_check');
		
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
			
			$program = $this->Programs->get_by_name($this->input->post('program_name'));
				
			if(False !== $this->input->post('id'))
				$this->Splash->id = $this->input->post('id');
				
			$this->Splash->title 		= $this->input->post('title');
			$this->Splash->text 		= $this->input->post('text');
			$this->Splash->id_language 	= $this->input->post('id_language');
			$this->Splash->id_program	= $program->id;
			
			$this->Splash->save();
		}
		
		header('Content-type: application/json');
		echo json_encode($response);
	}
	
	public function program_name_check($program_name)
	{		
		if(True === $this->Programs->check_name($program_name))
		{
			return True;
		}
		else
		{
			$this->form_validation->set_message('program_name_check', 'El programa{program_name} no existe ...');
			return False;
		}
	}
	
	private function _render_form($id_splash_content)
	{
		if(False !== $id_splash_content)
			$this->Splash->id = $id_splash_content;
		
		$splash = (False !== $id_splash_content) ? $this->Splash->get_id() : $this->Splash;
		$languages = $this->Languages->get_for_select();
		
		$form  = form_open_multipart('splash_content/save',array('class' => 'well ajax_form', 'id' => 'save-licenses-form'));
		
		if(False !== $id_splash_content)
		{
			$form .= form_hidden('id',$id_splash_content);
			$form .= form_hidden('action_type','update');
	
			$this->Programs->id = $splash->id_program;
			$program = $this->Programs->get_id();
		}
		
		$p_name_input = array(
			'data-provide' 	=> 'typeahead',
			'data-items'	=> '5',
			'data-source'	=> htmlentities('["'.implode('","',$this->Programs->get_names_for_typehead()).'"]'),
			'name'			=> 'program_name',
			'value'			=> @$program->name,
		);
				
		$form .= open_control();
		$form .= form_label('Program Name','program_name');
		$form .= form_input($p_name_input);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Title','title');
		$form .= form_input('title',$splash->title);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Language','id_language');
		$form .= form_dropdown('id_language',$languages,$splash->id_language);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Text','text');
		$form .= form_textarea('text',$splash->text);
		$form .= close_control();

		$form .= '<hr />';

		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Save','id' => 'save-licenses'));
		$form .= form_close();
		
		return $form;	
	}
	
	public function add_edit($id_splash_content = False)
	{
		if(False !== $id_splash_content)
			$this->Splash->id = $id_splash_content;
	
		$splash = (False !== $id_splash_content) ? $this->Splash->get_id() : $this->Splash;
	
		$data = array(
			'form' => $this->_render_form($id_splash_content),
			'splash' => $splash,
		);
	
		$this->load->view('header');
		$this->load->view('splash_content/add_edit',$data);
		$this->load->view('footer');
	}
	
	
}