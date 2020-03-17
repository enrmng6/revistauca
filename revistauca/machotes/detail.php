<?php

$nombre_entidad = "machote";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	
	$resultado = $controller->selectMachote($_GET['machoteid']);	// devuelve los datos especificos de una sola fila
	$resultado->data_seek(0);
	$fila = $resultado->fetch_assoc();
	?>
	<div id="machote_detail<? echo $fila['id']; ?>" class="machote_detail">
		
		<div id="machote_detail_media">
			<img src="<? echo $fila['preview'] ?>" />
		</div>
		
		<div id="machote_detail_title">
			<h1><? echo $fila['titulo'] ?></h1>
		</div>
		
		<div class="machote_detail_author_date">
			<div class="inline">
				<!--<h4 id="machote_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="machote_autor_thumbnail">
					<img id="machote_author_img" src="<? echo $fila['preview']; ?>" />
				</div>
			</div>
			<div class="inline">
				<h4 id="machote_detail_date"><? echo $fila['creado']; ?></h4>
				<h4 id="machote_detail_author">...</h4>
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
			<? echo $fila['contenido']; ?>
		</div>
		
		<div id="machote_comments">
			
			<div id="machote_comments_title">
				<div class="inline"><h2 id="machote_comments_count">#</h2></div>
				<div class="inline"><h2 id="machote_comments_count_label">Comentario</h2></div>
			</div>
			
			<div id="machote_new_comment">
				<input id="id_padre" type="hidden" value="<? echo $fila['id']; ?>">
				<div>
					<div class="machote_comment_thumbnail">
						<img src="<? echo $_SESSION['imagen_usuario']; ?>" />
					</div>
					<div class="machote_comment_text">
						<div id="machote_comment_edittext" contenteditable="true" placeholder="Agrega un comentario ..."></div>
					</div>
				</div>
				
				<div class="machote_comment_buttons">
					<!--<div class="inline" style="background: grey;">Cancel</div>-->
					<div class="inline send_comment"  onclick="enviarComment();">Enviar</div>
				</div>
				
				<div>
				</div>
			</div> <!-- end #machote_new_comment -->
			
			<div id="machote_comments_list">
			
				<script>
					cargarComentariosMachote(<? echo $fila['id']; ?>);
				</script>
				
			</div> <!-- end #machote_comments_list -->
			
		</div> <!-- end #machote_comments -->
		
		
	</div> <!-- end #machote_detail -->
	
	<?	
	if($_SESSION["tipo_usuario"] == "administrador" || $fila['id_autor'] == $_SESSION["id_usuario"]){
		$img = '<img onclick="location.href=\'/revistauca/machotes/crud.php?machoteid=';
		$img .= $fila['id']; 
		$img .= '\';" style="width:100; height: 100;position: fixed; bottom: 3%; right: 3%; cursor: pointer;" src="/revistauca/_public/img/editicon.png"/>';
		
		echo $img;
	}
	?>
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>