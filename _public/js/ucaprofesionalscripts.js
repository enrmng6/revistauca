
function cargarUcaProfesional(){

	// estilo JavaScript pur
	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				var ucaprofesionallist_div = document.getElementById("ucaprofesional_list");
				ucaprofesionallist_div.innerHTML = "";//ucaprofesionalslist_div.innerHTML = objetoAjax.responseText;
				if(objetoAjax.responseText !== ""){
					$(ucaprofesionallist_div).append(objetoAjax.responseText);
				}
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/ucaprofesional_controller.php?select");
		objetoAjax.send(null);

	}
	
	// estilo jQuery
	/*$.ajax({
		url: "/revistauca/__controller/ucaprofesional_controller.php?select",
		type: 'GET',
		async: true,
		crossDomain: true,
		cache: false,
		success: function(respuestaServidor){
			$("#ucaprofesionals_list").html(respuestaServidor);
		}
	});*/
}


function showUcaProfesional(ucaProfesionalId){
	location.href = "/revistauca/revistas/ucaprofesional/detail.php?ucaprofesionalid=" + ucaProfesionalId;
}

var highlightfirst = false;
var lastcount = 0;
function cargarComentariosUcaProfesional(ucaProfesionalId) {

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
			
				var arregloComentarios = JSON.parse(objetoAjax.responseText);
				
				var numeroComentarios = arregloComentarios[0];
				
				document.getElementById("ucaprofesional_comments_count").innerHTML = numeroComentarios.row_count;
				document.getElementById("ucaprofesional_comments_count_label").innerHTML = (numeroComentarios.row_count == 1) ? "Comentario" : "Comentarios";
				
				if(numeroComentarios.row_count == 0){
					document.getElementById("ucaprofesional_comments_count").innerHTML = "";
					document.getElementById("ucaprofesional_comments_count_label").innerHTML = "¡Deja el primer comentario!";
				}
				
				if(numeroComentarios.row_count == lastcount){
					return;
				}
				lastcount = numeroComentarios.row_count;
				
				var listaComentarios = arregloComentarios[1];
				
				var respuestaFinal = "";
				
				var colaCargasImagenes = [];
				
				for( i = 0; i < listaComentarios.length; i++ ) {
				
					var objetoActual = listaComentarios[i];
					
					var comentarioHTML = "<div class='ucaprofesional_comments_item' id='ucaprofesional_comment_" + objetoActual.id + "' >";
					comentarioHTML += "<div>";
					comentarioHTML += "	<div class='ucaprofesional_comment_thumbnail'>";
					comentarioHTML += "		<img class='img" + objetoActual.id_autor + "' />";
					comentarioHTML += "	</div>";
					comentarioHTML += "	<div class='ucaprofesional_comment_text'>";
					comentarioHTML += "		<div class='ucaprofesional_detail_author_date'>";
					comentarioHTML += "			<div class='inline'><h4 class='ucaprofesional_comment_author'><span class='nombre" + objetoActual.id_autor + "' >...</span></h4></div>";
					comentarioHTML += "			<div class='inline'>, </div>";
					comentarioHTML += "			<div class='inline'><h4 class='ucaprofesional_comment_date'>" + objetoActual.creado + "</h4></div>";
					comentarioHTML += "		</div>";
					comentarioHTML += "		<div class='ucaprofesional_comment_onlytext' >";
					comentarioHTML += "		" + objetoActual.comentario + "";
					comentarioHTML += "		</div>";
					comentarioHTML += "	</div>";
					comentarioHTML += "</div>";
					comentarioHTML += "<div class='ucaprofesional_comment_buttons_left'>";
					comentarioHTML += "	<div class='inline'>";
					comentarioHTML += "		<img class='commentLikeImg' style='width: 25px; height: 25px; cursor:pointer; margin-right: 10px;' onclick=\"\" src='/revistauca/_public/img/like.png'>";
					comentarioHTML += "	</div>";
					comentarioHTML += "	<div class='inline'>";
					comentarioHTML += "		<img class='commentDislikeImg' style='width: 25px; height: 25px; cursor:pointer; margin-right: 10px;' onclick=\"\" src='/revistauca/_public/img/dislike.png'>";
					comentarioHTML += "	</div>";
					comentarioHTML += "	<div class='inline'>";
					comentarioHTML += "		<img class='commentDeleteImg' style='display: none; width: 25px; height: 25px; cursor:pointer; margin-right: 10px;' onclick=\"if(confirm('¿Seguro que desea eliminar este comentario?')){eliminarComment(" + objetoActual.id + ");}\" src='/revistauca/_public/img/cancelicon.png'>";
					comentarioHTML += "	</div>";
					comentarioHTML += "</div>";
					comentarioHTML += "</div> <!-- end .ucaprofesional_comments_item -->";
						
					respuestaFinal += comentarioHTML;
						
					colaCargasImagenes.push("<script>cargarImagenNombre(" + objetoActual.id_autor + ");</script>");
						
				}
				
				document.getElementById("ucaprofesional_comments_list").innerHTML = respuestaFinal;
				
				for(i = 0; i < colaCargasImagenes.length; i++){
					$(document.body).append(colaCargasImagenes[i]);
				}
				
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/ucaprofesional_controller.php?select&ucaprofesionalid=" + ucaProfesionalId + "&comments&json");
		objetoAjax.send(null);
		
		if(highlightfirst){
			var condicion = 1;
			$(".ucaprofesional_comments_item").each(function(){
				if(condicion == 1){
					function unhighlight(){
						var condicion2 = 1;
						$(".ucaprofesional_comments_item").each(function(){
							if(condicion2 == 1){
								$(this).css("background", "");
								condicion2++;
							}
						});
					};
					function highlight(){
						var condicion2 = 1;
						$(".ucaprofesional_comments_item").each(function(){
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

function mostrarImagenUcaProfesional(event) {
	var imagen = document.getElementById('ucaprofesionalPreviewImg');
	imagen.src = URL.createObjectURL(event.target.files[0]);
	URL.revokeObjectURL(event.target.files[0]);
};
				
function crearUcaProfesional(ucaProfesionalId){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					alert("Revista publicada con exito!");
					location.href = "/revistauca/revistas/ucaprofesional/";
				}
				else{
					alert("No se pudo publicar la revista ...");
				}
			}

		}
		
		//var ucaprofesionalId = document.getElementById('ucaprofesionalId').innerHTML.trim();
		if(ucaProfesionalId == '')
			objetoAjax.open("POST", "/revistauca/__controller/ucaprofesional_controller.php?insert", true);
		else
			objetoAjax.open("POST", "/revistauca/__controller/ucaprofesional_controller.php?insert&ucaprofesionalid=" + ucaProfesionalId + "", true);
		
		var inputFile = document.getElementById('ucaprofesionalPreview');
		var ucaprofesionalPreview = inputFile.files[0];
		
		var ucaprofesionalTitle = document.getElementById('ucaprofesionalTitle').value;
		var ucaprofesionalDescription = document.getElementById('ucaprofesionalDescription').innerHTML;
		var ucaprofesionalContent = document.getElementById('ucaprofesionalContent').innerHTML;
		
		var ucaprofesionalArchivo = document.getElementById('ucaprofesionalArchivo').innerHTML;
		ucaprofesionalArchivo = ucaprofesionalArchivo.split("<br>")[0];
		
		var validation = "";
		validation += (ucaprofesionalTitle.trim() === "") ? "El titulo es obligatorio\n" : "";
		validation += (ucaprofesionalDescription.trim() === "") ? "La descripcion es obligatoria\n" : "";
		validation += (ucaprofesionalContent.trim() === "") ? "El contenido es obligatorio\n" : "";
		
		if(validation !== ""){
			alert(validation);
			return;
		}
		
		var formData = new FormData();
		formData.append("preview", ucaprofesionalPreview);
		formData.append("titulo", ucaprofesionalTitle);
		formData.append("descripcion", ucaprofesionalDescription);
		formData.append("contenido", ucaprofesionalContent);
		formData.append("archivo", ucaprofesionalArchivo);
		
		objetoAjax.send(formData);
	}
}

function enviarComment(){
	
	if(document.getElementById('ucaprofesional_comment_edittext').innerHTML.trim() === ""){
		return;
	}

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				if(objetoAjax.responseText == 1){
					highlightfirst = true;
					cargarComentariosUcaProfesional(document.getElementById('id_padre').value);
					document.getElementById('ucaprofesional_comment_edittext').innerHTML = '';
				}
				else{
					alert("No se pudo enviar el comentario ...");
				}
			}

		}

		objetoAjax.open("POST", "/revistauca/__controller/ucaprofesional_controller.php?newcomment", true);
		
		var formData = new FormData();
		formData.append("id_padre", document.getElementById('id_padre').value);
		formData.append("comentario", document.getElementById('ucaprofesional_comment_edittext').innerHTML);
		
		objetoAjax.send(formData);
	}
}


function eliminarUcaProfesional(){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					
					alert("Revista eliminada con exito!");
					location.href = "/revistauca/revistas/ucaprofesional/";
				}
				else{
					alert("No se pudo eliminar la revista ...");
				}
			}

		}
		
		var ucaProfesionalId = document.getElementById('ucaprofesionalId').innerHTML.trim();
		objetoAjax.open("POST", "/revistauca/__controller/ucaprofesional_controller.php?ucaprofesionalid=" +ucaProfesionalId+ "&delete", true);
		
		objetoAjax.send();
	}
}


function eliminarComment(id_comment){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				if(objetoAjax.responseText == 1){
					alert("Comentario eliminado!");
					//document.getElementById('ucaprofesional_comment_' + id_comment + '').style.display = 'none';
					cargarComentariosUcaProfesional(document.getElementById('id_padre').value);
				}
				else{
					alert("No se pudo eliminar el comentario ...");
				}
			}

		}

		objetoAjax.open("POST", "/revistauca/__controller/ucaprofesional_controller.php?deletecomment", true);
		
		var formData = new FormData();
		//formData.append("id_padre", document.getElementById('id_padre').value);
		formData.append("comentario", id_comment);
		
		objetoAjax.send(formData);
	}
}



function refreshComments(){
	//console.log("Refrescando comentarios");
	try{
		cargarComentariosUcaProfesional(document.getElementById('id_padre').value);
	}
	catch(err){
		//console.log("Refrescando comentarios");
	}
	setTimeout(refreshComments, 30000);
};


refreshComments();


function registrarVisita(idElemento){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				//alert(objetoAjax.responseText);
				if(objetoAjax.responseText == 1){
					//console.log("Visita registrada!");
				}
				else{
					//console.log("No se pudo registrar la visita ...");
				}
			}

		}
		
		objetoAjax.open("POST", "/revistauca/__controller/visitas_controller.php?insert", true);
		
		var formData = new FormData();
		formData.append("id_elemento", idElemento);
		formData.append("entidad", 'noticias');
		
		objetoAjax.send(formData);
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







