<?php

class MySQLConnection{
	
	private $conexion;
	
	public function __construct(){
		$this->conexion = mysqli_connect('localhost:8080', 'web1', 'web1', 'revistauca'); // server, user, passw, db
		//$this->conexion = new mysqli('157.230.178.160', 'web1', 'web1', 'revistauca'); // server, user, passw, db
		//$this->conexion = mysqli_connect('localhost', 'web1', 'web1', 'revistaucaapp');
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