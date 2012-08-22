<?php
class Api extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Languages_model','Langs');
	}
		
	public function translate($text,$lang_code) 
	{						
		$text = html_entity_decode(base64_decode(urldecode($text)));
		$this->load->model('Translations_model','Translations');
		
		$this->Langs->iso_code = $lang_code;
		$language = $this->Langs->get_by_code();
		
		$data = array(
				'id'		=> Null,
				'key' 		=> md5($text),
				'text' 		=> $text,
				'id_lang' 	=> $language->id,
		);
		
		$translation = $this->Translations->get_by_key_id_lang($data['key'],$language->id);
				
		if(False === $translation) 
		{ 			
			$this->Translations->setOptions($data);
			$this->Translations->save();
			
			print $text;
		}
		else
		{
			print $translation->text;
		}
			
	}
	
	public function get_language_info($lang_code)
	{
		$this->Langs->iso_code = $lang_code;
		return $this->Langs->get_by_code();		
	}
	
	public function get_tops($lang_code, $limit)
	{		
		$this->Langs->iso_code = $lang_code;
		$language = $this->Langs->get_by_code();
		
		$items = $this->db->select('p.id, p.name, p.slug, p.official_site_url, p.size, p.our_valuation, p.color, p.url_background')
						  ->select('c.name AS category_name, c.slug AS category_slug')
						  ->select('l.name AS license_name')
						  ->select('sc.title AS splash_title, sc.text AS splash_text')
						  ->from('programs p')
						  ->join('categories c','c.id = p.id_category')
						  ->join('licenses l','l.id = p.id_license')
						  ->join('splash_content sc','sc.id_program = p.id')
						  ->join('languages la','la.id = sc.id_language')
						  ->where('sc.id_language',$language->id)
						  ->limit($limit)
						  ->get()->result();
		
		return $items;
	}
	
	public function get_latest($lang_code, $limit)
	{
		$language = $this->get_language_info($lang_code);
	
		$items = $this->db->select('p.id, p.name, p.slug, p.official_site_url, p.size, p.our_valuation, p.color, p.url_background')
							->select('c.name AS category_name, c.slug AS category_slug')
							->select('l.name AS license_name')
							->select('sc.title AS splash_title, sc.text AS splash_text')
							->from('programs p')
							->join('categories c','c.id = p.id_category')
							->join('licenses l','l.id = p.id_license')
							->join('splash_content sc','sc.id_program = p.id')
							->join('languages la','la.id = sc.id_language')
							->where('sc.id_language',$language->id)
							->limit($limit)
							->get()->result();
	
		print json_encode($items);
	}
	
	public function get_soft($lang_code,$id_category,$limit)
	{
		$language = $this->get_language_info($lang_code);
	
		$items = $this->db->select('p.id, p.name, p.slug, p.official_site_url, p.size, p.our_valuation, p.color, p.url_background')
							->select('c.name AS category_name, c.slug AS category_slug')
							->select('l.name AS license_name')
							->select('sc.title AS splash_title, sc.text AS splash_text')
							->from('programs p')
							->join('categories c','c.id = p.id_category')
							->join('licenses l','l.id = p.id_license')
							->join('splash_content sc','sc.id_program = p.id')
							->join('languages la','la.id = sc.id_language')
							->where('sc.id_language',$language->id)
							->where('p.id_category',$id_category)
							->limit($limit)
							->get()->result();
	
		print json_encode($items);		
	}
	
	public function get_categories()
	{
		$this->load->model('Categories_model','Categories');
		print json_encode($this->Categories->get_list());
	}
	
	public function get_category_by_id($category_id)
	{
		$this->load->model('Categories_model','Categories');
		$this->Categories->id = $category_id;
		
		print json_encode($this->Categories->get_id());
	}
	
	public function get_soft_splash_by_slug($lang_code,$slug)
	{
		$language = $this->get_language_info($lang_code);
		
		$items = $this->db->select('p.id, p.name, p.slug, p.official_site_url, p.size, p.our_valuation, p.color, p.url_background')
							->select('c.name AS category_name, c.slug AS category_slug')
							->select('l.name AS license_name')
							->select('sc.title AS splash_title, sc.text AS splash_text')
							->from('programs p')
							->join('categories c','c.id = p.id_category')
							->join('licenses l','l.id = p.id_license')
							->join('splash_content sc','sc.id_program = p.id')
							->join('languages la','la.id = sc.id_language')
							->where('sc.id_language',$language->id)
							->where('p.slug',$slug)
							->get()->result();
		
		print json_encode($items);		
	}
	
	public function get_search($lang_code, $query, $limit)
	{
		$language = $this->get_language_info($lang_code);
	
		$items = $this->db->select('p.id, p.name, p.slug, p.official_site_url, p.size, p.our_valuation, p.color, p.url_background')
							->select('c.name AS category_name, c.slug AS category_slug')
							->select('l.name AS license_name')
							->select('sc.title AS splash_title, sc.text AS splash_text')
							->from('programs p')
							->join('categories c','c.id = p.id_category')
							->join('licenses l','l.id = p.id_license')
							->join('splash_content sc','sc.id_program = p.id')
							->join('languages la','la.id = sc.id_language')
							->where('sc.id_language',$language->id)
							->where('MATCH (p.name) AGAINST ("'.$query.'")', Null, False)
							->limit($limit)
							->get()->result();
	
		print json_encode($items);
	}
	
}