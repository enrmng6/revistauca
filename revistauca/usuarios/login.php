<?php

session_start();
if(isset($_SESSION['id_usuario'])){
	echo "<script>location.href = '/revistauca/noticias/';</script>";
	return;
}

$nombre_entidad = "usuario";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header_no_validate.php";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/modal.php";
?>

<script>
	$("#header").css("display", "none");
</script>

<div id="img_header">
	<center><img src="/revistauca/_public/img/uca.png"></center>
</div>
                        
<div id="content" class="content">
	
	<div id="style">
		<br>
			<center><h2>Login</h2></center>
		<br>
	</div>

	<div id="reg">

		<form id="frmajax" method="POST" action="return false;" onsubmit="return false;">
			<label>Correo</label>
			<p></p>
			<input type="text" name="correo" id="correo">
			<p></p>
			<label>Contraseña</label>
			<p></p>
			<input type="password" name="password" id="password">
			<p></p>
			<!--<button id="registrar" >Ingresar</button>-->

			<div class="blog_comment_buttons" style="margin-bottom: 30px;">
				<div id="registrar" style="margin: 3%; padding: 3%; font-size: 15px; color: #ffffff; background-color: #1883ba; border-radius: 25px; border: 2px solid #0016b0;display: inline-block;cursor:pointer;">
				Ingresar
				</div>
			</div>
		</form>

	</div>		
	<div id="link">
		si no tienes una cuenta ingresa aqui!
		<a href="/revistauca/usuarios/registro.php"><strong>Registrarse</strong></a>
	</div>
	
	<div style="height: 30px; display: block;">
	</div>


</div>

			
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>

<script type="text/javascript">
//$(document).ready(function(){
	$('#registrar').click(function(){
		if($('#correo').val()==""){
			$("#ModalCorreo").modal();
			return false;
		}else if($('#password').val()==""){
			$("#ModalContra").modal();
			return false;
		}

		cadena="correo=" + $('#correo').val()+
		"&passw=" +$('#password').val();
		
		$.ajax({
			type:"POST",
			url:"/revistauca/__controller/usuarios_controller.php?login",
			data:cadena,
			success:function(responseText){
				if(responseText==1){
					$("#ModalBienvenida").modal();
				}else{
					$("#ModalLogin").modal();
				}
			}
		});
	});
	
	$("#password").on('keyup', function (e) {
		if (e.keyCode === 13) {
			$('#registrar').click();
		}
	});
	//});

</script>
