<?php

$nombre_entidad = "noticias";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	if(isset($_GET['noticiaid'])){
		$resultado = $controller->selectNoticia($_GET['noticiaid']);	// devuelve los datos especificos de una sola fila
		$resultado->data_seek(0);
		$fila = $resultado->fetch_assoc();
	}
	else{
		$fila = '';
		$fila['preview'] = "/revistauca/_public/img/blog.png";
	}
	?>
	<div id="noticia_detail<? echo $fila['id']; ?>" class="noticia_detail">
		
		<div id="noticia_detail_media">
			<!--<img src="<? echo $fila['preview'] ?>" />-->
			<img id="noticiaPreviewImg" src="<? echo $fila['preview']; ?>" onclick="document.getElementById('noticiaPreview').click();" style="cursor: pointer;"/>
			<input type="file" id="noticiaPreview" accept="image/" onchange="mostrarImagenNoticia(event);" style="display:none;"/>
		</div>
		
		<div id="noticia_detail_title">
			<h1>Titulo: <input type="text" id="noticiaTitle" class="noticia_textfield" value="<? echo $fila['titulo'] ?>" /></h1>
		</div>
		
		<div class="noticia_detail_author_date">
			<div class="inline">
				<!--<h4 id="noticia_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="noticia_autor_thumbnail">
					<img id="noticia_author_img" src="<? echo $_SESSION['imagen_usuario']; ?>" />
				</div>
			</div>
			<div class="inline">
				<?
				$creado = $fila['creado'];
				$creado = ($creado == '') ? date("d.m.y") : $creado;
				?>
				<h4 id="noticia_detail_date"><? echo $creado; ?></h4>
				<h4 id="noticia_detail_author"><? echo $_SESSION['nombre_usuario']; ?></h4>
			</div>
			
			<script>
				// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
				$.ajax({
					type:"GET",
					url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
					success:function(responseText){
						
						var jsonObject = JSON.parse(responseText);
						jsonObject = jsonObject[0];
						
						$("#noticia_author_img").each(function(){
							$(this).attr("src", jsonObject.imagen);
						});
						
						$("#noticia_detail_author").each(function(){
							$(this).html(jsonObject.nombre);
						});
					}
				});
			</script>
			
		</div>
		
		<div id="noticia_detail_description"> 
			<!--<? echo $fila['contenido']; ?>-->
			<div class="noticia_comment_text" onclick="document.getElementById('noticiaDescription').focus();">
				Escriba una breve descripcion acerca del contenido de la noticia:<br>
				<div id="noticiaDescription" class="noticia_comment_edittext" contenteditable="true" placeholder="Agrega una descripcion ..." onclick="this.focus();"><? echo $fila['descripcion']; ?></div>
			</div><div id="noticiaId" style="display:none;"></div>
			<script>$("#noticiaId").html('<? echo $fila['id'] ?>');</script>
			<div class="noticia_comment_text" onclick="document.getElementById('noticiaContent').focus();">
				Escriba el contenido de la noticia:<br>
				<div id="noticiaContent" class="noticia_comment_edittext" contenteditable="true" placeholder="Agrega un contenido ..." onclick="this.focus();"><? echo $fila['contenido']; ?></div>
			</div>
		</div>
		
		<div class="blog_comment_buttons">
			<? $noticiaid = (isset($_GET['noticiaid'])) ? $_GET['noticiaid'] : "''"; ?>
			<div id="btn_enviar" class="custom_btn" onclick="crearNoticia(<? echo $noticiaid; ?>);" style="float:right;margin-right: 10%; margin-bottom: 10%;">
				Publicar
			</div>
			<img id="noticiaDeleteImg" style="width: 50px; height: 0px; float:right; cursor:pointer;" onclick="if(confirm('Seguro que desea eliminar este noticia?')){eliminarNoticia();}" src="/revistauca/_public/img/deleteicon.png">
			
			<script>$("#noticiaDeleteImg").css("height", "50px");</script>
		</div>
		
		
	</div> <!-- end #noticia_detail -->
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>