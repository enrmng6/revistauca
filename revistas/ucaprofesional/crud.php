<?php

$nombre_entidad = "ucaprofesional";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	if(isset($_GET['ucaprofesionalid'])){
		$resultado = $controller->selectUcaProfesional($_GET['ucaprofesionalid']);	// devuelve los datos especificos de una sola fila
		$resultado->data_seek(0);
		$fila = $resultado->fetch_assoc();
	}
	else{
		$fila = '';
		$fila['preview'] = "/revistauca/_public/img/blog.png";
		$fila['id_autor'] = $_SESSION['id_usuario'];
	}
	?>
	<div id="ucaprofesional_detail<? echo $fila['id']; ?>" class="ucaprofesional_detail">
		
		<div id="ucaprofesional_detail_media">
			<!--<img src="<? echo $fila['preview'] ?>" />-->
			<img id="ucaprofesionalPreviewImg" src="<? echo $fila['preview']; ?>" onclick="document.getElementById('ucaprofesionalPreview').click();" style="cursor: pointer;"/>
			<input type="file" id="ucaprofesionalPreview" accept="image/" onchange="mostrarImagenUcaProfesional(event);" style="display:none;"/>
		</div>
		
		<div id="ucaprofesional_detail_title">
			<h1>Titulo: <input type="text" id="ucaprofesionalTitle" class="ucaprofesional_textfield" value="<? echo $fila['titulo'] ?>" /></h1>
		</div>
		
		<div class="ucaprofesional_detail_author_date">
			<div class="inline">
				<!--<h4 id="ucaprofesional_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="ucaprofesional_autor_thumbnail">
					<img id="ucaprofesional_author_img" src="<? echo $_SESSION['imagen_usuario']; ?>" />
				</div>
			</div>
			<div class="inline">
				<?
				$creado = $fila['creado'];
				$creado = ($creado == '') ? date("d.m.y") : $creado;
				?>
				<h4 id="ucaprofesional_detail_date"><? echo $creado; ?></h4>
				<h4 id="ucaprofesional_detail_author"><? echo $_SESSION['nombre_usuario']; ?></h4>
			</div>
			
			<script>
				// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
				$.ajax({
					type:"GET",
					url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
					success:function(responseText){
						
						var jsonObject = JSON.parse(responseText);
						jsonObject = jsonObject[0];
						
						$("#ucaprofesional_author_img").each(function(){
							$(this).attr("src", jsonObject.imagen);
						});
						
						$("#ucaprofesional_detail_author").each(function(){
							$(this).html(jsonObject.nombre);
						});
					}
				});
			</script>
			
		</div>
		
		<div id="ucaprofesional_detail_description"> 
			<!--<? echo $fila['contenido']; ?>-->
			<div class="ucaprofesional_comment_text" onclick="document.getElementById('ucaprofesionalDescription').focus();">
				Escriba una breve descripcion acerca del contenido de la publicacion:<br>
				<div id="ucaprofesionalDescription" class="ucaprofesional_comment_edittext" contenteditable="true" placeholder="Agrega una descripcion ..." onclick="this.focus();"><? echo $fila['descripcion']; ?></div>
			</div><div id="ucaprofesionalId" style="display:none;"></div>
			<script>$("#ucaprofesionalId").html('<? echo $fila['id'] ?>');</script>
			<div class="ucaprofesional_comment_text" onclick="document.getElementById('ucaprofesionalContent').focus();">
				Escriba el contenido de la publicacion:<br>
				<div id="ucaprofesionalContent" class="ucaprofesional_comment_edittext" contenteditable="true" placeholder="Agrega un contenido ..." onclick="this.focus();"><? echo $fila['contenido']; ?></div>
			</div>
			<div class="ucaprofesional_comment_text" onclick="document.getElementById('ucaprofesionalArchivo').focus();">
				URL de descarga:<br>
				<div id="ucaprofesionalArchivo" class="ucaprofesional_comment_edittext" contenteditable="true" placeholder="Agrega una URL ..." onclick="this.focus();"><? echo $fila['archivo']; ?></div>
			</div>
		</div>
		
		<div class="blog_comment_buttons">
			<? $ucaprofesionalid = (isset($_GET['ucaprofesionalid'])) ? $_GET['ucaprofesionalid'] : "''"; ?>
			<div id="btn_enviar" class="custom_btn" onclick="crearUcaProfesional(<? echo $ucaprofesionalid; ?>);" style="float:right;margin-right: 10%; margin-bottom: 10%;">
				Publicar
			</div>
			<img id="ucaprofesionalDeleteImg" style="width: 50px; height: 0px; float:right; cursor:pointer;" onclick="if(confirm('Seguro que desea eliminar esta revista?')){eliminarUcaProfesional();}" src="/revistauca/_public/img/deleteicon.png">
			
			<script>$("#ucaprofesionalDeleteImg").css("height", "50px");</script>
		</div>
		
		
	</div> <!-- end #ucaprofesional_detail -->
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>