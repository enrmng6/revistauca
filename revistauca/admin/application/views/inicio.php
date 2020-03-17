
<div id="container">
	<h1>Hola <?php echo $_SESSION['nombre_usuario']; ?>, bienvenid@ a la administracion de la App RevistaUCA</h1>

	<div id="body">
		<p>Elija alguna de las siguientes opciones</p>

		<center>
			<table>
				<tr>
					<td><img id="enlaceusuarios" src="/revistauca/_public/img/Perfil.png" alt="Usuarios"><span>Usuarios</span></td>
					<td><img id="enlacenoticias" src="/revistauca/_public/img/blog.png" alt="Noticias"><span>Noticias</span></td>
					<td><img id="enlaceentrecontadores" src="/revistauca/_public/img/revistas.png" alt="Entre Contadores"><span>Entre Contadores</span></td>
					<td><img id="enlaceeducar" src="/revistauca/_public/img/revistas.png" alt="EdUCAr"><span>EdUCAr</span></td>
				</tr>
				<tr>
					<td><img id="enlaceucaprofesional" src="/revistauca/_public/img/revistas.png" alt="UCA Profesional"><span>UCA Profesional</span></td>
					<td><img id="enlaceboletines" src="/revistauca/_public/img/articulos.png" alt="Boletines"><span>Boletines</span></td>
					<td><img id="enlacecalendario" src="/revistauca/_public/img/calendario.png" alt="Calendario"><span>Calendario</span></td>
					<td><img id="enlaceabout" src="/revistauca/_public/img/about.png" alt="About"><span>About</span></td>
				</tr>
			</table>
		</center>
		
		<p id="enlacemachotes">
			Machotes (versi?n de prueba)
		</p>
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<script type="text/javascript">
//$(document).ready(function(){
	$('#enlacemachotes').click(function(){
		location.href = "/revistauca/admin/machotes";
	});
	
	$('#enlaceusuarios').click(function(){
		location.href = "/revistauca/admin/usuarios";
	});
	
	$('#enlacenoticias').click(function(){
		location.href = "/revistauca/admin/noticias";
	});
	
	$('#enlaceentrecontadores').click(function(){
		location.href = "/revistauca/admin/entrecontadores";
	});
	
	$('#enlaceeducar').click(function(){
		location.href = "/revistauca/admin/educar";
	});
	
	$('#enlaceucaprofesional').click(function(){
		location.href = "/revistauca/admin/ucaprofesional";
	});
	
	$('#enlaceboletines').click(function(){
		location.href = "/revistauca/admin/boletines";
	});
	
	$('#enlacecalendario').click(function(){
		location.href = "/revistauca/admin/calendario";
	});
	
	$('#enlaceabout').click(function(){
		location.href = "/revistauca/admin/about";
	});

</script>