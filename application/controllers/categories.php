<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('tooltip', 'spanish');
		$this->lang->load('form_results', 'spanish');
		$this->load->model('categories_model','Categories');
	}
	
	public function view()
	{
		$this->load->helper('text');
		
		$data = array(
			'categories' => $this->Categories->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('categories/view',$data);
		$this->load->view('footer');		
	}
	
	public function _render_form($id_category = False)
	{
		if(False !== $id_category)
			$this->Categories->id = $id_category;
		
		$category = (False !== $id_category) ? $this->Categories->get_id() : $this->Categories;
		
		$form  = form_open('categories/save',array('class' => 'well ajax_form', 'id' => 'save-categories-form'));
		
		if(False !== $id_category)
		{
			$form .= form_hidden('id',$id_category);
			$form .= form_hidden('action_type','update');
		}
		
		$form .= open_control();
		$form .= form_label('Category Name','name');
		$form .= form_input('name',$category->name);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Detail','detail');
		$form .= form_textarea('detail',$category->detail);
		$form .= close_control();
		
		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Save','id' => 'save-category'));
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
				$this->Categories->id = $this->input->post('id');
				
			$this->Categories->name   = $this->input->post('name');
			$this->Categories->detail = $this->input->post('detail');
			$this->Categories->save();
		}
		
		header('Content-type: application/json');
		echo json_encode($response);
	}
	
	public function add_edit($id_category = False)
	{
		if(False !== $id_category)
			$this->Categories->id = $id_category;
	
		$category = (False !== $id_category) ? $this->Categories->get_id() : $this->Categories;
	
		$data = array(
			'form' => $this->_render_form($id_category),
			'category' => $category,
		);
	
		$this->load->view('header');
		$this->load->view('categories/add_edit',$data);
		$this->load->view('footer');
	}
	
}