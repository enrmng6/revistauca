<?php

$nombre_entidad = "educar";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/modal.php";
?>
	
<div id="content">
	
	<?
	if(isset($_GET['educarid'])){
		$resultado = $controller->selecteducar($_GET['educarid']);	// devuelve los datos especificos de una sola fila
		$resultado->data_seek(0);
		$fila = $resultado->fetch_assoc();
	}
	else{
		$fila = '';
		$fila['preview'] = "/revistauca/_public/img/blog.png";
		$fila['id_autor'] = $_SESSION['id_usuario'];
	}
	?>
	<div id="educar_detail<? echo $fila['id']; ?>" class="educar_detail">
		
		<div id="educar_detail_media">
			<!--<img src="<? echo $fila['preview'] ?>" />-->
			<img id="educarPreviewImg" src="<? echo $fila['preview']; ?>" onclick="document.getElementById('educarPreview').click();" style="cursor: pointer;"/>
			<input type="file" id="educarPreview" accept="image/" onchange="mostrarImagenEducar(event);" style="display:none;"/>
		</div>
		
		<div id="educar_detail_title">
			<h1>Titulo: <input type="text" id="educarTitle" class="educar_textfield" value="<? echo $fila['titulo'] ?>" /></h1>
		</div>
		
		<div class="educar_detail_author_date">
			<div class="inline">
				<!--<h4 id="educar_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="educar_autor_thumbnail">
					<img id="educar_author_img" src="<? echo $_SESSION['imagen_usuario']; ?>" />
				</div>
			</div>
			<div class="inline">
				<?
				$creado = $fila['creado'];
				$creado = ($creado == '') ? date("d.m.y") : $creado;
				?>
				<h4 id="educar_detail_date"><? echo $creado; ?></h4>
				<h4 id="educar_detail_author"><? echo $_SESSION['nombre_usuario']; ?></h4>
			</div>
			
			<script>
				// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
				$.ajax({
					type:"GET",
					url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
					success:function(responseText){
						
						var jsonObject = JSON.parse(responseText);
						jsonObject = jsonObject[0];
						
						$("#educar_author_img").each(function(){
							$(this).attr("src", jsonObject.imagen);
						});
						
						$("#educar_detail_author").each(function(){
							$(this).html(jsonObject.nombre);
						});
					}
				});
			</script>
			
		</div>
		
		<div id="educar_detail_description"> 
			<!--<? echo $fila['contenido']; ?>-->
			<div class="educar_comment_text" onclick="document.getElementById('educarDescription').focus();">
				Escriba una breve descripcion acerca del contenido de la publicacion:<br>
				<div id="educarDescription" class="educar_comment_edittext" contenteditable="true" placeholder="Agrega una descripcion ..." onclick="this.focus();"><? echo $fila['descripcion']; ?></div>
			</div><div id="educarId" style="display:none;"></div>
			<script>$("#educarId").html('<? echo $fila['id'] ?>');</script>
			<div class="educar_comment_text" onclick="document.getElementById('educarContent').focus();">
				Escriba el contenido de la publicacion:<br>
				<div id="educarContent" class="educar_comment_edittext" contenteditable="true" placeholder="Agrega un contenido ..." onclick="this.focus();"><? echo $fila['contenido']; ?></div>
			</div>
			<div class="educar_comment_text" onclick="document.getElementById('educarArchivo').focus();">
				URL de descarga:<br>
				<div id="educarArchivo" class="educar_comment_edittext" contenteditable="true" placeholder="Agrega una URL ..." onclick="this.focus();"><? echo $fila['archivo']; ?></div>
			</div>
		</div>
		
		<div class="blog_comment_buttons">
			<? $educarid = (isset($_GET['educarid'])) ? $_GET['educarid'] : "''"; ?>
			<div id="btn_enviar" class="custom_btn" onclick="crearEducar(<? echo $educarid; ?>);" style="float:right;margin-right: 10%; margin-bottom: 10%;">
				Publicar
			</div>

			<img id="educarDeleteImg" style="width: 50px; height: 0px; float:right; cursor:pointer;"  src="/revistauca/_public/img/deleteicon.png" onclick="EliminarRevistaEducar()">			
			<script>$("#educarDeleteImg").css("height", "50px");</script>
		</div>
		
		
	</div> <!-- end #educar_detail -->
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>