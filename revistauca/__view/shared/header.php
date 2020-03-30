<? 
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);

session_start();

$controller = null;
$page_title = "";

if($nombre_entidad == 'machote'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/machotes_controller.php";
	$controller = new Machotes_Controller();
}
else if($nombre_entidad == 'usuario'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/usuarios_controller.php";
	$controller = new Usuarios_Controller();
	$page_title = "Usuarios";
}
else if($nombre_entidad == 'noticias'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/noticias_controller.php";
	$controller = new Noticias_Controller();
	$page_title = "Noticias";
}
else if($nombre_entidad == 'educar'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/educar_controller.php";
	$controller = new Educar_Controller();
	$page_title = "EdUCAr";
}
else if($nombre_entidad == 'entrecontadores'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/entrecontadores_controller.php";
	$controller = new EntreContadores_Controller();
	$page_title = "Entre Contadores";
}
else if($nombre_entidad == 'ucaprofesional'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/ucaprofesional_controller.php";
	$controller = new UcaProfesional_Controller();
	$page_title = "UCA Profesional";
}
else if($nombre_entidad == 'boletines'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/boletines_controller.php";
	$controller = new Boletines_Controller();
	$page_title = "Boletines";
}
else if($nombre_entidad == 'calendario'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/calendario_controller.php";
	$controller = new Calendario_Controller();
	$page_title = "Calendario";
}
else if($nombre_entidad == 'about'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/about_controller.php";
	$controller = new About_Controller();
	$page_title = "Acerca de ...";
}
else if($nombre_entidad == 'otro'){
	include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__controller/otros_controller.php";
	//$controller = new Otro_Controller();
}
else{
	return;
}

//$imagen_usuario = "/revistauca/_public/img/Perfil.png";

if(!isset($_SESSION['id_usuario'])){
	//echo "<meta http-equiv='refresh' content='1; url=/revistauca/usuarios/login.php'>";
	echo "<script>location.href = '/revistauca/usuarios/login.php';</script>";
}

?>
<!-- Esto es un comentario en HTML <> -->

<!DOCTYPE html>  <!-- validacion html -->

<html>
<head>
<!-- <head ('Content-Type: text/html; charset=UTF-8' 'Cache-Control: no-cache, must-revalidate')> -->
	<meta charset="UTF-8">
	<title>Revista UCA - <? echo $page_title; ?></title>
	
	<meta name="HanheldFriendly" content="true"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	
	<link rel="shortcut icon" type="image/x-icon" href="/revistauca/_public/img/Logo-UCA-2017.ico">
	<link rel="stylesheet" href="/revistauca/_public/css/headerstyle.css?" media="screen" />
	<link rel="stylesheet" href="/revistauca/_public/css/<? echo $nombre_entidad; ?>style.css?" media="screen" />
	<link rel="stylesheet" href="/revistauca/_public/css/footerstyle.css?" media="screen" />
	<!-- <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> -->
	
	<script src="/revistauca/_public/js/jquery.min.js"></script>
	<script src="/revistauca/_public/js/header.js?"></script>
	<script src="/revistauca/_public/js/usuarioscripts.js?"></script>
    <script src="/revistauca/_public/js/<? echo $nombre_entidad; ?>scripts.js?"></script>
</head>
<body>

	<div id="header">
	
		<div class="header_fixed">
			<div class="header_menu_left">
				<img id="menu" src="/revistauca/_public/img/Opciones_pag.png" alt="Menu" onclick="showLeftMenu();">
			</div>
			<div class="header_menu_left">
				<img id="perfil" class="menu_rounded" href="/revistauca/perfil/" src="<? echo $_SESSION['imagen_usuario']; ?>" alt="Perfil" onclick="location.href = '/revistauca/usuarios/perfil.php';" />
			</div>
			<div class="header_menu_right">
				<img id="buscar" alt="Buscar" src="/revistauca/_public/img/Lupa.png" onclick="alert('Pronto tendremos esa funcionalidad!');">
			</div>
		</div>
		
	</div>
	