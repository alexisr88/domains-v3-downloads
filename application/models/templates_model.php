<?php
class Templates_model extends CI_Model {

	public $id;
	public $id_domain;
	public $id_program;
	public $path;
	public $name;

	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(False == $this->exist_template()) {
			$this->db->insert('templates',$this);
		}
	}
	
	public function exist_template()
	{
		$items = $this->db->where('id_domain',$this->id_domain)
				 ->where('id_program',$this->id_program)
				 ->where('path',$this->path)
				 ->get('templates')->result();
		
		return (count($items) > 0) ? True : False;
	}
	
	public function get_for_select()
	{
		$categories = array('-1' => 'Select one ...');
	
		$items = $this->db->select('id,name')->from('templates')->get()->result();
	
		foreach($items as $item) {
			$categories[$item->id] = $item->path;
		}
	
		return $categories;
	}
	
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('templates')->result();
		return (count($item) > 0) ? True : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);		
		$categories = $this->db->get('templates')->result();
		return $categories;
	}
}