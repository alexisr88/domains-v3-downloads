<?php
class Categories_model extends CI_Model {

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
			$this->db->where('id',$this->id)->update('categories',$this);
		}
		else
		{
			$this->db->insert('categories',$this);
		}
	}
	
	public function get_for_select()
	{
		$categories = array('-1' => 'Select one ...');
	
		$items = $this->db->select('id,name')->from('categories')->get()->result();
	
		foreach($items as $item) {
			$categories[$item->id] = $item->name;
		}
	
		return $categories;
	}
	
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('categories')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);		
		$categories = $this->db->get('categories')->result();
		return $categories;
	}
}