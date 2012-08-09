<?php
class Icons_model extends CI_Model {

	public $id;
	public $slug;
	public $ext;
	public $id_program;
	public $is_main;
	public $width;
	public $height;
	public $size;

	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(Null !== $this->id) 
		{
			$this->db->where('id',$this->id)->update('icons',$this);
		}
		else
		{
			$this->db->insert('icons',$this);
		}
	}
		
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('icons')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);		
		$icons = $this->db->get('icons')->result();
		return $icons;
	}
}