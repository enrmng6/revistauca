<?php

$nombre_entidad = "noticias";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	
	$resultado = $controller->selectNoticia($_GET['noticiaid']);	// devuelve los datos especificos de una sola fila
	$resultado->data_seek(0);
	$fila = $resultado->fetch_assoc();
	?>
	<div id="noticia_detail<? echo $fila['id']; ?>" class="noticia_detail">
		
		<div id="noticia_detail_media">
			<img src="<? echo $fila['preview'] ?>" />
		</div>
		
		<div id="noticia_detail_title">
			<h1><? echo $fila['titulo'] ?></h1>
		</div>
		
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
			<? echo $fila['contenido']; ?>
		</div>
		
		<div id="noticia_comments" style="display:none;">
			
			<div id="noticia_comments_title">
				<div class="inline"><h2 id="noticia_comments_count">#</h2></div>
				<div class="inline"><h2 id="noticia_comments_count_label">Comentario</h2></div>
			</div>
			
			<div id="noticia_new_comment">
				<input id="id_padre" type="hidden" value="<? echo $fila['id']; ?>">
				<div>
					<div class="noticia_comment_thumbnail">
						<img src="<? echo $_SESSION['imagen_usuario']; ?>" />
					</div>
					<div class="noticia_comment_text">
						<div id="noticia_comment_edittext" contenteditable="true" placeholder="Agrega un comentario ..."></div>
					</div>
				</div>
				
				<div class="noticia_comment_buttons">
					<!--<div class="inline" style="background: grey;">Cancel</div>-->
					<div class="inline send_comment"  onclick="enviarComment();">Enviar</div>
				</div>
				
				<div>
				</div>
			</div> <!-- end #noticia_new_comment -->
			
			<div id="noticia_comments_list">
			
				<script>
					//cargarComentariosnoticia(<? echo $fila['id']; ?>);
				</script>
				
			</div> <!-- end #noticia_comments_list -->
			
		</div> <!-- end #noticia_comments -->
		
		
	</div> <!-- end #noticia_detail -->
	
	<?	
	if($_SESSION["tipo_usuario"] == "administrador" || $fila['id_autor'] == $_SESSION["id_usuario"]){
		$img = '<img onclick="location.href=\'/revistauca/noticias/crud.php?noticiaid=';
		$img .= $fila['id']; 
		$img .= '\';" style="width:100; height: 100;position: fixed; bottom: 3%; right: 3%; cursor: pointer;" src="/revistauca/_public/img/editicon.png"/>';
		
		echo $img;
	}
	?>
	
</div> <!-- end #content -->

<script>
	registrarVisita(<? echo $_GET['noticiaid']; ?>);
</script>
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>