
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
