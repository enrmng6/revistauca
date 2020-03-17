<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/carreras_model.php";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/carreras.php";

class Carreras_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new Carreras_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function selectCarrera($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM carreras";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . ";";
		
		return $this->getResult($sql);
	}
	
	public function insertCarrera($nombre){	// esta funcion es personalizada para abstraer el SQL
		
		$sql = "INSERT INTO carreras (nombre) VALUES ('" . $nombre ."');";
		
		return $this->executeStatement($sql);
	}
	
}


session_start();


if(isset($_GET['select'])){
	
	$controlador = new Carreras_Controller();
	
	$resultado = null;
	
	if(isset($_GET['carreraid'])){
		$resultado = $controlador->selectCarrera($_GET['carreraid']);	// devuelve los datos especificos de una sola fila de la tabla carreras
	}
	else{
		$resultado = $controlador->selectCarrera(0);	// devuelve los datos de todas las filas
	}
	
	$resultadoFinal = array();
	
	for($i = 0; $i < $resultado->num_rows; $i++){
		$resultado->data_seek($i);
		$fila = $resultado->fetch_assoc();
		
		$carrera = new Carrera();
		$carrera->id = $fila['id'] + 0;
		$carrera->nombre = $fila['nombre'];
		
		array_push($resultadoFinal, $carrera);
	}
	
	if(isset($_GET['json'])){
		echo json_encode($resultadoFinal);
	}
	else{
		print_r($resultadoFinal);
	}
}
else if(isset($_GET['insert'])){
	
	$nombre = $_POST['titulo'];
	
	$controlador = new Carreras_Controller();
	
	$resultado = $controlador->insertCarrera($nombre);
	
	return $resultado;
}
else if(isset($_GET['update'])){
}
else if(isset($_GET['delete'])){
}
else{
}


 ?>