<?php
class Countries_model extends CI_Model {

	public $id;
	public $english_iso_name;
	public $iso_code;
	public $id_language;

	function __construct()
	{
		parent::__construct();
	}
	
	public function save()
	{
		if(Null !== $this->id) 
		{
			$this->db->where('id',$this->id)->update('countries',$this);
		}
		else
		{
			$this->db->insert('countries',$this);
		}
	}
	
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('countries')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);		
		$countries = $this->db->get('countries')->result();
		return $countries;
	}
}