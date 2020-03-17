<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/machotes_model.php";

class Machotes_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new Machotes_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function selectMachote($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM machotes";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . " ORDER BY creado DESC;";
		
		return $this->getResult($sql);
	}
	
	public function insertMachote($titulo, $id_autor, $descripcion, $contenido, $preview_name, $preview_tmp_name){	// esta funcion es personalizada para abstraer el SQL
		
		$final_preview_name = basename($preview_tmp_name) . $preview_name;
		$preview = '/revistauca/_public/img/blog.png';
		$preview = ($final_preview_name == '') ? $preview : '/revistauca/__controller/machoteuploads/' . $final_preview_name;
		
		$sql = "INSERT INTO machotes (preview, titulo, id_autor, creado, descripcion, contenido) VALUES (";
		$sql = $sql . "'" .$preview. "', '" . $titulo . "', " . $id_autor .", NULL, '" . $descripcion . "', '" . $contenido . "');";
		
		if(isset($_GET['machoteid'])){
			
			if($_FILES['preview']['name'] == '')
				$sql = "UPDATE machotes set titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			else{
				$sql = "UPDATE machotes set preview='" .$preview. "', titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			}
			
			/*if(isset($_GET['delete'])){
				$sql = "DELETE FROM machotes";
			}*/
			
			$sql .= " WHERE id=" .$_GET['machoteid']. ";";
		}
		
		move_uploaded_file($preview_tmp_name, 'machoteuploads/' . $final_preview_name);
		
		return $this->executeStatement($sql);
	}
	
	public function deleteMachote($id){
		$sql = "DELETE FROM machotes WHERE id=" . $id . ";";
		return $this->executeStatement($sql);
	}
	
	public function selectComments($id_padre){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM comments WHERE id_padre=" . $id_padre . " ORDER BY creado DESC;";
		
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
	
		$sql = "INSERT INTO comments (id_padre, id_autor, creado, comentario) VALUES (";
		$sql = $sql . $id_padre . ", " . $id_autor . ", NULL, '" . $comentario . "');";
		
		return $this->executeStatement($sql);
	}
	
}


session_start();


if(isset($_GET['select'])){
	
	$controlador = new Machotes_Controller();
	
	$resultado = null;
	
	if(isset($_GET['machoteid'])){
		$machoteId = $_GET['machoteid'];
		if(isset($_GET['comments'])){
			$resultado = $controlador->selectComments($machoteId);	// devuelve los comentarios especificos de de la tabla comments
		}
		else{
			$resultado = $controlador->selectMachote($machoteId);	// devuelve los datos especificos de una sola fila de la tabla machotes
		}
	}
	else{
		$resultado = $controlador->selectMachote(0);	// devuelve los datos de todas las filas
	}
	
	if(isset($_GET['json'])){
		echo json_encode($resultado);
	}
	else{
		
		for($i = 0; $i < $resultado->num_rows; $i++){
			$resultado->data_seek($i);
			$fila = $resultado->fetch_assoc();
			?>
			<div class="machote_item" id="machote_item_<? echo $fila['id'] ?>" onclick="showMachote(<? echo $fila['id']; ?>);">
			
				<div class="machote_item_half machote_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>
				
				<div class="machote_item_half">
					<div class="machote_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="machote_item_author_date">
						<div class="machote_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="machote_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->
					
					<div class="machote_detail_author_date">
						<div class="inline">
							<!--<h4 id="machote_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="machote_autor_thumbnail">
								<img id="machote_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="machote_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="machote_detail_author">...</h4>
						</div>
						
						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){
									
									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];
									
									$("#machote_item_<? echo $fila['id'] ?> #machote_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});
									
									$("#machote_item_<? echo $fila['id'] ?> #machote_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
						</script>
						
					</div>
					
					
					<div class="machote_item_description machote_item_word_break"> 
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
	
	$controlador = new Machotes_Controller();
	
	$resultado = $controlador->insertMachote($titulo, $id_autor, $descripcion, $contenido, $preview_name, $preview_tmp_name);
	
	echo $resultado;
}
else if(isset($_GET['delete'])){
	
	if(isset($_GET['machoteid'])){
		$controlador = new Machotes_Controller();
	
		$resultado = $controlador->deleteMachote($_GET['machoteid']);
		
		echo $resultado;
		return;
	}
	
	echo "0";
}
else if(isset($_GET['newcomment'])){
	
	$id_padre = $_POST['id_padre'];
	$id_autor = $_SESSION['id_usuario'];
	$comentario = $_POST['comentario'];
	
	$controlador = new Machotes_Controller();
	
	$resultado = $controlador->insertComment($id_padre, $id_autor, $comentario);
	
	echo $resultado;
}
else{
}


 ?>