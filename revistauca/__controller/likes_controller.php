<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/likes_model.php";
session_start();
class Likes_Controller{

	private $model;	// la clase controlador tiene una instancia de la clase model

	public function __construct(){
		$this->model = new Likes_Model();	// la clase controlador tiene una instancia de la clase model
	}

	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}

	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}



public function insertLikes($id_elemento, $usuario){	// esta funcion es personalizada para abstraer el SQL

$statelike="true";
$statedislike="false";
$sql = "SELECT * FROM noticias WHERE id=" . $id_elemento . " ORDER BY creado DESC;";
$resultado = $this->getResult($sql);
for($i = 0; $i < $resultado->num_rows; $i++)
{
	$resultado->data_seek($i);
	$fila = $resultado->fetch_assoc();
	$sumatoria = $fila['likes']+1;
}
$sql = "INSERT INTO likes (usuario,post,likes,dislikes) values ('$usuario','$id_elemento','$statelike','$statedislike')";
$this->executeStatement($sql);
$sql= "UPDATE noticias SET likes = '" . $sumatoria . "' WHERE id = '".$id_elemento."'";

		return $this->executeStatement($sql);
}

public function insertdisLikes($id_elemento, $usuario){	// esta funcion es personalizada para abstraer el SQL

$statelike="false";
$statedislike="true";
$sql = "SELECT * FROM noticias WHERE id=" . $id_elemento . " ORDER BY creado DESC;";
$resultado = $this->getResult($sql);
for($i = 0; $i < $resultado->num_rows; $i++)
{
	$resultado->data_seek($i);
	$fila = $resultado->fetch_assoc();
	$sumatoria = $fila['nomegusta']+1;
}
$sql = "INSERT INTO likes (usuario,post,likes,dislikes) values ('$usuario','$id_elemento','$statelike','$statedislike')";
$this->executeStatement($sql);
$sql= "UPDATE noticias SET likes = '" . $sumatoria . "' WHERE id = '".$id_elemento."'";

return $this->executeStatement($sql);
	}
	public function existelike($id_elemento, $usuario){	// esta funcion es personalizada para abstraer el SQL

	$statelike="false";
	$statedislike="true";
	$sql = "SELECT * FROM noticias WHERE id=" . $id_elemento . " ORDER BY creado DESC;";
	$resultado = $this->getResult($sql);
	for($i = 0; $i < $resultado->num_rows; $i++)
	{
		$resultado->data_seek($i);
		$fila = $resultado->fetch_assoc();
		$sumatoria = $fila['nomegusta']+1;
		$resta = $fila['likes']-1;

	}

	$sql= "UPDATE noticias SET likes = '" . $resta . "' WHERE id = '".$id_elemento."'";
		$this->executeStatement($sql);
		$sql= "UPDATE noticias SET nomegusta = '" . $sumatoria . "' WHERE id = '".$id_elemento."'";
			$this->executeStatement($sql);
				$sql= "UPDATE likes SET likes = '" . $statelike . "' WHERE post = '".$id_elemento."'AND usuario='".$usuario."'";
				$this->executeStatement($sql);
				$sql= "UPDATE likes SET nomegusta = '" . $statedislike . "' WHERE post = '".$id_elemento."' AND usuario='".$usuario."'";
			return $this->executeStatement($sql);
	}

	public function existedislike($id_elemento, $usuario){	// esta funcion es personalizada para abstraer el SQL

	$statelike="true";
	$statedislike="false";
	$sql = "SELECT * FROM noticias WHERE id=" . $id_elemento . " ORDER BY creado DESC;";
	$resultado = $this->getResult($sql);
	for($i = 0; $i < $resultado->num_rows; $i++)
	{
		$resultado->data_seek($i);
		$fila = $resultado->fetch_assoc();
		$resta = $fila['nomegusta']-1;
		$sumatoria = $fila['likes']+1;

	}



	$sql= "UPDATE noticias SET likes = '" . $sumatoria . "' WHERE id = '".$id_elemento."'";
		$this->executeStatement($sql);
		$sql= "UPDATE noticias SET nomegusta = '" . $resta . "' WHERE id = '".$id_elemento."'";
			$this->executeStatement($sql);
			$sql= "UPDATE likes SET likes = '" . $statelike . "' WHERE post = '".$id_elemento."'AND usuario='".$usuario."'";
			$this->executeStatement($sql);
			$sql= "UPDATE likes SET nomegusta = '" . $statedislike . "' WHERE post = '".$id_elemento."' AND usuario='".$usuario."'";
			return $this->executeStatement($sql);
	}

}



if(isset($_GET['insertlike'])){

	$id_elemento = $_POST['id_elemento'];
	$usuario = $_SESSION['id_usuario'];

	$controlador = new Likes_Controller();

	$resultado = $controlador->insertLikes($id_elemento, $usuario);

	echo $resultado;
}
if(isset($_GET['insertdislike'])){

	$id_elemento = $_POST['id_elemento'];
	$usuario = $_SESSION['id_usuario'];

	$controlador = new Likes_Controller();

	$resultado = $controlador->insertdisLikes($id_elemento, $usuario);

	echo $resultado;
}
if(isset($_GET['existlike'])){

	$id_elemento = $_POST['id_elemento'];
	$usuario = $_SESSION['id_usuario'];

	$controlador = new Likes_Controller();

	$resultado = $controlador->existelike($id_elemento, $usuario);

	echo $resultado;
}
if(isset($_GET['existdislike'])){

	$id_elemento = $_POST['id_elemento'];
	$usuario = $_SESSION['id_usuario'];

	$controlador = new Likes_Controller();

	$resultado = $controlador->existedislike($id_elemento, $usuario);

	echo $resultado;
}


 ?>


