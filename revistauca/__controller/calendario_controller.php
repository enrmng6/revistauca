<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/calendario_model.php";

class Calendario_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new Calendario_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function selectCalendario($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM calendario";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . " ORDER BY creado DESC;";
		
		return $this->getResult($sql);
	}
	
	public function insertCalendario($titulo, $id_autor, $descripcion, $contenido, $preview_name, $preview_tmp_name){	// esta funcion es personalizada para abstraer el SQL
		
		/*$final_preview_name = basename($preview_tmp_name) . $preview_name;
		$preview = '/revistauca/_public/img/blog.png';
		$preview = ($final_preview_name == '') ? $preview : '/revistauca/__controller/calendariouploads/' . $final_preview_name;
		
		$sql = "INSERT INTO calendarios (preview, titulo, id_autor, creado, descripcion, contenido) VALUES (";
		$sql = $sql . "'" .$preview. "', '" . $titulo . "', " . $id_autor .", NULL, '" . $descripcion . "', '" . $contenido . "');";
		
		if(isset($_GET['calendarioid'])){
			
			if($_FILES['preview']['name'] == '')
				$sql = "UPDATE calendarios set titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			else{
				$sql = "UPDATE calendarios set preview='" .$preview. "', titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			}
			
			$sql .= " WHERE id=" .$_GET['calendarioid']. ";";
		}
		
		move_uploaded_file($preview_tmp_name, 'calendariouploads/' . $final_preview_name);
		
		return $this->executeStatement($sql);*/
	}
	
	public function deleteCalendario($id){
		/*$sql = "DELETE FROM calendario WHERE id=" . $id . ";";
		return $this->executeStatement($sql);*/
	}
	
}


session_start();


if(isset($_GET['select'])){
	
	$controlador = new Calendario_Controller();
	
	$resultado = null;
	
	if(isset($_GET['calendarioid'])){
		$calendarioId = $_GET['calendarioid'];
		if(isset($_GET['comments'])){
			$resultado = $controlador->selectComments($calendarioId);	// devuelve los comentarios especificos de de la tabla comments
		}
		else{
			$resultado = $controlador->selectCalendario($calendarioId);	// devuelve los datos especificos de una sola fila de la tabla calendarios
		}
	}
	else{
		$resultado = $controlador->selectCalendario(0);	// devuelve los datos de todas las filas
	}
	
	if(isset($_GET['json'])){
		echo json_encode($resultado);
	}
	else{
		
		for($i = 0; $i < $resultado->num_rows; $i++){
			$resultado->data_seek($i);
			$fila = $resultado->fetch_assoc();
			?>
			<div class="calendario_item" id="calendario_item_<? echo $fila['id'] ?>" onclick="showCalendario(<? echo $fila['id']; ?>);">
			
				<div class="calendario_item_half calendario_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>
				
				<div class="calendario_item_half">
					<div class="calendario_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="calendario_item_author_date">
						<div class="calendario_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="calendario_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->
					
					<div class="calendario_detail_author_date">
						<div class="inline">
							<!--<h4 id="calendario_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="calendario_autor_thumbnail">
								<img id="calendario_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="calendario_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="calendario_detail_author">...</h4>
						</div>
						
						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){
									
									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];
									
									$("#calendario_item_<? echo $fila['id'] ?> #calendario_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});
									
									$("#calendario_item_<? echo $fila['id'] ?> #calendario_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
						</script>
						
					</div>
					
					
					<div class="calendario_item_description calendario_item_word_break"> 
						<? echo $fila['descripcion'] ?>
					</div>
				</div>
			
			</div> <!-- end .blog_item -->
		<? } // end for
	}
}
else if(isset($_GET['insert'])){
	
	//$preview = ($_FILES['preview']['name'] == '') ? '/revistauca/_public/img/blog.png' : '/revistauca/blog/postsuploads/' . $_FILES['preview']['name'];
	$titulo = $_POST['titulo'];
	$id_autor = $_SESSION['id_usuario'];
	$descripcion = $_POST['descripcion'];
	$contenido = $_POST['contenido'];
	
	$preview_name = $_FILES['preview']['name'];
	$preview_tmp_name = $_FILES['preview']['tmp_name'];
	
	$controlador = new calendarios_Controller();
	
	$resultado = $controlador->insertcalendario($titulo, $id_autor, $descripcion, $contenido, $preview_name, $preview_tmp_name);
	
	echo $resultado;
}
else if(isset($_GET['delete'])){
	
	if(isset($_GET['calendarioid'])){
		$controlador = new calendarios_Controller();
	
		$resultado = $controlador->deletecalendario($_GET['calendarioid']);
		
		echo $resultado;
		return;
	}
	
	echo "0";
}
else if(isset($_GET['newcomment'])){
	
	$id_padre = $_POST['id_padre'];
	$id_autor = $_SESSION['id_usuario'];
	$comentario = $_POST['comentario'];
	
	$controlador = new calendarios_Controller();
	
	$resultado = $controlador->insertComment($id_padre, $id_autor, $comentario);
	
	echo $resultado;
}
else{
}


 ?>