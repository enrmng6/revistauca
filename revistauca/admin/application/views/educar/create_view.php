
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

  <!-- Custom styles for this template-->
<link href="revistauca/admin/application/_public/bootstrap/css/sb-admin-2.min.css" rel="stylesheet">

  
<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/machotesstyle.css">
<div id="container">

<h1>Crear Nueva Revista</h1>

<form id="machotes_form" action="<?=base_url("educar/add")?>" method="POST">

	<label for="titulo">Titulo</label>
	<input type="text" id="titulo" name="titulo"><br><br>

	<label for="id_autor">Autor</label>
			<select name="id_autor">
	<?php
	foreach($ver_usuarios as $fila2){
	?>
			<option value="<?=$fila2->id;?>"><?=$fila2->nombre;?></option>

			<?php
			}
			?>
	</select><br><br>

	<label for="descripcion">Descripcion</label><br>
	<label for=""></label>
	<textarea id="descripcion" name="descripcion"></textarea><br>

	<label for="contenido">Contenido</label><br>
	<label for=""></label>
	<textarea id="_contenido" name="contenido"></textarea><br>

	<label for="preview">Preview</label>
	<input type="text" id="preview" name="preview"><br>

	<label for="archivo">Archivo</label>
	<input type="text" id="archivo" name="archivo"><br>

	<input type="hidden" id="id" name="id">

	<label for="submit"></label>
	<input type="submit" id="submit" name="submit" value="Guardar" />

</form>
<button><a href="<?=base_url("educar_controller")?>"style="color: black; text-decoration:none;">Volver</a>  </button>

</div>

<script type="text/javascript">

	$(document.getElementById("submit")).click(function(){
		if($('#titulo').val() == ""){
			alert("Debe ingresar un titulo")
			return false;
		}else if($('#id_autor').val() == ""){
			alert("Debe ingresar un id de autor")
			return false;
		}
		else if($('#descripcion').val() == ""){
			alert("Debe ingresar una descripcion")
			return false;
		}
		else if($('#_contenido').val() == ""){
			alert("Deber ingresar un contenido")
			return false;
		}

</script>
// Bootstrap core JavaScript-->
<script src="revistauca/admin/application/_public/bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="revistauca/admin/application/_public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 // Core plugin JavaScript-->
  <script src="revistauca/admin/application/_public/bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

 // Custom scripts for all pages-->
  <script src="revistauca/admin/application/_public/bootstrap/js/sb-admin-2.min.js"></script>

// Page level plugins -->
  <script src="revistauca/admin/application/_public/bootstrap/vendor/chart.js/Chart.min.js"></script>

  // Page level custom scripts -->
  <script src="revistauca/admin/application/_public/bootstrap/js/demo/chart-area-demo.js"></script>
  <script src="revistauca/admin/application/_public/bootstrap/js/demo/chart-pie-demo.js"></script>