<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Custom fonts for this template-->
<link href="revistauca/admin/application/_public/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
<link href="revistauca/admin/application/_public/bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
<link href="revistauca/admin/application/_public/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/machotesstyle.css">

<div id="container">
	<h1>Hola <?php echo $_SESSION['nombre_usuario']; ?>, bienvenid@ a la administracion de la App RevistaUCA</h1>

	<div id="body">
		<p>Elija alguno de las siguientes Revistas EdUCAr</p>
		<input type="button" onclick="location.href= '<?=base_url("educar/create_view")?>'" value="Crear uno nuevo">
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
					<td><br><input type="button" onclick="location.href= '/revistauca/admin/educar/mod/<?=$fila->id;?>';" value="Editar"></td>
					<td><br><input type="button" onclick="if(confirm('Segur@ que desea eliminar esta publicaciòn?')){location.href= '/revistauca/admin/educar/eliminar/<?=$fila->id;?>';}" value="Eliminar"></td>
				</tr>
			<?php } ?>
			</table>
		</center>

	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>


