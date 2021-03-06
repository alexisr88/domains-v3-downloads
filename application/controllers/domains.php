<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domains extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->lang->load('tooltip', 'spanish');
		$this->lang->load('form_results', 'spanish');
		$this->load->model('domains_model','Domains');
		$this->load->model('languages_model','Languages');
		$this->load->model('programs_model','Programs');
		$this->load->model('templates_model','Templates');
	}
	
	public function generate_landing($id_template)
	{
		error_reporting(0);
		
		$this->load->library('simple_html_dom');
		$this->load->helper('file');
		
		$this->Templates->id = $id_template;
		
		$template_info  = $this->Templates->get_id();		
		$template_index = $template_info->path;
		$template_url   = str_replace('./uploads',base_url().'/uploads',$template_index);
				
		$base_html  = file_get_html($template_url);
		
		$content = $base_html->find('*[class=editable]');
			
		foreach($content as $element) {
			$element->id = 'ec-'.uniqid();
		}
			
		$html = str_replace('{base_url}',base_url().$template_info->path,$base_html);	
		write_file($template_info->path.'/base.php', $html);
		
		echo $html;
		
		$this->load->view('toolkit.php');
		
	}
	
	public function sem()
	{
		$this->load->helper('text');
		
		$data = array(
			'domains' => $this->Domains->get_sem_domains(),
		);
		
		$this->load->view('header');
		$this->load->view('domains/sem_view',$data);
		$this->load->view('footer');		
	}
	
	public function view()
	{
		$this->load->helper('text');
		
		$data = array(
			'domains' => $this->Domains->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('domains/view',$data);
		$this->load->view('footer');		
	}
	
	public function upload_template($id_domain)
	{
		if(False !== $id_domain)
			$this->Domains->id = $id_domain;
		
		$domains = (False !== $id_domain) ? $this->Domains->get_id() : $this->Domains;
		
		$data = array(
			'form' => $this->_render_form($id_domain),
			'domain' => $domains,
			'programs_th' => htmlentities('["'.implode('","',$this->Programs->get_names_for_typehead()).'"]'),
		);
		
		$this->load->view('header');
		$this->load->view('domains/upload_template',$data);
		$this->load->view('footer');		
	}
	
	public function _render_form($id_domain = False)
	{
		if(False !== $id_domain)
			$this->Domains->id = $id_domain;
		
		$domain = (False !== $id_domain) ? $this->Domains->get_id() : $this->Domains;
		
		$form  = form_open('domains/save',array('class' => 'well ajax_form', 'id' => 'save-categories-form'));
		$languages = $this->Languages->get_for_select();
		
		if(False !== $id_domain)
		{
			$form .= form_hidden('id',$id_domain);
			$form .= form_hidden('action_type','update');
			
			$this->Programs->id = $domain->id_program;
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
		$form .= form_label('Host','host');
		$form .= form_input('host',$domain->host);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Password','password');
		$form .= form_input('password',$domain->password);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Program Name','program_name');
		$form .= form_input($p_name_input);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Sem domain?','sem');
		$form .= form_checkbox('sem','',$domain->sem);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Language','id_language');
		$form .= form_dropdown('id_language',$languages,$domain->id_language);
		$form .= close_control();
		
		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Save','id' => 'save-category'));
		$form .= form_close();
		
		return $form;
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('', '|');
		$this->form_validation->set_rules('host', 'FTP Host{host}', 'required');
		$this->form_validation->set_rules('password', 'FTP Password{password}', 'required');
		$this->form_validation->set_rules('program_name', 'Program Name{program_name}', 'required');
		$this->form_validation->set_rules('id_language', 'Language{id_language}', 'required|is_natural_no_zero');
		
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
				$this->Domains->id = $this->input->post('id');
			
			$program = $this->Programs->get_by_name($this->input->post('program_name'));
				
			$this->Domains->host = $this->input->post('host');
			$this->Domains->password = $this->input->post('password');
			$this->Domains->id_program	= $program->id;
			$this->Domains->id_language	= $this->input->post('id_language');
			
			if($this->input->post('sem') !== False)
				$this->Domains->sem	= True;
			
			$this->Domains->save();
		}
		
		header('Content-type: application/json');
		echo json_encode($response);
	}
	
	public function add_edit($id_domain = False)
	{
		if(False !== $id_domain)
			$this->Domains->id = $id_domain;
	
		$category = (False !== $id_domain) ? $this->Domains->get_id() : $this->Domains;
	
		$data = array(
			'form' => $this->_render_form($id_domain),
			'domain' => $category,
		);
	
		$this->load->view('header');
		$this->load->view('domains/add_edit',$data);
		$this->load->view('footer');
	}
	
	function oscurece_color($color,$cant){
		//voy a extraer las tres partes del color
		$rojo = substr($color,1,2);
		$verd = substr($color,3,2);
		$azul = substr($color,5,2);
	
		//voy a convertir a enteros los string, que tengo en hexadecimal
		$introjo = hexdec($rojo);
		$intverd = hexdec($verd);
		$intazul = hexdec($azul);
	
		//ahora verifico que no quede como negativo y resto
		if($introjo-$cant>=0) $introjo = $introjo-$cant;
		if($intverd-$cant>=0) $intverd = $intverd-$cant;
		if($intazul-$cant>=0) $intazul = $intazul-$cant;
	
		//voy a convertir a hexadecimal, lo que tengo en enteros
		$rojo = dechex($introjo);
		$verd = dechex($intverd);
		$azul = dechex($intazul);
	
		//voy a validar que los string hexadecimales tengan dos caracteres
		if(strlen($rojo)<2) $rojo = "0".$rojo;
		if(strlen($verd)<2) $verd = "0".$verd;
		if(strlen($azul)<2) $azul = "0".$azul;
	
		//voy a construir el color hexadecimal
		$oscuridad = "#".$rojo.$verd.$azul;
	
		//la función devuelve el valor del color hexadecimal resultante
		return $oscuridad;
	}
	
	public function load_template($temp_folder_name)
	{
		error_reporting(0);
		$this->load->helper('file');
		$this->load->library('simple_html_dom');
		
		$base_theme	= base_url().'uploads/templates/'.$temp_folder_name.'/';
		$base_file	= './uploads/templates/'.$temp_folder_name.'/base_template.php';		
		$has_base	= get_file_info($base_file);
		
		if(False === $has_base) 
		{
			$original_template = file_get_contents($base_theme);
			write_file($base_file, $original_template);
		}
				
		$url 	= base_url().'uploads/templates/'.$temp_folder_name.'/base_template.php';
		$html 	= file_get_html($url);
		
		if(False === $has_base)
		{		
			$content = $html->find('*[class=editable]');
			
			foreach($content as $element) {
				$element->id = 'ec-'.uniqid();
			}	
			
			$html = str_replace('{base_url}',$base_theme,$html);
			
			write_file($base_file, $html);
		}
		
		$data = array(
			'html_template' => $html,
			'url_save_content' => base_url('domains/save_template_contents/'.$temp_folder_name),	
		);
		
		$this->load->view('toolkit',$data);
	}
	
	public function save_template_contents($temp_folder_name)
	{
		$this->load->library('simple_html_dom');
		$this->load->helper('file');
		
		$base_theme	= base_url().'uploads/templates/'.$temp_folder_name.'/base_template.php';
		
		$html 	= file_get_html($base_theme);
		
		foreach($this->input->post('items') as $post_content)
		{
			$content = $html->find('*[id='.$post_content['id'].']');
			foreach($content as $m_content) {
				$m_content->innertext = $post_content['text'];
			}
		}
				
		write_file('uploads/templates/'.$temp_folder_name.'/es.php', $html);
	}
	
	public function template_list()
	{				
		$data = array(
			'templates' => 	$this->Templates->get_templates_join_all(),	
		);
		
		$this->load->view('header');
		$this->load->view('domains/template_list',$data);
		$this->load->view('footer');
		
	}
	
	public function test($domain_id)
	{
		error_reporting(0);
		
		$this->Domains->id = $domain_id;
		$domain = $this->Domains->get_id();
		
		$this->Languages->id = $domain->id_language;
		$language = $this->Languages->get_id();
		
		$this->Programs->id = $domain->id_program;
		$program = $this->Programs->get_id();
		
		$program_data = "http://ns208873.ovh.net/domains-v3-downloads/api/get_soft_splash_by_slug/$language->iso_code/$program->slug";
		$program_data = json_decode(file_get_contents($program_data));
		
		$screenshots = "http://ns208873.ovh.net/domains-v3-downloads/api/get_screenshots/$domain->id_program";
		$screenshots = json_decode(file_get_contents($screenshots));
		
		$data = array(
			'data' => $program_data[0],
			'screenshots' => $screenshots,
			'header_color' => $this->oscurece_color('#'.$program_data[0]->color,90),
			'ligth_color' => $this->oscurece_color('#'.$program_data[0]->color,20),
		);
				
		$this->load->view('base_template',$data);
	}
	
}