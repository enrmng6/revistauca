<?php

session_start();

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/usuarios_model.php";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/usuarios.php";

class Usuarios_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new Usuarios_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function loginUsuario($correo, $passw){
		$sql= "SELECT id, nombre, correo, id_carrera, tipo, imagen, creado FROM usuarios WHERE correo='$correo' AND passw = SHA1('$passw');";
		return $this->getResult($sql);
	}
	
	public function selectUsuario($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT id, nombre, correo, id_carrera, tipo, imagen, creado FROM usuarios";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . ";";
		
		return $this->getResult($sql);
	}
	
	public function insertUsuario($nombre, $correo, $passw, $id_carrera, $imagen_name, $imagen_tmp_name){	// esta funcion es personalizada para abstraer el SQL
		
		$final_image_name = basename($imagen_tmp_name) . $imagen_name;
		$imagen = '/revistauca/_public/img/Perfil.png';
		$imagen = ($final_image_name == '') ? $imagen : '/revistauca/__controller/usuariosuploads/' . $final_image_name;
		
		$sql="INSERT INTO usuarios (nombre, correo, passw, id_carrera, tipo, imagen, creado)
		values ('$nombre', '$correo', SHA1('$passw'), $id_carrera, 'estudiante', '$imagen', NULL)";
		
		if(isset($_SESSION['id_usuario'])){
		
			if($imagen_name == ''){
				$sql = "UPDATE usuarios set nombre='$nombre', correo='$correo', passw=SHA1('$passw'), id_carrera=$id_carrera";
			}
			else{
				$sql = "UPDATE usuarios set nombre='$nombre', correo='$correo', passw=SHA1('$passw'), id_carrera=$id_carrera, imagen='$imagen'";
				$_SESSION['imagen_usuario'] = $imagen;
			}
			
			/*if(isset($_GET['delete'])){
				$sql = "DELETE FROM posts";
			}*/
			
			$sql .= " WHERE id=" .$_SESSION['id_usuario']. ";";
		}
		
		move_uploaded_file($imagen_tmp_name, 'usuariosuploads/' . $final_image_name);
	
		return $this->executeStatement($sql);
	}
}


if(isset($_GET['select'])){
	
	$controlador = new Usuarios_Controller();
	
	$resultado = null;
	
	if(isset($_GET['userid'])){
		$userId = $_GET['userid'];
		
		$resultado = $controlador->selectUsuario($userId);	// devuelve los datos especificos de una sola fila de la tabla usuarios
	}
	else{
		$resultado = $controlador->selectUsuario(0);	// devuelve los datos de todas las filas
	}
	
	$resultadoFinal = array();
	
	for($i = 0; $i < $resultado->num_rows; $i++){
		$resultado->data_seek($i);
		$fila = $resultado->fetch_assoc();
		
		$usuario = new Usuario();
		$usuario->setId($fila['id'] + 0);
		$usuario->nombre = $fila['nombre'];
		$usuario->correo = $fila['nombre'];
		$usuario->id_carrera = $fila['id_carrera'] + 0;
		$usuario->tipo = $fila['tipo'];
		$usuario->imagen = $fila['imagen'];
		$usuario->creado = $fila['creado'];
		
		array_push($resultadoFinal, $usuario);
	}
		
	if(isset($_GET['json'])){
		echo json_encode($resultadoFinal);
	}
	else{
		print_r($resultadoFinal);
	}
}
else if(isset($_GET['login'])){
	
	$correo = $_POST['correo'];
	$passw = $_POST['passw'];
		
	$controlador = new Usuarios_Controller();
	
	$resultado = $controlador->loginUsuario($correo, $passw);
	
	for($i = 0; $i < $resultado->num_rows; $i++){
		$resultado->data_seek($i);
		$fila = $resultado->fetch_assoc();
		
		$_SESSION['id_usuario'] = $fila['id'] + 0;
		$_SESSION['nombre_usuario'] = $fila['nombre'];
		$_SESSION['tipo_usuario'] = $fila['tipo'];
		$_SESSION['imagen_usuario'] = $fila['imagen'];
		
		echo 1;
		return;
	}
	
	$_SESSION['id_usuario'] = NULL;
	$_SESSION['nombre_usuario'] = NULL;
	$_SESSION['tipo_usuario'] = NULL;
	$_SESSION['imagen_usuario'] = NULL;
	
	session_destroy();
	
	echo 0;
	
	return;
}
else if(isset($_GET['logout'])){
	
	$_SESSION['id_usuario'] = NULL;
	$_SESSION['nombre_usuario'] = NULL;
	$_SESSION['tipo_usuario'] = NULL;
	$_SESSION['imagen_usuario'] = NULL;
	
	session_destroy();
	
	echo 1;
	
	return;
}
else if(isset($_GET['insert'])){
	
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$passw = $_POST['passw'];
	$id_carrera = $_POST['carrera'];
	
	$imagen_name = $_FILES['imagen']['name'];
	$imagen_tmp_name = $_FILES['imagen']['tmp_name'];
		
	$controlador = new Usuarios_Controller();
	
	$resultado = $controlador->insertUsuario($nombre, $correo, $passw, $id_carrera, $imagen_name, $imagen_tmp_name);
	
	if($resultado == 1){
		$_SESSION['nombre_usuario'] = $nombre;
	}
	
	echo $resultado;
}
else{
}


 ?>