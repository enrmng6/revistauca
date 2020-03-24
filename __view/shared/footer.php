
	<!-- <div style="height: 30px; display: block;">
	</div> -->
					
					
	<?
	//if($_SESSION["tipo"] == "administrador"){
		//echo "<div id='add_new_post' onclick=\"location.href = '/revistauca/blog/blogcrud.php?new';\">+</div>";
	//}
	?>
	
	<!-- left_popout -->
	
	<div id="left_popout_cover" onclick="showLeftMenu();">
	</div>
	
	<div id="left_popout">
		<div class="left_popout_item" onclick="location.href = '/revistauca/noticias/';">
			<img src="/revistauca/_public/img/blog.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Noticias</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/educar/';">
			<img src="/revistauca/_public/img/revistas.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>EdUCAr</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/entrecontadores/';">
			<img src="/revistauca/_public/img/revistas.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Entre Contadores</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/ucaprofesional/';">
			<img src="/revistauca/_public/img/revistas.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>UCA Profesional</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/boletines/';">
			<img src="/revistauca/_public/img/articulos.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Boletines</a>
		</div>
		<!--<div class="left_popout_item" onclick="location.href = '/revistauca/proyectosytesis/proyectosytesis.html';">
			<img src="/revistauca/_public/img/proyectos.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Proyectos y Tesis</a>
		</div>-->
		<div class="left_popout_item" onclick="location.href = '/revistauca/calendario/';">
			<img src="/revistauca/_public/img/calendario.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Calendario</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/about/';">
			<img src="/revistauca/_public/img/about.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>About</a>
		</div>
		<div class="left_popout_item" onclick="logout();">
			<img src="/revistauca/_public/img/salir.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Salir</a>
		</div>
	</div> <!-- end left_popout -->	
</body>
</html>