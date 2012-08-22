<?php
class Translations_model extends CI_Model {

	private $_table 	= 'translations';
	private $_primary 	= 'id';
	
	private $id;
	private $key;
	private $text;
	private $id_lang;
	private $id_category;
	
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $key
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @return the $text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * @return the $id_lang
	 */
	public function getId_lang() {
		return $this->id_lang;
	}

	/**
	 * @return the $id_category
	 */
	public function getId_category() {
		return $this->id_category;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $key
	 */
	public function setKey($key) {
		$this->key = $key;
	}

	/**
	 * @param field_type $text
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * @param field_type $id_lang
	 */
	public function setId_lang($id_lang) {
		$this->id_lang = $id_lang;
	}

	/**
	 * @param field_type $id_category
	 */
	public function setId_category($id_category) {
		$this->id_category = $id_category;
	}
	
	public function key_exists()
	{
		$items = $this->db->where('key',$this->getKey())->get($this->_table)->result();
		return (count($items) > 0) ? True : False;
	}
	
	public function get_by_id_source()
	{
		$items = $this->db->where('id_lang',$this->getId_lang())->get($this->_table)->result();
		return $items;
	}
	
	public function get_by_key_id_lang($key,$id_lang)
	{
		$items = $this->db->where('id_lang',$id_lang)->where('key',$key)->get($this->_table)->result();		
		return (count($items) > 0) ? $items[0] : False;
	}
		
	public function save()
	{
		
		$data = array(
				'id_lang' 		=> $this->getId_lang(),
				'text' 			=> $this->getText(),
				'key' 			=> $this->getKey(),
		);
				
		if($this->getId() == Null)
		{		
			$this->db->insert($this->_table,$data);
		}
		else
		{
			$data['id'] = $this->getId();
			$this->db->where($this->_primary,$this->getId())->update($this->_table,$data);
		}
	}
	
}