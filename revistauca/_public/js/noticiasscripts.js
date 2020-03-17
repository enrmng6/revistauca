
function cargarNoticias(){

	// estilo JavaScript puro
	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				var noticiaslist_div = document.getElementById("noticias_list");
				noticiaslist_div.innerHTML = "";//noticiaslist_div.innerHTML = objetoAjax.responseText;
				$(noticiaslist_div).append(objetoAjax.responseText);
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/noticias_controller.php?select");
		objetoAjax.send(null);

	}
	
	// estilo jQuery
	/*$.ajax({
		url: "/revistauca/__controller/noticias_controller.php?select",
		type: 'GET',
		async: true,
		crossDomain: true,
		cache: false,
		success: function(respuestaServidor){
			$("#noticias_list").html(respuestaServidor);
		}
	});*/
}


function showNoticia(noticiaId){
	location.href = "/revistauca/noticias/detail.php?noticiaid=" + noticiaId;
}

var highlightfirst = false;
function cargarComentariosNoticia(noticiaId) {

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
			
				var arregloComentarios = JSON.parse(objetoAjax.responseText);
				
				var numeroComentarios = arregloComentarios[0];
				
				document.getElementById("noticia_comments_count").innerHTML = numeroComentarios.row_count;
				document.getElementById("noticia_comments_count_label").innerHTML = (numeroComentarios.row_count == 1) ? "Comentario" : "Comentarios";
				
				var listaComentarios = arregloComentarios[1];
				
				var respuestaFinal = "";
				
				var colaCargasImagenes = [];
				
				for( i = 0; i < listaComentarios.length; i++ ) {
				
					var objetoActual = listaComentarios[i];
					
					var comentarioHTML = "<div class='noticia_comments_item' id='noticia_comment_" + objetoActual.id + "' >";
					comentarioHTML += "<div>";
					comentarioHTML += "	<div class='noticia_comment_thumbnail'>";
					comentarioHTML += "		<img class='img" + objetoActual.id_autor + "' />";
					comentarioHTML += "	</div>";
					comentarioHTML += "	<div class='noticia_comment_text'>";
					comentarioHTML += "		<div class='noticia_detail_author_date'>";
					comentarioHTML += "			<div class='inline'><h4 class='noticia_comment_author'><span class='nombre" + objetoActual.id_autor + "' >...</span></h4></div>";
					comentarioHTML += "			<div class='inline'>, </div>";
					comentarioHTML += "			<div class='inline'><h4 class='noticia_comment_date'>" + objetoActual.creado + "</h4></div>";
					comentarioHTML += "		</div>";
					comentarioHTML += "		<div class='noticia_comment_onlytext' >";
					comentarioHTML += "		" + objetoActual.comentario + "";
					comentarioHTML += "		</div>";
					comentarioHTML += "	</div>";
					comentarioHTML += "</div>";
					comentarioHTML += "<!--<div class='noticia_comment_buttons' style='display: none;'>";
					comentarioHTML += "	<div class='inline'>Like</div>";
					comentarioHTML += "	<div class='inline'>Dislike</div>";
					comentarioHTML += "</div>-->";
					comentarioHTML += "</div> <!-- end .noticia_comments_item -->";
						
					respuestaFinal += comentarioHTML;
						
					colaCargasImagenes.push("<script>cargarImagenNombre(" + objetoActual.id_autor + ");</script>");
						
				}
				
				document.getElementById("noticia_comments_list").innerHTML = respuestaFinal;
				
				for(i = 0; i < colaCargasImagenes.length; i++){
					$(document.body).append(colaCargasImagenes[i]);
				}
				
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/noticias_controller.php?select&noticiaid=" + noticiaId + "&comments&json");
		objetoAjax.send(null);
		
		if(highlightfirst){
			var condicion = 1;
			$(".noticia_comments_item").each(function(){
				if(condicion == 1){
					function unhighlight(){
						var condicion2 = 1;
						$(".noticia_comments_item").each(function(){
							if(condicion2 == 1){
								$(this).css("background", "");
								condicion2++;
							}
						});
					};
					function highlight(){
						var condicion2 = 1;
						$(".noticia_comments_item").each(function(){
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

function mostrarImagenNoticia(event) {
	var imagen = document.getElementById('noticiaPreviewImg');
	imagen.src = URL.createObjectURL(event.target.files[0]);
	URL.revokeObjectURL(event.target.files[0]);
};
				
function crearNoticia(noticiaId){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					alert("Noticia publicada con exito!");
					location.href = "/revistauca/noticias/";
				}
				else{
					alert("No se pudo publicar la noticia ...");
				}
			}

		}
		
		//var noticiaId = document.getElementById('noticiaId').innerHTML.trim();
		if(noticiaId == '')
			objetoAjax.open("POST", "/revistauca/__controller/noticias_controller.php?insert", true);
		else
			objetoAjax.open("POST", "/revistauca/__controller/noticias_controller.php?insert&noticiaid=" + noticiaId + "", true);
		
		var inputFile = document.getElementById('noticiaPreview');
		var noticiaPreview = inputFile.files[0];
		
		var noticiaTitle = document.getElementById('noticiaTitle').value;
		var noticiaDescription = document.getElementById('noticiaDescription').innerHTML;
		var noticiaContent = document.getElementById('noticiaContent').innerHTML;
		
		var validation = "";
		validation += (noticiaTitle.trim() === "") ? "El titulo es obligatorio\n" : "";
		validation += (noticiaDescription.trim() === "") ? "La descripcion es obligatoria\n" : "";
		validation += (noticiaContent.trim() === "") ? "El contenido es obligatorio\n" : "";
		
		if(validation !== ""){
			alert(validation);
			return;
		}
		
		var formData = new FormData();
		formData.append("preview", noticiaPreview);
		formData.append("titulo", noticiaTitle);
		formData.append("descripcion", noticiaDescription);
		formData.append("contenido", noticiaContent);
		
		objetoAjax.send(formData);
	}
}

function enviarComment(){
	
	if(document.getElementById('noticia_comment_edittext').innerHTML.trim() === ""){
		return;
	}

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				if(objetoAjax.responseText == 1){
					highlightfirst = true;
					cargarComentariosNoticia(document.getElementById('id_padre').value);
					document.getElementById('noticia_comment_edittext').innerHTML = '';
				}
				else{
					alert("No se pudo enviar el comentario ...");
				}
			}

		}

		objetoAjax.open("POST", "/revistauca/__controller/noticias_controller.php?newcomment", true);
		
		var formData = new FormData();
		formData.append("id_padre", document.getElementById('id_padre').value);
		formData.append("comentario", document.getElementById('noticia_comment_edittext').innerHTML);
		
		objetoAjax.send(formData);
	}
}


function eliminarNoticia(){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					
					alert("noticia eliminada con exito!");
					location.href = "/revistauca/noticias/";
				}
				else{
					alert("No se pudo eliminar la noticia ...");
				}
			}

		}
		
		var noticiaId = document.getElementById('noticiaId').innerHTML.trim();
		objetoAjax.open("POST", "/revistauca/__controller/noticias_controller.php?noticiaid=" +noticiaId+ "&delete", true);
		
		objetoAjax.send();
	}
}



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










