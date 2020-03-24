<?php

$nombre_entidad = "entrecontadores";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">
	
	<?
	
	$resultado = $controller->selectEntreContadores($_GET['entrecontadoresid']);	// devuelve los datos especificos de una sola fila
	$resultado->data_seek(0);
	$fila = $resultado->fetch_assoc();
	?>
	<div id="entrecontadores_detail<? echo $fila['id']; ?>" class="entrecontadores_detail">
		
		<div id="entrecontadores_detail_media">
			<img src="<? echo $fila['preview'] ?>" />
		</div>
		
		<div id="entrecontadores_detail_title">
			<h1><? echo $fila['titulo'] ?></h1>
		</div>
		
		<div class="entrecontadores_detail_author_date">
			<div class="inline">
				<!--<h4 id="entrecontadores_detail_author"><? echo $fila['id_autor']; ?></h4>-->
				<div class="entrecontadores_autor_thumbnail">
					<img id="entrecontadores_author_img" src="<? echo $fila['preview']; ?>" />
				</div>
			</div>
			<div class="inline">
				<h4 id="entrecontadores_detail_date"><? echo $fila['creado']; ?></h4>
				<h4 id="entrecontadores_detail_author">...</h4>
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
			<? echo $fila['contenido']; ?>
		</div>
		
		<div style="text-align: center;">
			<div class="ver_revista_btn" onclick="window.open('<? echo $fila['archivo']; ?>');";>
				Ver revista &gt;
			</div>
		</div>
		
		<div id="entrecontadores_comments">
			
			<div id="entrecontadores_comments_title">
				<div class="inline"><h2 id="entrecontadores_comments_count">#</h2></div>
				<div class="inline"><h2 id="entrecontadores_comments_count_label">Comentario</h2></div>
			</div>
			
			<div id="entrecontadores_new_comment">
				<input id="id_padre" type="hidden" value="<? echo $fila['id']; ?>">
				<div>
					<div class="entrecontadores_comment_thumbnail">
						<img src="<? echo $_SESSION['imagen_usuario']; ?>" />
					</div>
					<div class="entrecontadores_comment_text">
						<div id="entrecontadores_comment_edittext" contenteditable="true" placeholder="Agrega un comentario ..."></div>
					</div>
				</div>
				
				<div class="entrecontadores_comment_buttons_right">
					<!--<div class="inline" style="background: grey;">Cancel</div>-->
					<div class="inline send_comment"  onclick="enviarComment();">Enviar</div>
				</div>
				
				<div>
				</div>
			</div> <!-- end #entrecontadores_new_comment -->
			
			<div id="entrecontadores_comments_list">
			
				<script>
					cargarComentariosEntreContadores(<? echo $fila['id']; ?>);
				</script>
				
			</div> <!-- end #entrecontadores_comments_list -->
			
		</div> <!-- end #entrecontadores_comments -->
		
		
	</div> <!-- end #entrecontadores_detail -->
	
	<?	
	if($_SESSION["tipo_usuario"] == "administrador" || $fila['id_autor'] == $_SESSION["id_usuario"]){
		$img = '<img onclick="location.href=\'/revistauca/revistas/entrecontadores/crud.php?entrecontadoresid=';
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
	registrarVisita(<? echo $_GET['entrecontadoresid']; ?>);
</script>
	
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>