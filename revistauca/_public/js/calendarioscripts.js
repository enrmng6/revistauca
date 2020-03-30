
function cargarCalendario(){

	// estilo JavaScript pur
	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				var calendariolist_div = document.getElementById("calendario_list");
				calendariolist_div.innerHTML = "";//calendariolist_div.innerHTML = objetoAjax.responseText;
				if(objetoAjax.responseText !== ""){
					$(calendariolist_div).append(objetoAjax.responseText);
				}
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/calendario_controller.php?select");
		objetoAjax.send(null);

	}
	
	// estilo jQuery
	/*$.ajax({
		url: "/revistauca/__controller/calendario_controller.php?select",
		type: 'GET',
		async: true,
		crossDomain: true,
		cache: false,
		success: function(respuestaServidor){
			$("#calendario_list").html(respuestaServidor);
		}
	});*/
}


function showCalendario(calendarioId){
	location.href = "/revistauca/calendario/detail.php?calendarioid=" + calendarioId;
}

var highlightfirst = false;
function cargarComentarioscalendario(calendarioId) {

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
			
				var arregloComentarios = JSON.parse(objetoAjax.responseText);
				
				var numeroComentarios = arregloComentarios[0];
				
				document.getElementById("calendario_comments_count").innerHTML = numeroComentarios.row_count;
				document.getElementById("calendario_comments_count_label").innerHTML = (numeroComentarios.row_count == 1) ? "Comentario" : "Comentarios";
				
				var listaComentarios = arregloComentarios[1];
				
				var respuestaFinal = "";
				
				var colaCargasImagenes = [];
				
				for( i = 0; i < listaComentarios.length; i++ ) {
				
					var objetoActual = listaComentarios[i];
					
					var comentarioHTML = "<div class='calendario_comments_item' id='calendario_comment_" + objetoActual.id + "' >";
					comentarioHTML += "<div>";
					comentarioHTML += "	<div class='calendario_comment_thumbnail'>";
					comentarioHTML += "		<img class='img" + objetoActual.id_autor + "' />";
					comentarioHTML += "	</div>";
					comentarioHTML += "	<div class='calendario_comment_text'>";
					comentarioHTML += "		<div class='calendario_detail_author_date'>";
					comentarioHTML += "			<div class='inline'><h4 class='calendario_comment_author'><span class='nombre" + objetoActual.id_autor + "' >...</span></h4></div>";
					comentarioHTML += "			<div class='inline'>, </div>";
					comentarioHTML += "			<div class='inline'><h4 class='calendario_comment_date'>" + objetoActual.creado + "</h4></div>";
					comentarioHTML += "		</div>";
					comentarioHTML += "		<div class='calendario_comment_onlytext' >";
					comentarioHTML += "		" + objetoActual.comentario + "";
					comentarioHTML += "		</div>";
					comentarioHTML += "	</div>";
					comentarioHTML += "</div>";
					comentarioHTML += "<!--<div class='calendario_comment_buttons' style='display: none;'>";
					comentarioHTML += "	<div class='inline'>Like</div>";
					comentarioHTML += "	<div class='inline'>Dislike</div>";
					comentarioHTML += "</div>-->";
					comentarioHTML += "</div> <!-- end .calendario_comments_item -->";
						
					respuestaFinal += comentarioHTML;
						
					colaCargasImagenes.push("<script>cargarImagenNombre(" + objetoActual.id_autor + ");</script>");
						
				}
				
				document.getElementById("calendario_comments_list").innerHTML = respuestaFinal;
				
				for(i = 0; i < colaCargasImagenes.length; i++){
					$(document.body).append(colaCargasImagenes[i]);
				}
				
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/calendario_controller.php?select&calendarioid=" + calendarioId + "&comments&json");
		objetoAjax.send(null);
		
		if(highlightfirst){
			var condicion = 1;
			$(".calendario_comments_item").each(function(){
				if(condicion == 1){
					function unhighlight(){
						var condicion2 = 1;
						$(".calendario_comments_item").each(function(){
							if(condicion2 == 1){
								$(this).css("background", "");
								condicion2++;
							}
						});
					};
					function highlight(){
						var condicion2 = 1;
						$(".calendario_comments_item").each(function(){
							if(condicion2 == 1){
								$(this).css("background", "orange");
								condicion2++;
								setTimeout(unhighlight, 5000);
							}
						});
					};
					setTimeout(highlight, 100);
				}
				condicion++;
			});
		}
		
	}
}

