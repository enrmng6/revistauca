<?php

$nombre_entidad = "machote";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	if(isset($_GET['machoteid'])){
		$resultado = $controller->selectMachote($_GET['machoteid']);	// devuelve los datos especificos de una sola fila
		$resultado->data_seek(0);
		$fila = $resultado->fetch_assoc();
	}
	else{
		$fila = '';
		$fila['preview'] = "/revistauca/_public/img/blog.png";
	}
	?>
	<div id="machote_detail<? echo $fila['id']; ?>" class="machote_detail">
		
		<div id="machote_detail_media">
			<!--<img src="<? echo $fila['preview'] ?>" />-->
			<img id="machotePreviewImg" src="<? echo $fila['preview']; ?>" onclick="document.getElementById('machotePreview').click();" style="cursor: pointer;"/>
			<input type="file" id="machotePreview" accept="image/" onchange="mostrarImagenMachote(event);" style="display:none;"/>
		</div>
		
		<div id="machote_detail_title">
			<h1>Titulo: <input type="text" id="machoteTitle" class="machote_textfield" value="<? echo $fila['titulo'] ?>" /></h1>
		</div>
		
		<div class="machote_detail_author_date">
			<div class="inline">
				<!--<h4 id="machote_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="machote_autor_thumbnail">
					<img id="machote_author_img" src="<? echo $_SESSION['imagen_usuario']; ?>" />
				</div>
			</div>
			<div class="inline">
				<?
				$creado = $fila['creado'];
				$creado = ($creado == '') ? date("d.m.y") : $creado;
				?>
				<h4 id="machote_detail_date"><? echo $creado; ?></h4>
				<h4 id="machote_detail_author"><? echo $_SESSION['nombre_usuario']; ?></h4>
			</div>
			
			<script>
				// CODIGO PARA CARGAR NOMBRE E IMAGEN DE AUTOR VIA JSON/AJAX/PHP
				$.ajax({
					type:"GET",
					url:"/revistauca/__controller/usuarios_controller.php?select&userid=<? echo $fila['id_autor']; ?>&json",
					success:function(responseText){
						
						var jsonObject = JSON.parse(responseText);
						jsonObject = jsonObject[0];
						
						$("#machote_author_img").each(function(){
							$(this).attr("src", jsonObject.imagen);
						});
						
						$("#machote_detail_author").each(function(){
							$(this).html(jsonObject.nombre);
						});
					}
				});
			</script>
			
		</div>
		
		<div id="machote_detail_description"> 
			<!--<? echo $fila['contenido']; ?>-->
			<div class="machote_comment_text" onclick="document.getElementById('machoteDescription').focus();">
				Escriba una breve descripcion acerca del contenido del machote:<br>
				<div id="machoteDescription" class="machote_comment_edittext" contenteditable="true" placeholder="Agrega una descripcion ..." onclick="this.focus();"><? echo $fila['descripcion']; ?></div>
			</div><div id="machoteId" style="display:none;"></div>
			<script>$("#machoteId").html('<? echo $fila['id'] ?>');</script>
			<div class="machote_comment_text" onclick="document.getElementById('machoteContent').focus();">
				Escriba el contenido del machote:<br>
				<div id="machoteContent" class="machote_comment_edittext" contenteditable="true" placeholder="Agrega un contenido ..." onclick="this.focus();"><? echo $fila['contenido']; ?></div>
			</div>
		</div>
		
		<div class="blog_comment_buttons">
			<? $machoteid = (isset($_GET['machoteid'])) ? $_GET['machoteid'] : "''"; ?>
			<div id="btn_enviar" class="custom_btn" onclick="crearMachote(<? echo $machoteid; ?>);" style="float:right;margin-right: 10%; margin-bottom: 10%;">
				Publicar
			</div>
			<img id="machoteDeleteImg" style="width: 50px; height: 0px; float:right; cursor:pointer;" onclick="if(confirm('Seguro que desea eliminar este machote?')){eliminarMachote();}" src="/revistauca/_public/img/deleteicon.png">
			
			<script>$("#machoteDeleteImg").css("height", "50px");</script>
		</div>
		
		
	</div> <!-- end #machote_detail -->
	
</div> <!-- end #content -->

<script>
	// CODIGO PARA REGISTRAR LA VISITA
	$.ajax({
		type:"GET",
		url:"/revistauca/__controller/visitas_controller.php?insert&userid=<? echo $fila['id_autor']; ?>&json",
		success:function(responseText){
			
			var jsonObject = JSON.parse(responseText);
			jsonObject = jsonObject[0];
			
			$("#machote_author_img").each(function(){
				$(this).attr("src", jsonObject.imagen);
			});
			
			$("#machote_detail_author").each(function(){
				$(this).html(jsonObject.nombre);
			});
		}
	});
</script>
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>