<?php

$nombre_entidad = "calendario";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">

	<div class="content_title">
	Machotes más recientes
	</div>
	
	<div id="machotes_list">
	
	<p>No hay machotes para mostrar ...</p>
		
	</div> <!-- end #machotes_list -->
	
	<script>cargarMachotes();</script> <!-- ejecuta el llamado Ajax para que el servidor nos devuelva el pintado de la lista de machotes -->
	
	<?
	if($_SESSION["tipo_usuario"] == "administrador"){
		echo "<div id='add_new_machote' class='add_new' onclick=\"location.href = '/revistauca/machotes/crud.php?new';\">+</div>";
	}
	?>
	
</div><!-- end #content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>