function cargarImagenNombre(id_autor){
	
	// CODIGO PARA CARGAR IMAGEN VIA JSON/AJAX/PHP
	$.ajax({
		type:"GET",
		url:"/revistauca/__controller/usuarios_controller.php?select&userid=" + id_autor + "&json",
		success:function(responseText){
			
			var jsonObject = JSON.parse(responseText);
			jsonObject = jsonObject[0];
			
			$(".img" + id_autor + "").each(function(){
				$(this).attr("src", jsonObject.imagen);
			});
			
			$(".nombre" + id_autor + "").each(function(){
				$(this).html(jsonObject.nombre);
			});
		}
	});
}

function mostrarImagenCalendario(event) {
	var imagen = document.getElementById('calendarioPreviewImg');
	imagen.src = URL.createObjectURL(event.target.files[0]);
	URL.revokeObjectURL(event.target.files[0]);
};
				
function crearCalendario(calendarioId){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					alert("calendario publicado con exito!");
					location.href = "/revistauca/calendario/";
				}
				else{
					alert("No se pudo publicar el calendario ...");
				}
			}

		}
		
		//var calendarioId = document.getElementById('calendarioId').innerHTML.trim();
		if(calendarioId == '')
			objetoAjax.open("POST", "/revistauca/__controller/calendario_controller.php?insert", true);
		else
			objetoAjax.open("POST", "/revistauca/__controller/calendario_controller.php?insert&calendarioid=" + calendarioId + "", true);
		
		var inputFile = document.getElementById('calendarioPreview');
		var calendarioPreview = inputFile.files[0];
		
		var calendarioTitle = document.getElementById('calendarioTitle').value;
		var calendarioDescription = document.getElementById('calendarioDescription').innerHTML;
		var calendarioContent = document.getElementById('calendarioContent').innerHTML;
		
		var validation = "";
		validation += (calendarioTitle.trim() === "") ? "El titulo es obligatorio\n" : "";
		validation += (calendarioDescription.trim() === "") ? "La descripcion es obligatoria\n" : "";
		validation += (calendarioContent.trim() === "") ? "El contenido es obligatorio\n" : "";
		
		if(validation !== ""){
			alert(validation);
			return;
		}
		
		var formData = new FormData();
		formData.append("preview", calendarioPreview);
		formData.append("titulo", calendarioTitle);
		formData.append("descripcion", calendarioDescription);
		formData.append("contenido", calendarioContent);
		
		objetoAjax.send(formData);
	}
}

function enviarComment(){
	
	if(document.getElementById('calendario_comment_edittext').innerHTML.trim() === ""){
		return;
	}

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				if(objetoAjax.responseText == 1){
					highlightfirst = true;
					cargarComentarioscalendario(document.getElementById('id_padre').value);
					document.getElementById('calendario_comment_edittext').innerHTML = '';
				}
				else{
					alert("No se pudo enviar el comentario ...");
				}
			}

		}

		objetoAjax.open("POST", "/revistauca/__controller/calendario_controller.php?newcomment", true);
		
		var formData = new FormData();
		formData.append("id_padre", document.getElementById('id_padre').value);
		formData.append("comentario", document.getElementById('calendario_comment_edittext').innerHTML);
		
		objetoAjax.send(formData);
	}
}


function eliminarCalendario(){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					
					alert("calendario eliminado con exito!");
					location.href = "/revistauca/calendario/";
				}
				else{
					alert("No se pudo eliminar el calendario ...");
				}
			}

		}
		
		var calendarioId = document.getElementById('calendarioId').innerHTML.trim();
		objetoAjax.open("POST", "/revistauca/__controller/calendario_controller.php?calendarioid=" +calendarioId+ "&delete", true);
		
		objetoAjax.send();
	}
}


/*var mostrarImagen = function(event) {
	var imagen = document.getElementById('postPreviewImg');
	imagen.src = URL.createObjectURL(event.target.files[0]);
	URL.revokeObjectURL(event.target.files[0]);
};

function subirImagenAjax(){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				alert(objetoAjax.responseText);
			}

		}

		objetoAjax.open("POST", "uploader.php?", true);
		
		var inputFile = document.getElementById('archivo');
		var file = inputFile.files[0];
	
		var formData = new FormData();
		formData.append("archivo", file);
		
		objetoAjax.send(formData);
	}
}*/







