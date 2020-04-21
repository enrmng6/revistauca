
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

<h1>Editar una Noticia</h1>

<form id="machotes_form" action="/revistauca/admin/noticias/crear" method="POST" onsubmit="return false;">
	
	<label for="titulo">Titulo</label>
	<input type="text" id="titulo" name="titulo" value="<?php echo $machote['titulo']; ?>"/><br>
	
	<label for="id_autor">Id de Autor</label>
	<input type="text" id="id_autor" name="id_autor" value="<?php echo $machote['id_autor']; ?>"/><br>
	
	<label for="descripcion">Descripcion</label><br>
	<label for=""></label>
	<textarea id="descripcion" name="descripcion"><?php echo $machote['descripcion']; ?></textarea><br>

	<label for="contenido">Contenido</label><br>
	<label for=""></label>
	<textarea id="_contenido" name="contenido"><?php echo $machote['contenido']; ?></textarea><br>
	
	<label for="preview">Preview</label>
	<input type="text" id="preview" name="preview" value="<?php echo $machote['preview']; ?>"/><br>
	
	<label for="archivo">Archivo</label>
	<input type="text" id="archivo" name="archivo" value="<?php echo $machote['archivo']; ?>"/><br>
	
	<input type="hidden" id="id" name="id" value="<?php echo $machote['id']; ?>"/>

	<label for="submit"></label>
	<input type="submit" id="submit" name="submit" value="Guardar" />
	
	<?php if($machote['id'] !== ""){ ?>
	<input type="submit" id="delete" name="delete" value="Eliminar" />
	<?php } ?>

</form>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
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

		var cadena = "titulo=" + $('#titulo').val() +
					"&id_autor=" + $('#id_autor').val() + 
					"&descripcion=" + $('#descripcion').val() + 
					"&contenido=" + $('#_contenido').val() + 
					"&preview=" + $('#preview').val() + 
					"&archivo=" + $('#archivo').val() + 
					"&id=" + $('#id').val();
					
		var URL = "/revistauca/admin/noticias/crear";
		
		if( ($('#id').val() * 1) > 1 ){
			URL = "/revistauca/admin/noticias/modificar";
		}
		
		$.ajax({
			type: "POST",
			url: URL,
			data: cadena,
			success: function(responseText){
				
				mostrarMensaje(responseText);
			}
		});
	});
	
	
	$(document.getElementById("delete")).click(function(){

		var cadena = "id=" + $('#id').val();
					
		var URL = "/revistauca/admin/noticias/eliminar";
		
		$.ajax({
			type: "POST",
			url: URL,
			data: cadena,
			success: function(responseText){
				mostrarMensaje(responseText);
				if(responseText.indexOf("1") == 0) {
					location.href = "/revistauca/admin/noticias";
				}
			}
		});
	});
	
	function mostrarMensaje(mensaje){
		if(mensaje.indexOf("0") == -1) mensaje = mensaje + ": Datos guardados";
		else mensaje = mensaje + ": Datos no guardados, revise o pongase en contacto con el administrador";
		
		$('#mensajes').text(mensaje);
		$('#mensajes').css("display", "block");
		
		setTimeout("$('#mensajes').hide('slow');", 5000);
	}

</script>

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