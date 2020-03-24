<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/educar_model.php";

class Educar_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new Educar_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function selectEducar($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM educar";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . " ORDER BY creado DESC;";
		
		return $this->getResult($sql);
	}
	
	public function insertEducar($titulo, $id_autor, $descripcion, $contenido, $url_archivo, $preview_name, $preview_tmp_name){	// esta funcion es personalizada para abstraer el SQL
		
		$final_preview_name = basename($preview_tmp_name) . $preview_name;
		$preview = '/revistauca/_public/img/blog.png';
		$preview = ($final_preview_name == '') ? $preview : '/revistauca/__controller/revistas/educaruploads/' . $final_preview_name;
		
		$sql = "INSERT INTO educar (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES (";
		$sql = $sql . "'" .$preview. "', '" . $url_archivo . "', '" . $titulo . "', " . $id_autor .", NULL, '" . $descripcion . "', '" . $contenido . "');";
		
		if(isset($_GET['educarid'])){
			
			if($_FILES['preview']['name'] == '')
				$sql = "UPDATE educar set archivo='" . $url_archivo . "', titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			else{
				$sql = "UPDATE educar set preview='" .$preview. "', archivo='" . $url_archivo . "', titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			}
			
			/*if(isset($_GET['delete'])){
				$sql = "DELETE FROM educars";
			}*/
			
			$sql .= " WHERE id=" .$_GET['educarid']. ";";
		}
		
		move_uploaded_file($preview_tmp_name, 'revistas/educaruploads/' . $final_preview_name);
		
		return $this->executeStatement($sql);
	}
	
	public function deleteEducar($id){
		$sql = "DELETE FROM educar WHERE id=" . $id . ";";
		return $this->executeStatement($sql);
	}
	
	public function selectComments($id_padre){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM educar_comments WHERE id_padre=" . $id_padre . " ORDER BY creado DESC;";
		
		$resultado = $this->getResult($sql);
		
		$row_count->row_count = $resultado->num_rows;
		
		$resultadoFinal = array();
		array_push($resultadoFinal, $row_count);
		
		$arregloFilas = array();
		for($i = 0; $i < $resultado->num_rows; $i++)
		{
			$resultado->data_seek($i);
			$fila = $resultado->fetch_assoc();
			$fila['id'] = $fila['id'] + 0;
			$fila['id_padre'] = $fila['id_post'] + 0;
			$fila['id_autor'] = $fila['id_autor'] + 0;
			array_push($arregloFilas, $fila);
		}
		
		array_push($resultadoFinal, $arregloFilas);
		
		return $resultadoFinal;
	}
	
	public function insertComment($id_padre, $id_autor, $comentario){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "INSERT INTO educar_comments (id_padre, id_autor, creado, comentario) VALUES (";
		$sql = $sql . $id_padre . ", " . $id_autor . ", NULL, '" . $comentario . "');";
		
		return $this->executeStatement($sql);
	}
	
	public function deleteComment($id){
		$sql = "DELETE FROM educar_comments WHERE id=" . $id . ";";
		return $this->executeStatement($sql);
	}
	
}


session_start();


if(isset($_GET['select'])){
	
	$controlador = new Educar_Controller();
	
	$resultado = null;
	
	if(isset($_GET['educarid'])){
		$educarId = $_GET['educarid'];
		if(isset($_GET['comments'])){
			$resultado = $controlador->selectComments($educarId);	// devuelve los comentarios especificos de de la tabla comments
		}
		else{
			$resultado = $controlador->selectEducar($educarId);	// devuelve los datos especificos de una sola fila de la tabla educars
		}
	}
	else{
		$resultado = $controlador->selectEducar(0);	// devuelve los datos de todas las filas
	}
	
	if(isset($_GET['json'])){
		echo json_encode($resultado);
	}
	else{
		
		for($i = 0; $i < $resultado->num_rows; $i++){
			$resultado->data_seek($i);
			$fila = $resultado->fetch_assoc();
			?>
			<div class="educar_item" id="educar_item_<? echo $fila['id'] ?>" onclick="showEducar(<? echo $fila['id']; ?>);">
			
				<div class="educar_item_half educar_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>
				
				<div class="educar_item_half">
					<div class="educar_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="educar_item_author_date">
						<div class="educar_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="educar_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->
					
					<div class="educar_detail_author_date">
						<div class="inline">
							<!--<h4 id="educar_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="educar_autor_thumbnail">
								<img id="educar_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="educar_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="educar_detail_author">...</h4>
						</div>
						
						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){
									
									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];
									
									$("#educar_item_<? echo $fila['id'] ?> #educar_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});
									
									$("#educar_item_<? echo $fila['id'] ?> #educar_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
						</script>
						
					</div>
					
					
					<div class="educar_item_description educar_item_word_break"> 
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
	
	$url_archivo = $_POST['archivo'];
	
	$preview_name = $_FILES['preview']['name'];
	$preview_tmp_name = $_FILES['preview']['tmp_name'];
	
	$controlador = new Educar_Controller();
	
	$resultado = $controlador->insertEducar($titulo, $id_autor, $descripcion, $contenido, $url_archivo, $preview_name, $preview_tmp_name);
	
	echo $resultado;
}
else if(isset($_GET['delete'])){
	
	if(isset($_GET['educarid'])){
		$controlador = new Educar_Controller();
	
		$resultado = $controlador->deleteEducar($_GET['educarid']);
		
		echo $resultado;
		return;
	}
	
	echo "0";
}
else if(isset($_GET['newcomment'])){
	
	$id_padre = $_POST['id_padre'];
	$id_autor = $_SESSION['id_usuario'];
	$comentario = $_POST['comentario'];
	
	$controlador = new Educar_Controller();
	
	$resultado = $controlador->insertComment($id_padre, $id_autor, $comentario);
	
	echo $resultado;
}
else if(isset($_GET['deletecomment'])){
	
	//$id_padre = $_POST['id_padre'];
	$comentario = $_POST['comentario'];
	
	$controlador = new Educar_Controller();
	
	$resultado = $controlador->deleteComment($comentario);
	
	echo $resultado;
}
else{
}


 ?>