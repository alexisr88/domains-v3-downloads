<?php
class Splash_content_model extends CI_Model {

	public $id;
	public $title;
	public $text;
	public $id_language;
	public $id_program;
	public $date_added;
	public $date_updated = '000-00-00 00:00:00';

	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(Null !== $this->id) 
		{
			$this->date_updated = date('Y-m-d H:m:s');
			$this->db->where('id',$this->id)->update('splash_content',$this);
		}
		else
		{
			$this->date_added = date('Y-m-d H:m:s');
			$this->db->insert('splash_content',$this);
		}
	}
		
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('splash_content')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);		
		$splash_contents = $this->db->select('sc.id, sc.title, sc.text, sc.date_added, sc.date_updated')
									->select('programs.name as program_name, languages.english_iso_name, languages.iso_code')
									->from('splash_content sc')
									->join('programs','programs.id = sc.id_program')
									->join('languages','languages.id = sc.id_language')
									->get()->result();
		return $splash_contents;
	}
}