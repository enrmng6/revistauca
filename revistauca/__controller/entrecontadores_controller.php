<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/entrecontadores_model.php";

class EntreContadores_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new EntreContadores_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function selectEntreContadores($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM entrecontadores";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . " ORDER BY creado DESC;";
		
		return $this->getResult($sql);
	}
	
	public function insertEntreContadores($titulo, $id_autor, $descripcion, $contenido, $url_archivo, $preview_name, $preview_tmp_name){	// esta funcion es personalizada para abstraer el SQL
		
		$final_preview_name = basename($preview_tmp_name) . $preview_name;
		$preview = '/revistauca/_public/img/blog.png';
		$preview = ($final_preview_name == '') ? $preview : '/revistauca/__controller/revistas/entrecontadoresuploads/' . $final_preview_name;
		
		$sql = "INSERT INTO entrecontadores (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES (";
		$sql = $sql . "'" .$preview. "', '" . $url_archivo . "', '" . $titulo . "', " . $id_autor .", NULL, '" . $descripcion . "', '" . $contenido . "');";
		
		if(isset($_GET['entrecontadoresid'])){
			
			if($_FILES['preview']['name'] == '')
				$sql = "UPDATE entrecontadores set archivo='" . $url_archivo . "', titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			else{
				$sql = "UPDATE entrecontadores set preview='" .$preview. "', archivo='" . $url_archivo . "', titulo='" . $titulo . "', descripcion='" . $descripcion . "', contenido='" . $contenido . "'";
			}
			
			/*if(isset($_GET['delete'])){
				$sql = "DELETE FROM entrecontadoress";
			}*/
			
			$sql .= " WHERE id=" .$_GET['entrecontadoresid']. ";";
		}
		
		move_uploaded_file($preview_tmp_name, 'revistas/entrecontadoresuploads/' . $final_preview_name);
		
		return $this->executeStatement($sql);
	}
	
	public function deleteEntreContadores($id){
		$sql = "DELETE FROM entrecontadores WHERE id=" . $id . ";";
		return $this->executeStatement($sql);
	}
	
	public function selectComments($id_padre){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM entrecontadores_comments WHERE id_padre=" . $id_padre . " ORDER BY creado DESC;";
		
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
	
		$sql = "INSERT INTO entrecontadores_comments (id_padre, id_autor, creado, comentario) VALUES (";
		$sql = $sql . $id_padre . ", " . $id_autor . ", NULL, '" . $comentario . "');";
		
		return $this->executeStatement($sql);
	}
	
	public function deleteComment($id){
		$sql = "DELETE FROM entrecontadores_comments WHERE id=" . $id . ";";
		return $this->executeStatement($sql);
	}
	
}


session_start();


if(isset($_GET['select'])){
	
	$controlador = new EntreContadores_Controller();
	
	$resultado = null;
	
	if(isset($_GET['entrecontadoresid'])){
		$entrecontadoresId = $_GET['entrecontadoresid'];
		if(isset($_GET['comments'])){
			$resultado = $controlador->selectComments($entrecontadoresId);	// devuelve los comentarios especificos de de la tabla comments
		}
		else{
			$resultado = $controlador->selectEntreContadores($entrecontadoresId);	// devuelve los datos especificos de una sola fila de la tabla entrecontadoress
		}
	}
	else{
		$resultado = $controlador->selectEntreContadores(0);	// devuelve los datos de todas las filas
	}
	
	if(isset($_GET['json'])){
		echo json_encode($resultado);
	}
	else{
		
		for($i = 0; $i < $resultado->num_rows; $i++){
			$resultado->data_seek($i);
			$fila = $resultado->fetch_assoc();
			?>
			<div class="entrecontadores_item" id="entrecontadores_item_<? echo $fila['id'] ?>" onclick="showEntreContadores(<? echo $fila['id']; ?>);">
			
				<div class="entrecontadores_item_half entrecontadores_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>
				
				<div class="entrecontadores_item_half">
					<div class="entrecontadores_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="entrecontadores_item_author_date">
						<div class="entrecontadores_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="entrecontadores_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->
					
					<div class="entrecontadores_detail_author_date">
						<div class="inline">
							<!--<h4 id="entrecontadores_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="entrecontadores_autor_thumbnail">
								<img id="entrecontadores_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="entrecontadores_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="entrecontadores_detail_author">...</h4>
							<h5><span id="numeroVisitas"></span></h5>
						</div>
						
						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){
									
									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];
									
									$("#entrecontadores_item_<? echo $fila['id'] ?> #entrecontadores_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});
									
									$("#entrecontadores_item_<? echo $fila['id'] ?> #entrecontadores_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
							
							// CODIGO PARA CARGAR EL NUMERO DE VISITAS VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/visitas_controller.php?numeroVisitas&id_elemento=" + <? echo $fila['id'] ?> + "&entidad=entrecontadores",
								success:function(responseText){
									$("#entrecontadores_item_<? echo $fila['id'] ?> #numeroVisitas").each(function(){
										var respuesta = responseText * 1;//JSON.parse(responseText);
										if(respuesta == 1){
											$(this).text("1 visita");
										}
										else if(respuesta > 1){
											$(this).text(respuesta + " visitas");
										}
									});
									
								}
							});
						</script>
						
					</div>
					
					
					<div class="entrecontadores_item_description entrecontadores_item_word_break"> 
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
	
	$controlador = new EntreContadores_Controller();
	
	$resultado = $controlador->insertEntreContadores($titulo, $id_autor, $descripcion, $contenido, $url_archivo, $preview_name, $preview_tmp_name);
	
	echo $resultado;
}
else if(isset($_GET['delete'])){
	
	if(isset($_GET['entrecontadoresid'])){
		$controlador = new EntreContadores_Controller();
	
		$resultado = $controlador->deleteEntreContadores($_GET['entrecontadoresid']);
		
		echo $resultado;
		return;
	}
	
	echo "0";
}
else if(isset($_GET['newcomment'])){
	
	$id_padre = $_POST['id_padre'];
	$id_autor = $_SESSION['id_usuario'];
	$comentario = $_POST['comentario'];
	
	$controlador = new EntreContadores_Controller();
	
	$resultado = $controlador->insertComment($id_padre, $id_autor, $comentario);
	
	echo $resultado;
}
else if(isset($_GET['deletecomment'])){
	
	//$id_padre = $_POST['id_padre'];
	$comentario = $_POST['comentario'];
	
	$controlador = new EntreContadores_Controller();
	
	$resultado = $controlador->deleteComment($comentario);
	
	echo $resultado;
}
else{
}


 ?>