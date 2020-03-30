
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
			<img src="/revistauca/_public/img/articulos.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Noticias</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/educar/';">
			<img src="/revistauca/_public/img/logo-educar.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>EdUCAr</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/entrecontadores/';">
			<img src="/revistauca/_public/img/logo-entrecontadores.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Entre Contadores</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/revistas/ucaprofesional/';">
			<img src="/revistauca/_public/img/logo-ucaprofesional.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>UCA Profesional</a>
		</div>
		<div class="left_popout_item" onclick="location.href = '/revistauca/boletines/';">
			<img src="/revistauca/_public/img/blog.png" style="float:left;" />
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
		
		<div class="left_popout_item" onclick="location.href = 'https://www.uca.ac.cr/biblioteca/';">
			<img src="/revistauca/_public/img/revistas.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>EBook</a>
		</div>
		<!--<div class="left_popout_item">
			<table style="margin-left: 10%;"><tr>
				<td onclick="location.href = 'ebook';">
					<img src="/revistauca/_public/img/salir.png" style="float:left; width: 30; height: 30;" />
					<a href="#" style="float:left;"/>EBook</a>
				</td>
			</tr></table>
		</div>-->
		
		<div class="left_popout_item">
			<table><tr>
				<td onclick="location.href = 'https://www.classgestion.com/uca/uvirtual/';">
					<img src="/revistauca/_public/img/logo-ucavirtual.png" />
				</td>
				<td onclick="location.href = 'https://www.facebook.com/ucacr/';" style="border-left: 1px dotted gray;">
					<img src="/revistauca/_public/img/logo-facebook.png" />
				</td>
				<td onclick="location.href = 'https://www.instagram.com/ucacr/?hl=es-la';" style="border-left: 1px dotted gray;">
					<img src="/revistauca/_public/img/logo-instagram.png" />
				</td>
				<tr>
				<td onclick="location.href = 'https://www.classgestion.com/uca/uvirtual/';">
					<a href="#"/>UCA Virtual</a>
				</td>
				<td onclick="location.href = 'https://www.facebook.com/ucacr/';">
					<a href="#"/>Facebook</a>
				</td>
				<td onclick="location.href = 'https://www.instagram.com/ucacr/?hl=es-la';">
					<a href="#"/>Instagram</a>
				</td>
			</tr>
			</tr></table>
		</div>
		
		<div class="left_popout_item" onclick="location.href = '/revistauca/about/';">
			<img src="/revistauca/_public/img/about.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>About</a>
		</div>
		
		<div class="left_popout_item" onclick="logout();">
			<img src="/revistauca/_public/img/salir.png" style="float:left;" />
			<br><a href="#" style="float:left;"/>Salir</a>
		</div>
		
		<div id="left_popout_scroll_cover" onclick="showLeftMenu();"></div>
		
	</div> <!-- end left_popout -->	
	
	
	
</body>
</html>