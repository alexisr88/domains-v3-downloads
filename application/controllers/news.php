<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('tooltip', 'spanish');
		$this->lang->load('form_results', 'spanish');
		$this->load->model('countries_model','Countries');
		$this->load->model('languages_model','Languages');
		$this->load->model('programs_model','Programs');
		$this->load->model('news_model','News');
	}
		
	public function view()
	{
		$this->load->helper('text');
		
		$data = array(
			'news' => $this->News->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('news/view',$data);
		$this->load->view('footer');		
	}
		
	public function save()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('', '|');
		$this->form_validation->set_rules('title', 'Title{title}', 'required');
		$this->form_validation->set_rules('short_text', 'Short text{short_text}', 'required');
		$this->form_validation->set_rules('long_text', 'Long text{long_text}', 'required');
		$this->form_validation->set_rules('id_language', 'Id Language{id_language}', 'required|is_natural_no_zero');
			
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
				$this->News->id = $this->input->post('id');
			
			if($this->input->post('program_name')) 
			{ 
				$program = $this->Programs->get_by_name($this->input->post('program_name'));
				$this->News->id_program	= $program->id;
			}
				
			$this->News->title 		 = $this->input->post('title');
			$this->News->short_text  = $this->input->post('short_text');
			$this->News->long_text	 = $this->input->post('long_text');
			$this->News->id_language = $this->input->post('id_language');
			
			$this->News->save();
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
	
	private function _render_form($id_new)
	{
		if(False !== $id_new)
			$this->News->id = $id_new;
		
		$new = (False !== $id_new) ? $this->News->get_id() : $this->News;
		$languages = $this->Languages->get_for_select();
		
		$form  = form_open_multipart('news/save',array('class' => 'well ajax_form', 'id' => 'save-licenses-form'));
		
		if(False !== $id_new)
		{
			$form .= form_hidden('id',$id_new);
			$form .= form_hidden('action_type','update');
			
			$this->Programs->id = $new->id_program;
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
		$form .= form_label('Title','title');
		$form .= form_input('title',$new->title);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Language','id_language');
		$form .= form_dropdown('id_language',$languages,$new->id_language);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Program Name (optional)','program_name');
		$form .= form_input($p_name_input);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Short Text','short_text');
		$form .= form_textarea('short_text',$new->short_text);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Long text','long_text');
		$form .= form_textarea('long_text',$new->long_text);
		$form .= close_control();
				
		$form .= '<hr />';

		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Save','id' => 'save-licenses'));
		$form .= form_close();
		
		return $form;	
	}
	
	public function add_edit($id_new = False)
	{
		if(False !== $id_new)
			$this->News->id = $id_new;
	
		$new = (False !== $id_new) ? $this->News->get_id() : $this->News;
	
		$data = array(
			'form' 	=> $this->_render_form($id_new),
			'new' 	=> $new,
		);
	
		$this->load->view('header');
		$this->load->view('news/add_edit',$data);
		$this->load->view('footer');
	}
	
	
}