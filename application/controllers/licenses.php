<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Licenses extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('tooltip', 'spanish');
		$this->lang->load('form_results', 'spanish');
		$this->load->model('licenses_model','Licenses');
	}
	
	private function _render_form($id_license = False)
	{
		if(False !== $id_license)
			$this->Licenses->id = $id_license;

		$license = (False !== $id_license) ? $this->Licenses->get_id() : $this->Licenses;

		$name_opt = array(
			'name' 	=> 'name',
			'value'	=> $license->name,
			'class' => 'show-help',
			'rel'	=> 'tooltip',
			'title' => $this->lang->line('tooltip_form_license_name'),
		);
		
		$detail_opt = array(
			'name' 	=> 'detail',
			'value'	=> $license->detail,
			'class' => 'show-help',
			'rel'	=> 'tooltip',
			'title' => $this->lang->line('tooltip_form_license_detail'),
		);
		
		$form  = form_open('licenses/save',array('class' => 'well ajax_form', 'id' => 'save-licenses-form'));
		
		if(False !== $id_license) 
		{ 
			$form .= form_hidden('id',$id_license);
			$form .= form_hidden('action_type','update');
		}
		
		$form .= open_control();
		$form .= form_label('Name','name');
		$form .= form_input($name_opt);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Detail','detail');
		$form .= form_textarea($detail_opt);
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
		$this->form_validation->set_rules('detail', 'Detail{detail}', 'required');
		
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
				$this->Licenses->id = $this->input->post('id');
			
			$this->Licenses->name 	= $this->input->post('name');
			$this->Licenses->detail = $this->input->post('detail');
			$this->Licenses->save();
		}
		
		header('Content-type: application/json');
		echo json_encode($response);
	}
	
	public function view()
	{
		$this->load->helper('text');
		
		$data = array(
			'licenses' => $this->Licenses->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('licenses/view',$data);
		$this->load->view('footer');		
	}
	
	public function add_edit($id_license = False)
	{
		if(False !== $id_license)
			$this->Licenses->id = $id_license;

		$license = (False !== $id_license) ? $this->Licenses->get_id() : $this->Licenses;
		
		$data = array(
			'form' => $this->_render_form($id_license),
			'license' => $license,
		);
		
		$this->load->view('header');
		$this->load->view('licenses/add_edit',$data);
		$this->load->view('footer');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('licenses/home');
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */