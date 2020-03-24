
function cargarMachotes(){

	// estilo JavaScript pur
	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				var machoteslist_div = document.getElementById("machotes_list");
				machoteslist_div.innerHTML = "";//machoteslist_div.innerHTML = objetoAjax.responseText;
				if(objetoAjax.responseText !== ""){
					$(machoteslist_div).append(objetoAjax.responseText);
				}
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/machotes_controller.php?select");
		objetoAjax.send(null);

	}
	
	// estilo jQuery
	/*$.ajax({
		url: "/revistauca/__controller/machotes_controller.php?select",
		type: 'GET',
		async: true,
		crossDomain: true,
		cache: false,
		success: function(respuestaServidor){
			$("#machotes_list").html(respuestaServidor);
		}
	});*/
}


function showMachote(machoteId){
	location.href = "/revistauca/machotes/detail.php?machoteid=" + machoteId;
}

var highlightfirst = false;
function cargarComentariosMachote(machoteId) {

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
			
				var arregloComentarios = JSON.parse(objetoAjax.responseText);
				
				var numeroComentarios = arregloComentarios[0];
				
				document.getElementById("machote_comments_count").innerHTML = numeroComentarios.row_count;
				document.getElementById("machote_comments_count_label").innerHTML = (numeroComentarios.row_count == 1) ? "Comentario" : "Comentarios";
				
				var listaComentarios = arregloComentarios[1];
				
				var respuestaFinal = "";
				
				var colaCargasImagenes = [];
				
				for( i = 0; i < listaComentarios.length; i++ ) {
				
					var objetoActual = listaComentarios[i];
					
					var comentarioHTML = "<div class='machote_comments_item' id='machote_comment_" + objetoActual.id + "' >";
					comentarioHTML += "<div>";
					comentarioHTML += "	<div class='machote_comment_thumbnail'>";
					comentarioHTML += "		<img class='img" + objetoActual.id_autor + "' />";
					comentarioHTML += "	</div>";
					comentarioHTML += "	<div class='machote_comment_text'>";
					comentarioHTML += "		<div class='machote_detail_author_date'>";
					comentarioHTML += "			<div class='inline'><h4 class='machote_comment_author'><span class='nombre" + objetoActual.id_autor + "' >...</span></h4></div>";
					comentarioHTML += "			<div class='inline'>, </div>";
					comentarioHTML += "			<div class='inline'><h4 class='machote_comment_date'>" + objetoActual.creado + "</h4></div>";
					comentarioHTML += "		</div>";
					comentarioHTML += "		<div class='machote_comment_onlytext' >";
					comentarioHTML += "		" + objetoActual.comentario + "";
					comentarioHTML += "		</div>";
					comentarioHTML += "	</div>";
					comentarioHTML += "</div>";
					comentarioHTML += "<!--<div class='machote_comment_buttons' style='display: none;'>";
					comentarioHTML += "	<div class='inline'>Like</div>";
					comentarioHTML += "	<div class='inline'>Dislike</div>";
					comentarioHTML += "</div>-->";
					comentarioHTML += "</div> <!-- end .machote_comments_item -->";
						
					respuestaFinal += comentarioHTML;
						
					colaCargasImagenes.push("<script>cargarImagenNombre(" + objetoActual.id_autor + ");</script>");
						
				}
				
				document.getElementById("machote_comments_list").innerHTML = respuestaFinal;
				
				for(i = 0; i < colaCargasImagenes.length; i++){
					$(document.body).append(colaCargasImagenes[i]);
				}
				
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/machotes_controller.php?select&machoteid=" + machoteId + "&comments&json");
		objetoAjax.send(null);
		
		if(highlightfirst){
			var condicion = 1;
			$(".machote_comments_item").each(function(){
				if(condicion == 1){
					function unhighlight(){
						var condicion2 = 1;
						$(".machote_comments_item").each(function(){
							if(condicion2 == 1){
								$(this).css("background", "");
								condicion2++;
							}
						});
					};
					function highlight(){
						var condicion2 = 1;
						$(".machote_comments_item").each(function(){
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

function mostrarImagenMachote(event) {
	var imagen = document.getElementById('machotePreviewImg');
	imagen.src = URL.createObjectURL(event.target.files[0]);
	URL.revokeObjectURL(event.target.files[0]);
};
				
function crearMachote(machoteId){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					alert("Machote publicado con exito!");
					location.href = "/revistauca/machotes/";
				}
				else{
					alert("No se pudo publicar el machote ...");
				}
			}

		}
		
		//var machoteId = document.getElementById('machoteId').innerHTML.trim();
		if(machoteId == '')
			objetoAjax.open("POST", "/revistauca/__controller/machotes_controller.php?insert", true);
		else
			objetoAjax.open("POST", "/revistauca/__controller/machotes_controller.php?insert&machoteid=" + machoteId + "", true);
		
		var inputFile = document.getElementById('machotePreview');
		var machotePreview = inputFile.files[0];
		
		var machoteTitle = document.getElementById('machoteTitle').value;
		var machoteDescription = document.getElementById('machoteDescription').innerHTML;
		var machoteContent = document.getElementById('machoteContent').innerHTML;
		
		var validation = "";
		validation += (machoteTitle.trim() === "") ? "El titulo es obligatorio\n" : "";
		validation += (machoteDescription.trim() === "") ? "La descripcion es obligatoria\n" : "";
		validation += (machoteContent.trim() === "") ? "El contenido es obligatorio\n" : "";
		
		if(validation !== ""){
			alert(validation);
			return;
		}
		
		var formData = new FormData();
		formData.append("preview", machotePreview);
		formData.append("titulo", machoteTitle);
		formData.append("descripcion", machoteDescription);
		formData.append("contenido", machoteContent);
		
		objetoAjax.send(formData);
	}
}

function enviarComment(){
	
	if(document.getElementById('machote_comment_edittext').innerHTML.trim() === ""){
		return;
	}

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				if(objetoAjax.responseText == 1){
					highlightfirst = true;
					cargarComentariosMachote(document.getElementById('id_padre').value);
					document.getElementById('machote_comment_edittext').innerHTML = '';
				}
				else{
					alert("No se pudo enviar el comentario ...");
				}
			}

		}

		objetoAjax.open("POST", "/revistauca/__controller/machotes_controller.php?newcomment", true);
		
		var formData = new FormData();
		formData.append("id_padre", document.getElementById('id_padre').value);
		formData.append("comentario", document.getElementById('machote_comment_edittext').innerHTML);
		
		objetoAjax.send(formData);
	}
}


function eliminarMachote(){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					
					alert("Machote eliminado con exito!");
					location.href = "/revistauca/machotes/";
				}
				else{
					alert("No se pudo eliminar el machote ...");
				}
			}

		}
		
		var machoteId = document.getElementById('machoteId').innerHTML.trim();
		objetoAjax.open("POST", "/revistauca/__controller/machotes_controller.php?machoteid=" +machoteId+ "&delete", true);
		
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







