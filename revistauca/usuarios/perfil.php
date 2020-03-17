<?php

$nombre_entidad = "usuario";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
                  
<div id="content" class="content">
	<div id="style">
		<br>
		<center><h2>Mi Perfil</h2></center>
		<br>
	</div>

	<div id="reg">
		<form id="frmajax" method="POST">
			<!--imagen de perfil-->
			<center>
				<div id="imagen_perfil" style="text-align: center; height: 100px; width: 100px;">
					<img id="userPreviewImg" src="/revistauca/_public/img/Perfil.png" onclick="document.getElementById('userPreview').click();" style="width: 100%; height: 100%; border-radius: 100%; cursor: pointer;"/>
					<input type="file" id="userPreview" accept="image/" onchange="mostrarImagenPerfil(event);" style="display:none;"/>
				</div>
				<script>
					var mostrarImagenPerfil = function(event) {
						var imagen = document.getElementById('userPreviewImg');
						imagen.src = URL.createObjectURL(event.target.files[0]);
						URL.revokeObjectURL(event.target.files[0]);
					};
				</script>
			</center>
			<br>
			<!--fin imagen de perfil-->

			<label>Nombre</label>
			<p></p>
			<input type="text" name="nombre" id="nombre">
			<p></p>
			<p>Carrera</p>
			<select name="carrera" id="carrera"></select>
			<p></p>
			<label>Correo</label>
			<p></p>
			<input type="text" name="correo" id="correo">
			<p></p>
			<label>password</label>
			<p></p>
			<input type="password" name="password" id="password">
			<p></p>
			<label>Nuevamente password</label>
			<p></p>
			<input type="password" name="password2" id="password2">
			<p></p>
			<!--<button id="btnguardar">Guardar datos</button>-->

			<div class="blog_comment_buttons" style="margin-bottom: 30px;">
				<div id="btnguardar" style="margin: 3%; padding: 3%; font-size: 15px; color: #ffffff; background-color: #1883ba; border-radius: 25px; border: 2px solid #0016b0;display: inline-block;cursor:pointer;">
					Guardar
				</div>
			</div>
		</form>
	</div><!-- end reg -->
	
	<div style="height: 30px; display: block;">
	</div>

</div><!-- end content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>


<script type="text/javascript">
	//$(document).ready(function(){
	$('#btnguardar').click(function(){
		if($('#nombre').val()==""){
			alert("Debes ingresar un nombre")
			return false;
		}else if($('#carrera').val()==""){
			alert("Debes agregar una carrera")
			return false;
		}else if($('#correo').val()==""){
			alert("Debes agregar un correo electronico")
			return false;
		}else if($('#password').val()==""){
			alert("Debes agregar una contraseña")
			return false;      
		}       
		else if($('#password2').val() != $('#password').val()){
			alert("Debes confirmar tu password")
			return false;      
		}  
		/*cadena="nombre=" + $('#nombre').val()+
		"&carrera=" +$('#carrera').val()+
		"&correo=" +$('#correo').val()+
		"&passw=" +$('#password').val();*/

		var cadena = new FormData();
		cadena.append("nombre", $('#nombre').val());
		cadena.append("carrera", $('#carrera').val());
		cadena.append("correo", $('#correo').val());
		cadena.append("passw", $('#password').val());

		var inputFile = document.getElementById('userPreview');
		var userPreview = inputFile.files[0];

		cadena.append("imagen", userPreview);

		$.ajax({
			url:"/revistauca/__controller/usuarios_controller.php?insert",
			type:"POST",
			data:cadena,
			processData: false,
			contentType: false,
			success:function(responseText){
				if(responseText == 1){
					alert("Informacion guardada!");
					//$('#frmajax')[0].reset();
					location.reload();
				}else{
					alert("No se pudo guardar la informacion, comuniquese con el administrador de la app");
				}
			}
		});
		return false;

	});


	// CODIGO PARA CARGAR LAS CARRERAS VIA JSON/AJAX/PHP
	$.ajax({
		type:"GET",
		url:"/revistauca/__controller/carreras_controller.php?select&json",
		success:function(responseText){
			var jsonCarreras = JSON.parse(responseText);

			var nuevoHTMLOpcionesCarreras = "";

			nuevoHTMLOpcionesCarreras += "<option value=0>Seleccione una carrera</option>";

			for(i = 0; i < jsonCarreras.length; i++){
				var carreraActual = jsonCarreras[i];
				nuevoHTMLOpcionesCarreras += "<option value=" + carreraActual.id + ">" + carreraActual.nombre + "</option>";
			}

			$("#carrera").html(nuevoHTMLOpcionesCarreras);
		}
	});
	//});
</script>

<? if(isset($_SESSION['id_usuario'])) {
	
	$resultado = $controller->selectUsuario($_SESSION['id_usuario']);

	for($i = 0; $i < $resultado->num_rows; $i++)
	{
		$resultado->data_seek($i);
		$fila = $resultado->fetch_assoc();
		$fila['id'] = $fila['id'] + 0;
		$fila['id_autor'] = $fila['id_carrera'] + 0;
		
		?>
		<script>
			// CODIGO PARA CARGAR INFO DEL USUARIO
			$("#userPreviewImg").attr('src', '<? echo $fila['imagen']; ?>');
			$("#nombre").attr('value', '<? echo $fila['nombre']; ?>');
			$("#correo").attr('value', '<? echo $fila['correo'] ?>');
			$("#password").attr('value', '');
			$("#password2").attr('value', '');
			
			var id_carrera = '<? echo $fila['id_carrera']; ?>';
			var intentos_carrera = 0;
			
			var hiloCarreras = setTimeout(checkSelectCarreras, 1000);
			
			function checkSelectCarreras(){
				var select = $("#carrera").val();
				
				if(select == null && intentos_carrera != 3){
					clearTimeout(hiloCarreras);
					hiloCarreras = setTimeout(checkSelectCarreras, 1000);
					return;
				}
				
				intentos_carrera++;
				
				clearTimeout(hiloCarreras);
				$("#carrera").val(id_carrera);
			}
			
		</script>
	<? break; }
} ?>
