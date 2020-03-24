
<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/machotesstyle.css">

<div id="container">
	<h1>Hola <?php echo $_SESSION['nombre_usuario']; ?>, bienvenid@ a la administracion de la App RevistaUCA</h1>

	<div id="body">
		<p>Elija alguno de las siguientes noiticias</p>
		<input type="button" onclick="location.href= '/revistauca/admin/noticias/detail/'" value="Crear una nueva">
		<center>
			<table>
				<tr>
					<th>titulo</th>
					<th>descripcion</th>
					<th>autor</th>
					<th></th>
				</tr>
			<?php
			foreach ( $noticias as $noticia ){ ?>
				<tr>
					<td><?php echo $noticia['titulo']; ?></td>
					<td><?php echo $noticia['descripcion']; ?></td>
					<td><?php echo $noticia['id_autor']; ?></td>
					<td><input type="button" onclick="location.href= '/revistauca/admin/noticias/detail/<?php echo $noticias['id']; ?>';" value="Editar"></td>
				</tr>
			<?php } ?>
			</table>
		</center>
		
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