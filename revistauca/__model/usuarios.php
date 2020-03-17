<?php

class Usuario{
	
	private $id;
	public $nombre;
	public $correo;
	//private $passw;
	public $id_carrera;
	public $tipo;
	public $imagen;
	public $creado;
	
	public function __construct(){
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		return $this->id = $id;
	}
	
}

 ?>