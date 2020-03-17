<?php

$nombre_entidad = "educar";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	
	$resultado = $controller->selectEducar($_GET['educarid']);	// devuelve los datos especificos de una sola fila
	$resultado->data_seek(0);
	$fila = $resultado->fetch_assoc();
	?>
	<div id="educar_detail<? echo $fila['id']; ?>" class="educar_detail">
		
		<div id="educar_detail_media">
			<img src="<? echo $fila['preview'] ?>" />
		</div>
		
		<div id="educar_detail_title">
			<h1><? echo $fila['titulo'] ?></h1>
		</div>
		
		<div class="educar_detail_author_date">
			<div class="inline">
				<!--<h4 id="educar_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="educar_autor_thumbnail">
					<img id="educar_author_img" src="<? echo $fila['preview']; ?>" />
				</div>
			</div>
			<div class="inline">
				<h4 id="educar_detail_date"><? echo $fila['creado']; ?></h4>
				<h4 id="educar_detail_author">...</h4>
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
			<? echo $fila['contenido']; ?>
		</div>
		
		<div style="text-align: center;">
			<div class="ver_revista_btn" onclick="window.open('<? echo $fila['archivo']; ?>');";>
				Ver revista &gt;
			</div>
		</div>
		
		<div id="educar_comments">
			
			<div id="educar_comments_title">
				<div class="inline"><h2 id="educar_comments_count">#</h2></div>
				<div class="inline"><h2 id="educar_comments_count_label">Comentario</h2></div>
			</div>
			
			<div id="educar_new_comment">
				<input id="id_padre" type="hidden" value="<? echo $fila['id']; ?>">
				<div>
					<div class="educar_comment_thumbnail">
						<img src="<? echo $_SESSION['imagen_usuario']; ?>" />
					</div>
					<div class="educar_comment_text">
						<div id="educar_comment_edittext" contenteditable="true" placeholder="Agrega un comentario ..."></div>
					</div>
				</div>
				
				<div class="educar_comment_buttons_right">
					<!--<div class="inline" style="background: grey;">Cancel</div>-->
					<div class="inline send_comment"  onclick="enviarComment();">Enviar</div>
				</div>
				
				<div>
				</div>
			</div> <!-- end #educar_new_comment -->
			
			<div id="educar_comments_list">
			
				<script>
					cargarComentariosEducar(<? echo $fila['id']; ?>);
				</script>
				
			</div> <!-- end #educar_comments_list -->
			
		</div> <!-- end #educar_comments -->
		
		
	</div> <!-- end #educar_detail -->
	
	<?	
	if($_SESSION["tipo_usuario"] == "administrador" || $fila['id_autor'] == $_SESSION["id_usuario"]){
		$img = '<img onclick="location.href=\'/revistauca/revistas/educar/crud.php?educarid=';
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
	registrarVisita(<? echo $_GET['educarid']; ?>);
</script>
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>