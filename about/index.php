<?php

$nombre_entidad = "about";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	
	$resultado = $controller->selectAbout(1);	// devuelve los datos especificos de una sola fila
	$resultado->data_seek(0);
	$fila = $resultado->fetch_assoc();
	?>
	<div id="about_detail<? echo $fila['id']; ?>" class="about_detail">
		
		<!--<div id="about_detail_media">
			<img src="<? echo $fila['preview'] ?>" />
		</div>-->
		
		<div id="about_detail_title">
			<h1><? echo $fila['titulo'] ?></h1>
		</div>
		
		<div class="about_detail_author_date">
			<div class="inline">
				<!--<h4 id="about_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="about_autor_thumbnail">
					<img id="about_author_img" src="<? echo $fila['preview']; ?>" />
				</div>
			</div>
			<div class="inline">
				<!--<h4 id="about_detail_date"><? echo $fila['creado']; ?></h4>-->
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
			<? echo $fila['contenido']; ?>
		</div>
		
		<div id="about_comments" style="display:none;">
			
			<div id="about_comments_title">
				<div class="inline"><h2 id="about_comments_count">#</h2></div>
				<div class="inline"><h2 id="about_comments_count_label">Comentario</h2></div>
			</div>
			
			<div id="about_new_comment">
				<input id="id_padre" type="hidden" value="<? echo $fila['id']; ?>">
				<div>
					<div class="about_comment_thumbnail">
						<img src="<? echo $_SESSION['imagen_usuario']; ?>" />
					</div>
					<div class="about_comment_text">
						<div id="about_comment_edittext" contenteditable="true" placeholder="Agrega un comentario ..."></div>
					</div>
				</div>
				
				<div class="about_comment_buttons">
					<!--<div class="inline" style="background: grey;">Cancel</div>-->
					<div class="inline send_comment"  onclick="enviarComment();">Enviar</div>
				</div>
				
				<div>
				</div>
			</div> <!-- end #about_new_comment -->
			
			<div id="about_comments_list">
			
				<script>
					//cargarComentariosAbout(<? echo $fila['id']; ?>);
				</script>
				
			</div> <!-- end #about_comments_list -->
			
		</div> <!-- end #about_comments -->
		
		
	</div> <!-- end #about_detail -->
	
	<?	
	if($_SESSION["tipo_usuario"] == "administrador" || $fila['id_autor'] == $_SESSION["id_usuario"]){
		$img = '<img onclick="location.href=\'/revistauca/about/crud.php?aboutid=';
		$img .= $fila['id']; 
		$img .= '\';" style="width:100; height: 100;position: fixed; bottom: 3%; right: 3%; cursor: pointer;" src="/revistauca/_public/img/editicon.png"/>';
		
		echo $img;
	}
	?>
	
</div> <!-- end #content -->
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>