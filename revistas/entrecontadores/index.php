<?php

$nombre_entidad = "entrecontadores";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">

	<div class="content_title">
	Revistas más recientes
	</div>
	
	<div id="entrecontadores_list">
	
	<p>No hay revistas para mostrar ...</p>
		
	</div> <!-- end #entrecontadoress_list -->
	
	<script>cargarEntreContadores();</script> <!-- ejecuta el llamado Ajax para que el servidor nos devuelva el pintado de la lista de entrecontadores -->
	
	<?
	if($_SESSION["tipo_usuario"] == "administrador"){
		echo "<div id='add_new_entrecontadores' class='add_new' onclick=\"location.href = '/revistauca/revistas/entrecontadores/crud.php?new';\">+</div>";
	}
	?>
	
</div><!-- end #content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>