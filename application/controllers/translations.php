<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Translations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		//
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->helper('form');
		//
		$this->load->model('Languages_model','Langs');
		$this->load->model('Translations_model','Translations');
	}
	
	public function index()
	{
		$breadcrumbs[] = array('href' => base_url('translations/'),'title' => 'Traducciones','class'=>'active');
		
		$data = array(
			'translations' 	=> '',
			'breadcrumbs'	=> 	$breadcrumbs,
		);
		
		$this->load->view('header');
		$this->load->view('translations/index',$data);
		$this->load->view('footer');
	}
		
	public function _generate_new_key_form()
	{
		$form  = form_open('translations/save/',array('class' => 'well ajax_form', 'id' => 'save-translation-key'));
		
		$form .= open_control();
		$form .= form_label('Idioma Base','id_lang');
		$form .= form_dropdown('id_lang',$this->Langs->get_for_select());
		$form .= close_control();		
		
		$form .= open_control();
		$form .= form_label('Keyword','key');
		$form .= form_input('key','');
		$form .= close_control();		
		
		$form .= open_control();
		$form .= form_label('Texto','text');
		$form .= form_textarea('text','');
		$form .= close_control();
		
		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Guardar','id' => 'save-key'));
		$form .= form_close();
		
		return $form;
	}
	
	public function save()
	{
		$this->form_validation->set_error_delimiters('', '|');
		$this->form_validation->set_rules('id_lang', 'Idioma base{id_lang}', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('key', 'Key{key}', 'required');
		$this->form_validation->set_rules('text', 'Texto{text}', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$response = array(
				'status' => 'fail',
				'fileds' => format_error(validation_errors()),
				'message' => 'Se encontraron <strong>'.count(format_error(validation_errors())).'</strong> errores, por favor, reviselos e intente nuevamente'
			);
		} 
		else
		{
			$this->Translations->setId(Null);
			$this->Translations->setKey($this->input->post('key'));
			$this->Translations->setText($this->input->post('text'));
			$this->Translations->setId_lang($this->input->post('id_lang'));
			$this->Translations->save();
			
			$response = array(
				'status' => 'win',
				'message' => 'El usuario <strong>'.$this->Translations->getKey ().'</strong> se agrego correctamente a la base de datos'
			);
		}
		
		header('Content-type: application/json');
		echo json_encode($response);
		
	}
	
	public function translate_t($text,$id_lang)
	{
		
	}
	
	public function save_translation()
	{
		$this->form_validation->set_error_delimiters('', '|');
		$this->form_validation->set_rules('text_source', 'Texto fuente{text_source}', 'required');
		$this->form_validation->set_rules('text_dest', 'Texto Traducido{text_dest}', 'required');
		$this->form_validation->set_rules('id_source', 'Idioma base{id_source}', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('id_dest', 'Idioma destino{id_dest}', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('key', 'Keyword{key}', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$response = array(
					'status' => 'fail',
					'fileds' => format_error(validation_errors()),
					'message' => 'Se encontraron <strong>'.count(format_error(validation_errors())).'</strong> errores, por favor, reviselos e intente nuevamente'
			);
		}
		else
		{
			$translation_source = $this->Translations->get_by_key_id_lang($this->input->post('key'),$this->input->post('id_source'));
			$translation_dest	= $this->Translations->get_by_key_id_lang($this->input->post('key'),$this->input->post('id_dest'));
			
			$data_dest = array(
					'key' 		=> $this->input->post('key'),
					'text' 		=> $this->input->post('text_dest'),
					'id_lang' 	=> $this->input->post('id_dest'),
			);
			
			if(False !== $translation_dest)
				$data_dest['id'] = $translation_dest->id;

			$this->Translations->setOptions($data_dest);
			$this->Translations->save();
			
			$response = array(
					'status' => 'win',
					'message' => 'La traducción se agrego correctamente',
			);
		}
		
		header('Content-type: application/json');
		echo json_encode($response);				
	}
	
	public function render_general_by_source_dest($id_source,$id_dest = Null)
	{
		$this->Translations->setId_lang($id_source);
		$items = $this->Translations->get_by_id_source();
		
		foreach($items as $item) {
			$item->translation = $this->Translations->get_by_key_id_lang($item->key,$id_dest);
		}
		
		$this->Langs->id = $id_source;
		$lang_src = $this->Langs->get_id($id_source);
		
		$this->Langs->id = $id_dest;
		$lang_dst = $this->Langs->get_id($id_dest);
						
		$data = array(
			'translations' 	=> $items,
			'id_source'		=> $id_source,
			'id_dest'		=> $id_dest,
			'lang_src'		=> $lang_src,
			'lang_dst'		=> $lang_dst,
		);
		
		sleep(1);
		$this->load->view('translations/table',$data);
	}
	
	public function key_exists($key)
	{
		$this->Translations->setKey($key);
		
		if(True === $this->Translations->key_exists())
		{
			$this->form_validation->set_message('key_exists', 'Key{key} aready in use');
			return False;
		}
		else
		{
			return True;
		}
	}

	public function step_one()
	{
		$breadcrumbs[] = array('href' => base_url('translations/'),'title' => 'Traducciones','class'=>'');
		$breadcrumbs[] = array('href' => base_url('translations/step_one'),'title' => 'Paso uno','class'=>'active');
		
		$data = array(
			'breadcrumbs'	=> $breadcrumbs,
			'languages'		=> $this->Langs->get_list(),
		);
		
		$this->load->view('header');
		$this->load->view('translations/step_one',$data);
		$this->load->view('footer');		
	}
	
	public function render_translation_form($lang_source,$lang_dest,$id_source,$id_dest,$keyword)
	{
		$form  = form_open('translations/save_translation/',array('class' => 'ajax_form', 'id' => 'save-translations'));
		
		$form .= form_hidden('id_source',$id_source);
		$form .= form_hidden('id_dest',$id_dest);
		$form .= form_hidden('key',$keyword);
		$form .= form_hidden('action_type','update');
		
		$form .= open_control();
		$form .= form_label('Texto','text');
		$form .= form_textarea('text_source',@$lang_source->text);
		$form .= close_control();
		
		$form .= open_control();
		$form .= form_label('Texto','text');
		$form .= form_textarea('text_dest',@$lang_dest->text);
		$form .= close_control();
				
		$form .= form_submit(array('class' => 'btn btn-primary btn-medium','value' => 'Guardar Traduccion','id' => 'save-translation'));
		$form .= form_close();
		
		return $form;		
	}
	
	public function translate($keyword,$id_source,$id_dest)
	{
		
		$lang_src = $this->Langs->get_id($id_source);
		$lang_dst = $this->Langs->get_id($id_dest);
		
		$source = $this->Translations->get_by_key_id_lang($keyword,$id_source);
		$dest	= $this->Translations->get_by_key_id_lang($keyword,$id_dest);
		
		$data = array(
			'form'	=> $this->render_translation_form($source,$dest,$id_source,$id_dest,$keyword),	
		);
		
		$this->load->view('translations/translate',$data);
	}
	
	public function create_edit()
	{	
		$breadcrumbs[] = array('href' => base_url('translations/'),'title' => 'Traducciones','class'=>'active');
		
		$data = array(
			'form'			=> $this->_generate_new_key_form(),	
			'breadcrumbs'	=> 	$breadcrumbs,	
		);
		
		$this->load->view('header');
		$this->load->view('translations/create_edit',$data);
		$this->load->view('footer');		
	}
	
}