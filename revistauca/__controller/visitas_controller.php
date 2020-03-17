<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/visitas_model.php";

class Visitas_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new Visitas_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function selectVisita($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM visitas";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . " ORDER BY creado DESC;";
		
		return $this->getResult($sql);
	}
	
	public function selectCountVisitas($id_elemento, $entidad, $id_usuario){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT contador FROM visitas WHERE id_elemento=" . $id_elemento . " AND entidad='" . $entidad . "'";
		
		if($id_usuario > 0){
			$sql = $sql . " AND id_usuario=" . $id_usuario . "";
		}
		
		$sql = $sql . ";";
		
		return $this->getResult($sql);
	}
	
	/*id_elemento INT,
	entidad VARCHAR(30),
	id_usuario INT,
	contador INT DEFAULT 0,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	request_header TEXT*/
	public function insertVisita($id_elemento, $entidad, $id_usuario, $request_header){	// esta funcion es personalizada para abstraer el SQL
		
		
		
		$sql = "INSERT INTO visitas (id_elemento, entidad, id_usuario, contador, request_header) VALUES (";
		$sql = $sql . "" . $id_elemento . ", '" . $entidad ."', " . $id_usuario . ", 1, '" . $request_header . "');";
		
		$resultado_contador = $this->selectCountVisitas($id_elemento, $entidad, $id_usuario);
		$resultado_contador->data_seek(0);
		$fila = $resultado_contador->fetch_assoc();
		
		$contador_visitas = $fila['contador'];
		$contador_visitas = $contador_visitas * 1; // para pasarlo a numero
		
		if($contador_visitas >= 1){
			
			$contador_visitas++;
			$sql = "UPDATE visitas set contador=" . $contador_visitas . ", request_header='" . $request_header . "' WHERE id_elemento=" . $id_elemento . " AND entidad='" . $entidad . "' AND id_usuario=" . $id_usuario . "";
		}
		
		return $this->executeStatement($sql);
	}
	
}


session_start();


if(isset($_GET['select'])){
	
	$controlador = new Visitas_Controller();
}
else if(isset($_GET['insert'])){
	
	$id_elemento = $_POST['id_elemento'];
	$entidad = $_POST['entidad'];
	$id_usuario = $_SESSION['id_usuario'];
	
	$header_list = headers_list();
	$request_header = "";
	
	for($i = 0; $i < count($header_list); $i++){
		$request_header .=  $header_list[$i] . "\r\n";
	}
	
	$controlador = new Visitas_Controller();
	
	$resultado = $controlador->insertVisita($id_elemento, $entidad, $id_usuario, $request_header);
	
	echo $resultado;
}
else{
}


 ?>