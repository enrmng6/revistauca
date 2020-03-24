<?php

$nombre_entidad = "educar";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">

	<div class="content_title">
	Revistas más recientes
	</div>
	
	<div id="educar_list">
	
	<p>No hay revistas para mostrar ...</p>
		
	</div> <!-- end #educars_list -->
	
	<script>cargarEducar();</script> <!-- ejecuta el llamado Ajax para que el servidor nos devuelva el pintado de la lista de educar -->
	
	<?
	if($_SESSION["tipo_usuario"] == "administrador"){
		echo "<div id='add_new_educar' class='add_new' onclick=\"location.href = '/revistauca/revistas/educar/crud.php?new';\">+</div>";
	}
	?>
	
</div><!-- end #content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>