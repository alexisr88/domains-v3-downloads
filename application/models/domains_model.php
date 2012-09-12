<?php
class Domains_model extends CI_Model {

	public $id;
	public $host;
	public $password;
	public $id_program;
	public $id_language;

	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(Null !== $this->id) 
		{
			$this->db->where('id',$this->id)->update('domains',$this);
		}
		else
		{
			$this->db->insert('domains',$this);
		}
	}
		
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('domains')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);		
		$categories = $this->db->get('domains')->result();
		return $categories;
	}
}