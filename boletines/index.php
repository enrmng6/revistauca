<?php

$nombre_entidad = "boletines";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">

	<div class="content_title">
	Boletines más recientes
	</div>
	
	<div id="boletines_list">
	
	<p>No hay boletines para mostrar ...</p>
		
	</div> <!-- end #boletiness_list -->
	
	<script>cargarBoletines();</script> <!-- ejecuta el llamado Ajax para que el servidor nos devuelva el pintado de la lista de boletines -->
	
	<?
	if($_SESSION["tipo_usuario"] == "administrador"){
		echo "<div id='add_new_boletines' class='add_new' onclick=\"location.href = '/revistauca/boletines/crud.php?new';\">+</div>";
	}
	?>
	
</div><!-- end #content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>