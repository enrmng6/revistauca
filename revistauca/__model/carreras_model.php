<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/db_config.php";

class Carreras_Model{
	
	private $db_object;
	
	public function __construct(){
		$this->db_object = new MySQLConnection();
	}
	
	public function getResult($select_sql){
		return $this->db_object->getResult($select_sql);
	}
	
	public function executeStatement($sql){
		return $this->db_object->executeStatement($sql);
	}
	
}

 ?>