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
	
	public function get_by_code()
	{
		$item = $this->db->where('iso_code',$this->iso_code)->get('languages')->result();
		return (count($item) > 0) ? $item[0] : False;		
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);
		$licenses = $this->db->get('languages')->result();
		return $licenses;
	}
	
	public function get_for_select()
	{
		$categories = array('-1' => 'Select one ...');
	
		$items = $this->db->select('id,english_iso_name')->from('languages')->get()->result();
	
		foreach($items as $item) {
			$categories[$item->id] = $item->english_iso_name;
		}
	
		return $categories;
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