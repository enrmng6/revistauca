<? 
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head ('Content-Type: text/html; charset=UTF-8' 'Cache-Control: no-cache, must-revalidate')>
	<meta charset="UTF-8">
	<meta name="description" content="description."/>
	<meta name="HanheldFriendly" content="true"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="/revistauca/_public/css/Estilos_Articulos.css">
	<link rel="stylesheet" type="text/css" href="/revistauca/_public/css/calendario.css">
	<link rel="shortcut icon" type="image/x-icon" href="/revistauca/_public/img/Logo-UCA-2017.ico">
	<script src="/revistauca/_public/js/js_menu_left.js"></script>
	<script src="/revistauca/_public/js/Calendario.js"></script>
                <link rel="stylesheet" type="text/css" href="/revistauca/_public/css/blogstyle.css"/>
				<script src="/revistauca/_public/js/leftPopOut.js"></script>

	<link rel="stylesheet" href="/revistauca/_public/css/stylemenu.css">
    
	<title>Revista UCA App - Calendario</title>
</head>

<body>
	<script>cargar_calendario_ajax()</script>
	
		<div id="Menu1" >
			
			
            <img src="/revistauca/_public/img/Opciones_pag.PNG" width="50" alt="Enviar" id="opciones" onclick="showLeftMenu();"  style="cursor: pointer;" class="iconos">
             
			<div style="float: left; width: 50px; height:50px;">
						<img href="/revistauca/perfil/" src="<? echo $_SESSION['imagen_usuario']; ?>" width="50" id="perfil" class="iconos" style="width: 100%; height:100%; border-radius: 50%; cursor: pointer;" onclick="location.href = '/revistauca/usuarios/perfil.php';" />
                        </div>
						
			<h1 id="titulo" style="margin: 3%; padding-left: 3%;">Calendario</h1>
		</div>
      
		<div id="Mes">
			<h3 style="margin: 0;"></h3>
		</div>
                          
        
		<div id="Contenido">
        
        	
		</div>
		
		
		<!-- left_popout -->
						
		<div id="left_popout_cover">
		</div>
		
		<div id="left_popout">
		<!--<div class="left_popout_item" onclick="location.href = '/revistauca/blog/bloghome.php';">
			<img src="/revistauca/_public/img/inicio.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Inicio</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/blog/bloghome.php';">
			<img src="/revistauca/_public/img/blog.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Blog</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/articulos/articulos.html';">
			<img src="/revistauca/_public/img/articulos.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Art�culos</a>
		</div>-->
		<div class="left_popout_item" onclick="location.href = '/revistauca/blog/bloghome.php';">
			<img src="/revistauca/_public/img/blog.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Blog</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/educar/educar.html';">
			<img src="/revistauca/_public/img/revistas.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>EdUCAr</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/entrecontadores/entrecontadores.html';">
			<img src="/revistauca/_public/img/revistas.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Entre Contadores</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/ucaprofesional/ucaprofesional.html';">
			<img src="/revistauca/_public/img/revistas.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>UCA Profesional</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/boletines/boletines.html';">
			<img src="/revistauca/_public/img/articulos.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Boletines</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/proyectosytesis/proyectosytesis.html';">
			<img src="/revistauca/_public/img/proyectos.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Proyectos y Tesis</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/about/about.php';">
			<img src="/revistauca/_public/img/about.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>About</a>
		</div>
		<div class="left_popout_item" onclick="document.location.href = '/revistauca/usuarios/logout.php';">
			<img src="/revistauca/_public/img/salir.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Salir</a>
		</div>
	</div> <!-- end left_popout -->

<script>response_c()</script>
</body>
</html>