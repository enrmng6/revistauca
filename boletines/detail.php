<?php

$nombre_entidad = "boletines";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	
	$resultado = $controller->selectBoletines($_GET['boletinesid']);	// devuelve los datos especificos de una sola fila
	$resultado->data_seek(0);
	$fila = $resultado->fetch_assoc();
	?>
	<div id="boletines_detail<? echo $fila['id']; ?>" class="boletines_detail">
		
		<div id="boletines_detail_media">
			<img src="<? echo $fila['preview'] ?>" />
		</div>
		
		<div id="boletines_detail_title">
			<h1><? echo $fila['titulo'] ?></h1>
		</div>
		
		<div class="boletines_detail_author_date">
			<div class="inline">
				<!--<h4 id="boletines_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="boletines_autor_thumbnail">
					<img id="boletines_author_img" src="<? echo $fila['preview']; ?>" />
				</div>
			</div>
			<div class="inline">
				<h4 id="boletines_detail_date"><? echo $fila['creado']; ?></h4>
				<h4 id="boletines_detail_author">...</h4>
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
			<? echo $fila['contenido']; ?>
		</div>
		
		<div style="text-align: center;">
			<div class="ver_revista_btn" onclick="window.open('<? echo $fila['archivo']; ?>');";>
				Ver boletin &gt;
			</div>
		</div>
		
		<div id="boletines_comments" style="display:none;">
			
			<div id="boletines_comments_title">
				<div class="inline"><h2 id="boletines_comments_count">#</h2></div>
				<div class="inline"><h2 id="boletines_comments_count_label">Comentario</h2></div>
			</div>
			
			<div id="boletines_new_comment">
				<input id="id_padre" type="hidden" value="<? echo $fila['id']; ?>">
				<div>
					<div class="boletines_comment_thumbnail">
						<img src="<? echo $_SESSION['imagen_usuario']; ?>" />
					</div>
					<div class="boletines_comment_text">
						<div id="boletines_comment_edittext" contenteditable="true" placeholder="Agrega un comentario ..."></div>
					</div>
				</div>
				
				<div class="boletines_comment_buttons_right">
					<!--<div class="inline" style="background: grey;">Cancel</div>-->
					<div class="inline send_comment"  onclick="enviarComment();">Enviar</div>
				</div>
				
				<div>
				</div>
			</div> <!-- end #boletines_new_comment -->
			
			<div id="boletines_comments_list">
			
				<script>
					//cargarComentariosBoletines(<? echo $fila['id']; ?>);
				</script>
				
			</div> <!-- end #boletines_comments_list -->
			
		</div> <!-- end #boletines_comments -->
		
		
	</div> <!-- end #boletines_detail -->
	
	<?	
	if($_SESSION["tipo_usuario"] == "administrador" || $fila['id_autor'] == $_SESSION["id_usuario"]){
		$img = '<img onclick="location.href=\'/revistauca/boletines/crud.php?boletinesid=';
		$img .= $fila['id']; 
		$img .= '\';" style="width:100; height: 100;position: fixed; bottom: 3%; right: 3%; cursor: pointer;" src="/revistauca/_public/img/editicon.png"/>';
		
		echo $img;
	}
	
	if($_SESSION["tipo_usuario"] == "administrador" || $fila['id_autor'] == $_SESSION["id_usuario"]){
		echo '<script>setTimeout(function(){$("#commentDeleteImg").css("display", "block");}, 1000);</script>';
	}
	
	?>
	
</div> <!-- end #content -->

<script>
	registrarVisita(<? echo $_GET['boletinesid']; ?>);
</script>
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>