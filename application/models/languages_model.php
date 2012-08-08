<?php
class Languages_model extends CI_Model {
	
	public $id;
	public $english_iso_name;
	public $iso_code;

	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('languages')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);
		$licenses = $this->db->get('languages')->result();
		return $licenses;
	}

	public function save()
	{
		if(Null !== $this->id)
		{
			$this->db->where('id',$this->id)->update('languages',$this);
		}
		else
		{
			$this->db->insert('languages',$this);
		}
	}
	
}