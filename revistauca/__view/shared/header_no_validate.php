<? 
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);

$controller = null;

if($nombre_entidad == 'machote'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/machotes_controller.php";
	$controller = new Machotes_Controller();
}
else if($nombre_entidad == 'usuario'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/usuarios_controller.php";
	$controller = new Usuarios_Controller();
}
else if($nombre_entidad == 'otro'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/otros_controller.php";
	//$controller = new Otro_Controller();
}
else{
	return;
}

?>
<!-- Esto es un comentario en HTML <> -->

<!DOCTYPE html>  <!-- validacion html -->

<html>
<head>
<!-- <head ('Content-Type: text/html; charset=UTF-8' 'Cache-Control: no-cache, must-revalidate')> -->
	<meta charset="UTF-8">
	<title>RevistaUCA - <? echo $nombre_entidad; ?></title>
	
	<meta name="HanheldFriendly" content="true"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	
	<link rel="shortcut icon" type="image/x-icon" href="/revistauca/_public/img/Logo-UCA-2017.ico">
	<link rel="stylesheet" href="/revistauca/_public/css/headerstyle.css?" media="screen" />
	<link rel="stylesheet" href="/revistauca/_public/css/<? echo $nombre_entidad; ?>style.css?" media="screen" />
	<link rel="stylesheet" href="/revistauca/_public/css/footerstyle.css?" media="screen" />
	<!-- <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> -->
	
	<script src="/revistauca/_public/js/jquery.min.js"></script>
	<script src="/revistauca/_public/js/header.js?"></script>
    <script src="/revistauca/_public/js/<? echo $nombre_entidad; ?>scripts.js?"></script>
</head>
<body>
	