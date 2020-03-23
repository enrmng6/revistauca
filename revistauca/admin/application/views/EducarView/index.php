
<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/machotesstyle.css">

<div id="container">
	<h1>Hola <?php echo $_SESSION['nombre_usuario']; ?>, bienvenid@ a la administracion de la App RevistaUCA</h1>

	<div id="body">
		<p>Elija alguno de las siguientes Revistas Educar</p>
		<input type="button" onclick="location.href= '<?=base_url("educar_controller/create_view")?>'" value="Crear uno nuevo">
			<input type="button" onclick="location.href= '<?=base_url()?>'" value="Inicio">
		<center>
			<table border="1">
				<tr>
					<th><h2>Titulo</h2></th>
					<th><h2>Descripcion</h2></th>
					<th><h2>Autor</h2></th>
					<th colspan="2"><h2>Acciones</h2></th>
					<hr>
				</tr>
			<?php
			foreach ($ver as $fila){ ?>
				<tr>
					<td><?=$fila->titulo;?></td>
					<td><?=$fila->descripcion; ?></td>
					<td>
						<?php
					foreach($ver_usuarios as $fila2){
						if ($fila->id_autor==$fila2->id) {
					$usuariosnombre=$fila2->nombre;
					 break;
				 }
					else {
								$usuariosnombre="Autor desconocido";
					}
						}
	?>
						<?=$usuariosnombre; ?>
					</td>
					<td><br><input type="button" onclick="location.href= '/revistauca/admin/educar_controller/mod/<?=$fila->id;?>';" value="Editar"></td>
					<td><br><input type="button" onclick="location.href= '/revistauca/admin/educar_controller/eliminar/<?=$fila->id;?>';" value="Eliminar"></td>
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
