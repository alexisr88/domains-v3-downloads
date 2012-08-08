<?php
class Licenses_model extends CI_Model {

	public $id;
	public $name;
	public $detail;

	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(Null !== $this->id) 
		{
			$this->db->where('id',$this->id)->update('licenses',$this);
		}
		else
		{
			$this->db->insert('licenses',$this);
		}
	}
	
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('licenses')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);		
		$licenses = $this->db->get('licenses')->result();
		
		return $licenses;
	}
}