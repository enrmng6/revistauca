<?php

class MySQLConnection{
	
	private $conexion;
	
	public function __construct(){
		$this->conexion = mysqli_connect('localhost', 'web1', 'web1', 'revistauca');
	}
	
	public function getResult($select_sql){
		return $this->conexion->query($select_sql);
		//return mysqli_query($this->conexion, $select_sql);
	}
	
	public function executeStatement($sql){
		return $this->conexion->query($sql);
	}
	
}

 ?>
