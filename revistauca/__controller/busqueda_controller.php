<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__model/busqueda_model.php";

class Busqueda_Controller{

	private $model;	// la clase controlador tiene una instancia de la clase model

	public function __construct(){
		$this->model = new Busqueda_Model();	// la clase controlador tiene una instancia de la clase model
	}

	public function getResult($select_sql){	// esta funcion obtiene un resultado cuando se usa un select
		return $this->model->getResult($select_sql);
	}

	public function executeStatement($sql){	// esta funcion obtiene un resultado cuando se usa un insert, update o delete ...
		return $this->model->executeStatement($sql);
	}

	public function selectRevista($id){	// esta funcion es personalizada para abstraer el SQL

		$sql = "SELECT * FROM ucaprofesional";

		if($id > 0){
			$sql = $sql . " WHERE id=" . $id . "";
		}

		$sql = $sql . " ORDER BY creado DESC;";

		return $this->getResult($sql);
	}

	public function selectucaprofesional($name){	// esta funcion es personalizada para abstraer el SQL

		$sql = "SELECT * FROM ucaprofesional WHERE titulo  LIKE '%$name%'
		OR titulo  LIKE '%$name%'
		OR descripcion LIKE '%$name%'
		OR contenido LIKE '%$name%'
		OR creado LIKE '%$name%' ";


		$sql = $sql . " ORDER BY creado DESC;";

		return $this->getResult($sql);
	}
	public function selecteducar($name){	// esta funcion es personalizada para abstraer el SQL

		$sql = "SELECT * FROM educar WHERE titulo  LIKE '%$name%'
		OR titulo  LIKE '%$name%'
		OR descripcion LIKE '%$name%'
		OR contenido LIKE '%$name%'
		OR creado LIKE '%$name%' ";


		$sql = $sql . " ORDER BY creado DESC;";

		return $this->getResult($sql);
	}
	public function selectentrecontadores($name){	// esta funcion es personalizada para abstraer el SQL

		$sql = "SELECT * FROM entrecontadores WHERE titulo  LIKE '%$name%'
		OR titulo  LIKE '%$name%'
		OR descripcion LIKE '%$name%'
		OR contenido LIKE '%$name%'
		OR creado LIKE '%$name%' ";


		$sql = $sql . " ORDER BY creado DESC;";

		return $this->getResult($sql);
	}
	public function selectnoticias($name){	// esta funcion es personalizada para abstraer el SQL

		$sql = "SELECT * FROM noticias WHERE titulo  LIKE '%$name%'
		OR titulo  LIKE '%$name%'
		OR descripcion LIKE '%$name%'
		OR contenido LIKE '%$name%'
		OR creado LIKE '%$name%' ";


		$sql = $sql . " ORDER BY creado DESC;";

		return $this->getResult($sql);
	}
	public function selectboletines($name){	// esta funcion es personalizada para abstraer el SQL

		$sql = "SELECT * FROM boletines WHERE titulo  LIKE '%$name%'
		OR titulo  LIKE '%$name%'
		OR descripcion LIKE '%$name%'
		OR contenido LIKE '%$name%'
		OR creado LIKE '%$name%' ";


		$sql = $sql . " ORDER BY creado DESC;";

		return $this->getResult($sql);
	}

}



