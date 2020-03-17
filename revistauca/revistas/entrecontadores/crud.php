<?php

$nombre_entidad = "entrecontadores";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	if(isset($_GET['entrecontadoresid'])){
		$resultado = $controller->selectEntreContadores($_GET['entrecontadoresid']);	// devuelve los datos especificos de una sola fila
		$resultado->data_seek(0);
		$fila = $resultado->fetch_assoc();
	}
	else{
		$fila = '';
		$fila['preview'] = "/revistauca/_public/img/blog.png";
		$fila['id_autor'] = $_SESSION['id_usuario'];
	}
	?>
	<div id="entrecontadores_detail<? echo $fila['id']; ?>" class="entrecontadores_detail">
		
		<div id="entrecontadores_detail_media">
			<!--<img src="<? echo $fila['preview'] ?>" />-->
			<img id="entrecontadoresPreviewImg" src="<? echo $fila['preview']; ?>" onclick="document.getElementById('entrecontadoresPreview').click();" style="cursor: pointer;"/>
			<input type="file" id="entrecontadoresPreview" accept="image/" onchange="mostrarImagenEntreContadores(event);" style="display:none;"/>
		</div>
		
		<div id="entrecontadores_detail_title">
			<h1>Titulo: <input type="text" id="entrecontadoresTitle" class="entrecontadores_textfield" value="<? echo $fila['titulo'] ?>" /></h1>
		</div>
		
		<div class="entrecontadores_detail_author_date">
			<div class="inline">
				<!--<h4 id="entrecontadores_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="entrecontadores_autor_thumbnail">
					<img id="entrecontadores_author_img" src="<? echo $_SESSION['imagen_usuario']; ?>" />
				</div>
			</div>
			<div class="inline">
				<?
				$creado = $fila['creado'];
				$creado = ($creado == '') ? date("d.m.y") : $creado;
				?>
				<h4 id="entrecontadores_detail_date"><? echo $creado; ?></h4>
				<h4 id="entrecontadores_detail_author"><? echo $_SESSION['nombre_usuario']; ?></h4>
			</div>
			
			<script>
				// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
				$.ajax({
					type:"GET",
					url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
					success:function(responseText){
						
						var jsonObject = JSON.parse(responseText);
						jsonObject = jsonObject[0];
						
						$("#entrecontadores_author_img").each(function(){
							$(this).attr("src", jsonObject.imagen);
						});
						
						$("#entrecontadores_detail_author").each(function(){
							$(this).html(jsonObject.nombre);
						});
					}
				});
			</script>
			
		</div>
		
		<div id="entrecontadores_detail_description"> 
			<!--<? echo $fila['contenido']; ?>-->
			<div class="entrecontadores_comment_text" onclick="document.getElementById('entrecontadoresDescription').focus();">
				Escriba una breve descripcion acerca del contenido de la publicacion:<br>
				<div id="entrecontadoresDescription" class="entrecontadores_comment_edittext" contenteditable="true" placeholder="Agrega una descripcion ..." onclick="this.focus();"><? echo $fila['descripcion']; ?></div>
			</div><div id="entrecontadoresId" style="display:none;"></div>
			<script>$("#entrecontadoresId").html('<? echo $fila['id'] ?>');</script>
			<div class="entrecontadores_comment_text" onclick="document.getElementById('entrecontadoresContent').focus();">
				Escriba el contenido de la publicacion:<br>
				<div id="entrecontadoresContent" class="entrecontadores_comment_edittext" contenteditable="true" placeholder="Agrega un contenido ..." onclick="this.focus();"><? echo $fila['contenido']; ?></div>
			</div>
			<div class="entrecontadores_comment_text" onclick="document.getElementById('entrecontadoresArchivo').focus();">
				URL de descarga:<br>
				<div id="entrecontadoresArchivo" class="entrecontadores_comment_edittext" contenteditable="true" placeholder="Agrega una URL ..." onclick="this.focus();"><? echo $fila['archivo']; ?></div>
			</div>
		</div>
		
		<div class="blog_comment_buttons">
			<? $entrecontadoresid = (isset($_GET['entrecontadoresid'])) ? $_GET['entrecontadoresid'] : "''"; ?>
			<div id="btn_enviar" class="custom_btn" onclick="crearEntreContadores(<? echo $entrecontadoresid; ?>);" style="float:right;margin-right: 10%; margin-bottom: 10%;">
				Publicar
			</div>
			<img id="entrecontadoresDeleteImg" style="width: 50px; height: 0px; float:right; cursor:pointer;" onclick="if(confirm('Seguro que desea eliminar esta revista?')){eliminarEntreContadores();}" src="/revistauca/_public/img/deleteicon.png">
			
			<script>$("#entrecontadoresDeleteImg").css("height", "50px");</script>
		</div>
		
		
	</div> <!-- end #entrecontadores_detail -->
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>