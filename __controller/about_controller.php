<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/about_model.php";

class About_Controller{
	
	private $model;	// la clase controlador tiene una instancia de la clase model
	
	public function __construct(){
		$this->model = new About_Model();	// la clase controlador tiene una instancia de la clase model
	}
	
	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}
	
	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}
	
	public function selectAbout($id){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM about";
		
		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}
		
		$sql = $sql . " ORDER BY creado DESC;";
		
		return $this->getResult($sql);
	}
	
	public function insertAbout($titulo, $id_autor, $contenido){	// esta funcion es personalizada para abstraer el SQL
		
		$sql = "INSERT INTO about (titulo, id_autor, creado, contenido) VALUES (";
		$sql = $sql . $titulo . "', " . $id_autor .", NULL, '" . $contenido . "');";
		
		if(isset($_GET['aboutid'])){
			$sql = "UPDATE about set titulo='" . $titulo . "', contenido='" . $contenido . "'";
			
			/*if(isset($_GET['delete'])){
				$sql = "DELETE FROM about";
			}*/
			
			$sql .= " WHERE id=" .$_GET['aboutid']. ";";
		}
		
		return $this->executeStatement($sql);
	}
	
	public function deleteAbout($id){
		$sql = "DELETE FROM about WHERE id=" . $id . ";";
		return $this->executeStatement($sql);
	}
	
	public function selectComments($id_padre){	// esta funcion es personalizada para abstraer el SQL
	
		$sql = "SELECT * FROM about_comments WHERE id_padre=" . $id_padre . " ORDER BY creado DESC;";
		
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
	
		$sql = "INSERT INTO about_comments (id_padre, id_autor, creado, comentario) VALUES (";
		$sql = $sql . $id_padre . ", " . $id_autor . ", NULL, '" . $comentario . "');";
		
		return $this->executeStatement($sql);
	}
	
}


session_start();


if(isset($_GET['select'])){
	
	$controlador = new About_Controller();
	
	$resultado = null;
	
	if(isset($_GET['aboutid'])){
		$aboutId = $_GET['aboutid'];
		if(isset($_GET['comments'])){
			$resultado = $controlador->selectComments($aboutId);	// devuelve los comentarios especificos de de la tabla comments
		}
		else{
			$resultado = $controlador->selectAbout($aboutId);	// devuelve los datos especificos de una sola fila de la tabla about
		}
	}
	else{
		$resultado = $controlador->selectAbout(0);	// devuelve los datos de todas las filas
	}
	
	if(isset($_GET['json'])){
		echo json_encode($resultado);
	}
	else{
		
		for($i = 0; $i < $resultado->num_rows; $i++){
			$resultado->data_seek($i);
			$fila = $resultado->fetch_assoc();
			?>
			<div class="about_item" id="about_item_<? echo $fila['id'] ?>">
			
				<!--<div class="about_item_half about_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>-->
				
				<div class="about_item_half">
					<div class="about_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="about_item_author_date">
						<div class="about_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="about_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->
					
					<div class="about_detail_author_date">
						<div class="inline">
							<!--<h4 id="about_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="about_autor_thumbnail">
								<img id="about_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="about_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="about_detail_author">...</h4>
						</div>
						
						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){
									
									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];
									
									$("#about_item_<? echo $fila['id'] ?> #about_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});
									
									$("#about_item_<? echo $fila['id'] ?> #about_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
						</script>
						
					</div>
					
					
					<div class="about_item_description about_item_word_break"> 
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
	$contenido = $_POST['contenido'];
	
	$controlador = new About_Controller();
	
	$resultado = $controlador->insertAbout($titulo, $id_autor, $contenido);
	
	echo $resultado;
}
else if(isset($_GET['delete'])){
	
	if(isset($_GET['aboutid'])){
		$controlador = new About_Controller();
	
		$resultado = $controlador->deleteAbout($_GET['aboutid']);
		
		echo $resultado;
		return;
	}
	
	echo "0";
}
else if(isset($_GET['newcomment'])){
	
	$id_padre = $_POST['id_padre'];
	$id_autor = $_SESSION['id_usuario'];
	$comentario = $_POST['comentario'];
	
	$controlador = new About_Controller();
	
	$resultado = $controlador->insertComment($id_padre, $id_autor, $comentario);
	
	echo $resultado;
}
else{
}


 ?>