if(isset($_GET['select'])){

	$controlador = new Busqueda_Controller();

	  $resultado = null;
    $name = $_POST['name'];
		$resultado = $controlador->selectucaprofesional($name);	// devuelve los datos de todas las filas
    $resultado2 = $controlador->selecteducar($name);
		$resultado3 = $controlador->selectentrecontadores($name);
		$resultado4 = $controlador->selectboletines($name);
		$resultado5 = $controlador->selectnoticias($name);

		for($i = 0; $i < $resultado->num_rows; $i++){
			$resultado->data_seek($i);
			$fila = $resultado->fetch_assoc();
			?>
			<div class="ucaprofesional_item" id="ucaprofesional_item_<? echo $fila['id'] ?>" onclick="showUcaProfesional(<? echo $fila['id']; ?>);">

				<div class="ucaprofesional_item_half ucaprofesional_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>

				<div class="ucaprofesional_item_half">
					<div class="ucaprofesional_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="ucaprofesional_item_author_date">
						<div class="ucaprofesional_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="ucaprofesional_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->

					<div class="ucaprofesional_detail_author_date">
						<div class="inline">
							<!--<h4 id="ucaprofesional_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="ucaprofesional_autor_thumbnail">
								<img id="ucaprofesional_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="ucaprofesional_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="ucaprofesional_detail_author">...</h4>
						</div>

						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){

									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];

									$("#ucaprofesional_item_<? echo $fila['id'] ?> #ucaprofesional_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});

									$("#ucaprofesional_item_<? echo $fila['id'] ?> #ucaprofesional_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
						</script>

					</div>


					<div class="ucaprofesional_item_description ucaprofesional_item_word_break">
						<? echo $fila['descripcion'] ?>
					</div>
				</div>

			</div> <!-- end .blog_item -->
		<? } // end for
		for($i = 0; $i < $resultado2->num_rows; $i++){
			$resultado2->data_seek($i);
			$fila = $resultado2->fetch_assoc();
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
		for($i = 0; $i < $resultado3->num_rows; $i++){
			$resultado3->data_seek($i);
			$fila = $resultado3->fetch_assoc();
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
						</script>

					</div>


					<div class="entrecontadores_item_description entrecontadores_item_word_break">
						<? echo $fila['descripcion'] ?>
					</div>
				</div>

			</div> <!-- end .blog_item -->
		<? } // end for
		for($i = 0; $i < $resultado4->num_rows; $i++){
			$resultado4->data_seek($i);
			$fila = $resultado4->fetch_assoc();
			?>
			<div class="boletines_item" id="boletines_item_<? echo $fila['id'] ?>" onclick="showBoletines(<? echo $fila['id']; ?>);">

				<div class="boletines_item_half boletines_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>

				<div class="boletines_item_half">
					<div class="boletines_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="boletines_item_author_date">
						<div class="boletines_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="boletines_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->

					<div class="boletines_detail_author_date">
						<div class="inline">
							<!--<h4 id="boletines_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="boletines_autor_thumbnail">
								<img id="boletines_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="boletines_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="boletines_detail_author">...</h4>
						</div>

						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){

									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];

									$("#boletines_item_<? echo $fila['id'] ?> #boletines_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});

									$("#boletines_item_<? echo $fila['id'] ?> #boletines_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
						</script>

					</div>


					<div class="boletines_item_description boletines_item_word_break">
						<? echo $fila['descripcion'] ?>
					</div>
				</div>

			</div> <!-- end .blog_item -->
		<? } // end for
		for($i = 0; $i < $resultado5->num_rows; $i++){
			$resultado5->data_seek($i);
			$fila = $resultado5->fetch_assoc();
			?>
			<div class="noticia_item" id="noticia_item_<? echo $fila['id'] ?>" onclick="showNoticia(<? echo $fila['id']; ?>);">

				<div class="noticia_item_half noticia_item_preview">
					<img src="<? echo $fila['preview'] ?>" />
				</div>

				<div class="noticia_item_half">
					<div class="noticia_item_title">
						<h2><? echo $fila['titulo'] ?></h2>
					</div>
					<!--<div class="noticia_item_author_date">
						<div class="noticia_item_author">
							<h4><? echo $fila['id_autor'] ?></h4>
						</div>
						<div class="noticia_item_date">
							<h5><? echo $fila['creado'] ?></h5>
						</div>
					</div>-->

					<div class="noticia_detail_author_date">
						<div class="inline">
							<!--<h4 id="noticia_detail_author"><? echo $fila['id_autor']; ?></h4>-->
							<div class="noticia_autor_thumbnail">
								<img id="noticia_author_img" src="<? echo $fila['preview']; ?>" />
							</div>
						</div>
						<div class="inline">
							<h4 id="noticia_detail_date"><? echo $fila['creado']; ?></h4>
							<h4 id="noticia_detail_author">...</h4>
						</div>

						<script>
							// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
							$.ajax({
								type:"GET",
								url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
								success:function(responseText){

									var jsonObject = JSON.parse(responseText);
									jsonObject = jsonObject[0];

									$("#noticia_item_<? echo $fila['id'] ?> #noticia_author_img").each(function(){
										$(this).attr("src", jsonObject.imagen);
									});

									$("#noticia_item_<? echo $fila['id'] ?> #noticia_detail_author").each(function(){
										$(this).html(jsonObject.nombre);
									});
								}
							});
						</script>

					</div>


					<div class="noticia_item_description noticia_item_word_break">
						<? echo $fila['descripcion'] ?>
					</div>
				</div>

			</div> <!-- end .blog_item -->
		<? } // end for
	}



 ?>
