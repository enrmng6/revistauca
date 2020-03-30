<?php

$nombre_entidad = "calendario";
include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/header.php";

?>
	
<div id="content">

	<div class="content_title">
	Calendario
	</div>
	
	<div id="calendario_list">
	
	<p>No hay eventos para mostrar ...</p>
		
	</div> <!-- end #calendario_list -->
	
	<script>cargarCalendario();</script> <!-- ejecuta el llamado Ajax para que el servidor nos devuelva el pintado de la lista de eventos -->
	
	<?
	if($_SESSION["tipo_usuario"] == "administrador"){
		echo "<div id='add_new_calendario' class='add_new' onclick=\"location.href = '/revistauca/calendario/crud.php?new';\">+</div>";
	}
	?>
	
</div><!-- end #content -->

<?php

include $_SERVER["DOCUMENT_ROOT"] . "/revistauca/__view/shared/footer.php";

?>