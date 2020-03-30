
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
