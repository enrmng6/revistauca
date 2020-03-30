<?php
session_start();
if(isset($_SESSION['id_usuario'])){
	echo "<script>location.href = '/revistauca/admin/inicio';</script>";
	return;
}

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>RevistaUCA - Admin</title>
	
	<meta name="HanheldFriendly" content="true"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	
	
	<link rel="shortcut icon" type="image/x-icon" href="/revistauca/_public/img/Logo-UCA-2017.ico">

	<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/welcomestyle.css">
	
	<script src="/revistauca/_public/js/jquery.min.js"></script>
	
</head>
<body>

<div id="container">
	<h1>Bienvenid@ a la administracion de la App RevistaUCA</h1>

	<div id="body">
		<p>Por favor ingrese sus credenciales de autenticaciòn</p>

		<p>
			<form id="login_form" onsubmit="return false;">
				<div><span>Correo:</span><input type="text" id="correo" name="correo"></div>
				<span>Contraseña:</span><input type="password" id="password" name="passw">
				<br>
				<span></span><input type="submit" name="submit" id="submit" value="Ingresar">
			</form>
		</p>
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<script type="text/javascript">
//$(document).ready(function(){
	$('#submit').click(function(){
		if($('#correo').val()==""){
			alert("debes ingresar un correo valido")
			return false;
		}else if($('#password').val()==""){
			alert("debes ingresar una contraseña valida")
			return false;
		}

		cadena="correo=" + $('#correo').val()+
		"&passw=" +$('#password').val();
		
		$.ajax({
			type:"POST",
			url:"/revistauca/admin/inicio/login",
			data:cadena,
			success:function(responseText){
				
				if(responseText.indexOf('/revistauca/admin/') == 0){
					location.href = responseText;
				}
				
				alert(responseText);
				/*if(responseText==1){
					location.href = "/revistauca/noticias/";
				}else{
					alert("Datos Incorrectos");
				}*/
			},
			error:function(responseText){
				
				alert(responseText.statusText);
				/*if(responseText==1){
					location.href = "/revistauca/noticias/";
				}else{
					alert("Datos Incorrectos");
				}*/
			}
		});
	});
	
	/*$("#password").on('keyup', function (e) {
		if (e.keyCode === 13) {
			$('#registrar').click();
		}
	});*/
	//});

</script>

</body>
</html>