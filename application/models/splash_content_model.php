<?php
class Splash_content_model extends CI_Model {

	public $id;
	public $title;
	public $text;
	public $id_language;

	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(Null !== $this->id) 
		{
			$this->db->where('id',$this->id)->update('splash_content',$this);
		}
		else
		{
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
		$splash_contents = $this->db->get('splash_content')->result();
		return $splash_contents;
	}
}