<?php

$nombre_entidad = "ucaprofesional";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">

	<div class="content_title">
	Revistas más recientes
	</div>
	
	<div id="ucaprofesional_list">
	
	<p>No hay revistas para mostrar ...</p>
		
	</div> <!-- end #ucaprofesionals_list -->
	
	<script>cargarUcaProfesional();</script> <!-- ejecuta el llamado Ajax para que el servidor nos devuelva el pintado de la lista de ucaprofesional -->
	
	<?
	if($_SESSION["tipo_usuario"] == "administrador"){
		echo "<div id='add_new_ucaprofesional' class='add_new' onclick=\"location.href = '/revistauca/revistas/ucaprofesional/crud.php?new';\">+</div>";
	}
	?>
	
</div><!-- end #content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>