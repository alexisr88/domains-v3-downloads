<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Countries extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('tooltip', 'spanish');
		$this->lang->load('form_results', 'spanish');
		$this->load->model('countries_model','Countries');
		$this->load->model('languages_model','Languages');
	}
	
	public function view()
	{
		$this->load->helper('text');
		
		$data = array(
			'countries' => $this->Countries->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('countries/view',$data);
		$this->load->view('footer');		
	}
	
	public function _render_form($id_country = False)
	{
		if(False !== $id_country)
			$this->Countries->id = $id_country;
		
		$country = (False !== $id_country) ? $this->Countries->get_id() : $this->Countries;
		$languages = $this->Languages->get_list();
		
		$english_iso_name = array(
			'name' 	=> 'english_iso_name',
			'value'	=> $country->english_iso_name,
			'class' => 'show-help',
			'rel'	=> 'tooltip',
			'title' => $this->lang->line('tooltip_form_license_name'),
		);
		
		$iso_code = array(
			'name' 	=> 'iso_code',
			'value'	=> $country->iso_code,
			'class' => 'show-help',
			'rel'	=> 'tooltip',
			'title' => $this->lang->line('tooltip_form_license_name'),
		);
		
		$form  = form_open('countries/save',array('class' => 'well ajax_form', 'id' => 'save-licenses-form'));
		
		if(False !== $id_country)
		{
			$form .= form_hidden('id',$id_country);
			$form .= form_hidden('action_type','update');
		}
		
		$form .= open_control();
		$form .= form_label('English name','english_iso_name');
		$form .= form_input($english_iso_name);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Iso code','iso_code');
		$form .= form_input($iso_code);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Language','id_language');
		$form .= '<ul class="langs_list">';
		foreach($languages as $lang)
		{
			$form .= '<li>';
			$form .= form_radio('id_language',$lang->id,($country->id_language == $lang->id) ? True : False);
			$form .= '<strong>'.$lang->english_iso_name.'</strong>'.'</li>';
		}
		$form .= '</ul>';
		$form .= close_control();		
		
		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Save','id' => 'save-licenses'));
		$form .= form_close();
		
		return $form;
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('', '|');
		$this->form_validation->set_rules('english_iso_name', 'English Name{english_iso_name}', 'required');
		$this->form_validation->set_rules('iso_code', 'ISO Code{iso_code}', 'required');
		$this->form_validation->set_rules('id_language', 'Language{id_language}', 'required');
		
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
				$this->Countries->id = $this->input->post('id');
				
			$this->Countries->english_iso_name 	= $this->input->post('english_iso_name');
			$this->Countries->iso_code = $this->input->post('iso_code');
			$this->Countries->id_language = $this->input->post('id_language');
			$this->Countries->save();
		}
		
		header('Content-type: application/json');
		echo json_encode($response);
	}
	
	public function add_edit($id_country = False)
	{
		if(False !== $id_country)
			$this->Countries->id = $id_country;
	
		$countries = (False !== $id_country) ? $this->Countries->get_id() : $this->Countries;
	
		$data = array(
			'form' => $this->_render_form($id_country),
			'countries' => $countries,
		);
	
		$this->load->view('header');
		$this->load->view('countries/add_edit',$data);
		$this->load->view('footer');
	}
	
}