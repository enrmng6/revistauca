<?php

$nombre_entidad = "noticias";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">

	<div class="content_title">
	Noticias más recientes
	</div>
	
	<div id="noticias_list">
	
	<p>No hay noticias para mostrar ...</p>
		
	</div> <!-- end #noticias_list -->
	
	<script>cargarNoticias();</script> <!-- ejecuta el llamado Ajax para que el servidor nos devuelva el pintado de la lista de noticias -->
	
	<?
	if($_SESSION["tipo_usuario"] == "administrador"){
		echo "<div id='add_new_noticia' class='add_new' onclick=\"location.href = '/revistauca/noticias/crud.php?new';\">+</div>";
	}
	?>
	
</div><!-- end #content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>
