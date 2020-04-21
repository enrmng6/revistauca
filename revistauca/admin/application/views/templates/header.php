<? 
if(!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != "administrador"){
	echo "<script>location.href = '/revistauca/usuarios/login.php';</script>";
	return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>RevistaUCA - Admin</title>
	
	<meta name="HanheldFriendly" content="true"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	
	
	<!-- Custom fonts for this template-->
<link href="revistauca/admin/application/_public/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="revistauca/admin/application/_public/bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
<link href="revistauca/admin/application/_public/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<link rel="shortcut icon" type="image/x-icon" href="/revistauca/_public/img/Logo-UCA-2017.ico">

	<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/welcomestyle.css">
	<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/iniciostyle.css">
	
	<script src="/revistauca/_public/js/jquery.min.js"></script>
	
</head>
<body>

<div id="logoutdiv">
	<a href="/revistauca/">RevistaUCA App</a>&nbsp;|&nbsp;<a href="/revistauca/admin/inicio/logout">Cerrar sesi&oacute;n</a>
</div>

<div id="mensajes"></div>

<div id='header'>

</div>


<div id='contenido' class='contenido'>

<!-- Bootstrap core JavaScript-->
<script src="revistauca/admin/application/_public/bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="revistauca/admin/application/_public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="revistauca/admin/application/_public/bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="revistauca/admin/application/_public/bootstrap/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="revistauca/admin/application/_public/bootstrap/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="revistauca/admin/application/_public/bootstrap/js/demo/chart-area-demo.js"></script>
<script src="revistauca/admin/application/_public/bootstrap/js/demo/chart-pie-demo.js"></script>