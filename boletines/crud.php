<?php

$nombre_entidad = "boletines";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	if(isset($_GET['boletinesid'])){
		$resultado = $controller->selectBoletines($_GET['boletinesid']);	// devuelve los datos especificos de una sola fila
		$resultado->data_seek(0);
		$fila = $resultado->fetch_assoc();
	}
	else{
		$fila = '';
		$fila['preview'] = "/revistauca/_public/img/blog.png";
		$fila['id_autor'] = $_SESSION['id_usuario'];
	}
	?>
	<div id="boletines_detail<? echo $fila['id']; ?>" class="boletines_detail">
		
		<div id="boletines_detail_media">
			<!--<img src="<? echo $fila['preview'] ?>" />-->
			<img id="boletinesPreviewImg" src="<? echo $fila['preview']; ?>" onclick="document.getElementById('boletinesPreview').click();" style="cursor: pointer;"/>
			<input type="file" id="boletinesPreview" accept="image/" onchange="mostrarImagenBoletines(event);" style="display:none;"/>
		</div>
		
		<div id="boletines_detail_title">
			<h1>Titulo: <input type="text" id="boletinesTitle" class="boletines_textfield" value="<? echo $fila['titulo'] ?>" /></h1>
		</div>
		
		<div class="boletines_detail_author_date">
			<div class="inline">
				<!--<h4 id="boletines_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="boletines_autor_thumbnail">
					<img id="boletines_author_img" src="<? echo $_SESSION['imagen_usuario']; ?>" />
				</div>
			</div>
			<div class="inline">
				<?
				$creado = $fila['creado'];
				$creado = ($creado == '') ? date("d.m.y") : $creado;
				?>
				<h4 id="boletines_detail_date"><? echo $creado; ?></h4>
				<h4 id="boletines_detail_author"><? echo $_SESSION['nombre_usuario']; ?></h4>
			</div>
			
			<script>
				// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
				$.ajax({
					type:"GET",
					url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
					success:function(responseText){
						
						var jsonObject = JSON.parse(responseText);
						jsonObject = jsonObject[0];
						
						$("#boletines_author_img").each(function(){
							$(this).attr("src", jsonObject.imagen);
						});
						
						$("#boletines_detail_author").each(function(){
							$(this).html(jsonObject.nombre);
						});
					}
				});
			</script>
			
		</div>
		
		<div id="boletines_detail_description"> 
			<!--<? echo $fila['contenido']; ?>-->
			<div class="boletines_comment_text" onclick="document.getElementById('boletinesDescription').focus();">
				Escriba una breve descripcion acerca del contenido de la publicacion:<br>
				<div id="boletinesDescription" class="boletines_comment_edittext" contenteditable="true" placeholder="Agrega una descripcion ..." onclick="this.focus();"><? echo $fila['descripcion']; ?></div>
			</div><div id="boletinesId" style="display:none;"></div>
			<script>$("#boletinesId").html('<? echo $fila['id'] ?>');</script>
			<div class="boletines_comment_text" onclick="document.getElementById('boletinesContent').focus();">
				Escriba el contenido de la publicacion:<br>
				<div id="boletinesContent" class="boletines_comment_edittext" contenteditable="true" placeholder="Agrega un contenido ..." onclick="this.focus();"><? echo $fila['contenido']; ?></div>
			</div>
			<div class="boletines_comment_text" onclick="document.getElementById('boletinesArchivo').focus();">
				URL de descarga:<br>
				<div id="boletinesArchivo" class="boletines_comment_edittext" contenteditable="true" placeholder="Agrega una URL ..." onclick="this.focus();"><? echo $fila['archivo']; ?></div>
			</div>
		</div>
		
		<div class="blog_comment_buttons">
			<? $boletinesid = (isset($_GET['boletinesid'])) ? $_GET['boletinesid'] : "''"; ?>
			<div id="btn_enviar" class="custom_btn" onclick="crearBoletines(<? echo $boletinesid; ?>);" style="float:right;margin-right: 10%; margin-bottom: 10%;">
				Publicar
			</div>
			<img id="boletinesDeleteImg" style="width: 50px; height: 0px; float:right; cursor:pointer;" onclick="if(confirm('Seguro que desea eliminar este boletin?')){eliminarBoletines();}" src="/revistauca/_public/img/deleteicon.png">
			
			<script>$("#boletinesDeleteImg").css("height", "50px");</script>
		</div>
		
		
	</div> <!-- end #boletines_detail -->
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>