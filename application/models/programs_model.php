<?php
class Programs_model extends CI_Model {

	public $id;
	public $name;
	public $official_site_url;
	public $official_contact;
	public $size;
	public $our_valuation;
	public $id_license;
	public $id_category;
	public $id_user;
	public $id_updater;
	public $date_added;
	public $date_updated;

	function __construct()
	{
		parent::__construct();
	}
		
	public function save()
	{
		$this->id_user = 1;
		
		if(Null !== $this->id)
		{
			$this->date_updated = date('Y-m-d H:m:s');
			$this->db->where('id',$this->id)->update('programs',$this);
		}
		else
		{
			$this->date_added = date('Y-m-d H:m:s');
			$this->date_updated = '0000-00-00 00:00:00';
			$this->db->insert('programs',$this);
		}
	}
	
	public function get_id()
	{
		$item = $this->db->where('id',$this->id)->get('programs')->result();
		return (count($item) > 0) ? $item[0] : False;
	}
	
	public function get_list($limit = Null,$offset = Null)
	{
		//$this->db->limit($limit,$offset);
		$programs = $this->db->get('programs')->result();
		return $programs;
	}
	
}