<?php

$nombre_entidad = "about";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	if(isset($_GET['aboutid'])){
		$resultado = $controller->selectAbout($_GET['aboutid']);	// devuelve los datos especificos de una sola fila
		$resultado->data_seek(0);
		$fila = $resultado->fetch_assoc();
	}
	else{
		$fila = '';
		$fila['preview'] = "/revistauca/_public/img/blog.png";
	}
	?>
	<div id="about_detail<? echo $fila['id']; ?>" class="about_detail">
		
		<div id="about_detail_media" style="display: none;">
			<!--<img src="<? echo $fila['preview'] ?>" />-->
			<!--<img id="aboutPreviewImg" src="<? echo $fila['preview']; ?>" onclick="document.getElementById('aboutPreview').click();" style="cursor: pointer;"/>
			<input type="file" id="aboutPreview" accept="image/" onchange="mostrarImagenabout(event);" style="display:none;"/>-->
		</div>
		
		<div id="about_detail_title">
			<h1>Titulo: <input type="text" id="aboutTitle" class="about_textfield" value="<? echo $fila['titulo'] ?>" /></h1>
		</div>
		
		<div class="about_detail_author_date">
			<div class="inline">
				<!--<h4 id="about_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="about_autor_thumbnail">
					<img id="about_author_img" src="<? echo $_SESSION['imagen_usuario']; ?>" />
				</div>
			</div>
			<div class="inline">
				<?
				$creado = $fila['creado'];
				$creado = ($creado == '') ? date("d.m.y") : $creado;
				?>
				<h4 id="about_detail_date"><? echo $creado; ?></h4>
				<h4 id="about_detail_author"><? echo $_SESSION['nombre_usuario']; ?></h4>
			</div>
			
			<script>
				// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
				$.ajax({
					type:"GET",
					url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
					success:function(responseText){
						
						var jsonObject = JSON.parse(responseText);
						jsonObject = jsonObject[0];
						
						$("#about_author_img").each(function(){
							$(this).attr("src", jsonObject.imagen);
						});
						
						$("#about_detail_author").each(function(){
							$(this).html(jsonObject.nombre);
						});
					}
				});
			</script>
			
		</div>
		
		<div id="about_detail_description"> 
			<!--<? echo $fila['contenido']; ?>-->
			<div id="aboutId" style="display:none;"></div>
			<script>$("#aboutId").html('<? echo $fila['id'] ?>');</script>
			<div class="about_comment_text" onclick="document.getElementById('aboutContent').focus();">
				Escriba el contenido del about:<br>
				<div id="aboutContent" class="about_comment_edittext" contenteditable="true" placeholder="Agrega un contenido ..." onclick="this.focus();"><? echo $fila['contenido']; ?></div>
			</div>
		</div>
		
		<div class="blog_comment_buttons">
			<? $aboutid = (isset($_GET['aboutid'])) ? $_GET['aboutid'] : "''"; ?>
			<div id="btn_enviar" class="custom_btn" onclick="crearAbout(<? echo $aboutid; ?>);" style="float:right;margin-right: 10%; margin-bottom: 10%;">
				Publicar
			</div>
		</div>
		
		
	</div> <!-- end #about_detail -->
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>