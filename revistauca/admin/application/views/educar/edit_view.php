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

<h1>Editar un Revista Educar</h1>

<form id="machotes_form" action=" " method="POST">
  <?php foreach ($mod as $fila){ ?>
	<label for="titulo">Titulo</label>
	<input type="text" id="titulo" name="titulo" value="<?=$fila->titulo; ?>"/><br>

	<label for="descripcion">Descripcion</label><br>
	<label for=""></label>
	<textarea id="descripcion" name="descripcion"><?=$fila->descripcion; ?></textarea><br>

	<label for="contenido">Contenido</label><br>
	<label for=""></label>
	<textarea id="_contenido" name="contenido"><?=$fila->contenido; ?></textarea><br>

	<label for="preview">Preview</label>
	<input type="text" id="preview" name="preview" value="<?=$fila->preview; ?>"/><br>

	<label for="archivo">Archivo</label>
	<input type="text" id="archivo" name="archivo" value="<?=$fila->archivo; ?>"/><br>

	<input type="hidden" id="id" name="id" value="<?=$fila->id; ?>"/>

	<label for="submit"></label>
   <input type="submit" name="submit" value="Modificar"/>
	  <?php } ?>
</form>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
<button><a href="<?=base_url("educar")?>"style="color: black; text-decoration:none;">Volver</a>  </button>

</div>

<script type="text/javascript">
//$(document).ready(function(){
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