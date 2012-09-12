<?php
class News_model extends CI_Model {

	public $id;
	public $title;
	public $short_text;
	public $long_text;
	public $img_path;
	public $thumb_path;
	public $id_language;
	public $id_program;
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(Null !== $this->id) 
		{
			$this->db->where('id',$this->id)->update('news',$this);
		}
		else
		{
			$this->db->insert('news',$this);
		}
	}
		
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('news')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list()
	{
		$items = $this->db->get('news')->result();
		return $items;
	}
	
}