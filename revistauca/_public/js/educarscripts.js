
function cargarEducar(){

	// estilo JavaScript pur
	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				var educarlist_div = document.getElementById("educar_list");
				educarlist_div.innerHTML = "";//educarslist_div.innerHTML = objetoAjax.responseText;
				if(objetoAjax.responseText !== ""){
					$(educarlist_div).append(objetoAjax.responseText);
				}
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/educar_controller.php?select");
		objetoAjax.send(null);

	}
	
	// estilo jQuery
	/*$.ajax({
		url: "/revistauca/__controller/educar_controller.php?select",
		type: 'GET',
		async: true,
		crossDomain: true,
		cache: false,
		success: function(respuestaServidor){
			$("#educars_list").html(respuestaServidor);
		}
	});*/
}


function showEducar(educarId){
	location.href = "/revistauca/revistas/educar/detail.php?educarid=" + educarId;
}

var highlightfirst = false;
var lastcount = 0;
function cargarComentariosEducar(educarId) {

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
			
				var arregloComentarios = JSON.parse(objetoAjax.responseText);
				
				var numeroComentarios = arregloComentarios[0];
				
				document.getElementById("educar_comments_count").innerHTML = numeroComentarios.row_count;
				document.getElementById("educar_comments_count_label").innerHTML = (numeroComentarios.row_count == 1) ? "Comentario" : "Comentarios";
				
				if(numeroComentarios.row_count == 0){
					document.getElementById("educar_comments_count").innerHTML = "";
					document.getElementById("educar_comments_count_label").innerHTML = "¡Deja el primer comentario!";
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
					
					var comentarioHTML = "<div class='educar_comments_item' id='educar_comment_" + objetoActual.id + "' >";
					comentarioHTML += "<div>";
					comentarioHTML += "	<div class='educar_comment_thumbnail'>";
					comentarioHTML += "		<img class='img" + objetoActual.id_autor + "' />";
					comentarioHTML += "	</div>";
					comentarioHTML += "	<div class='educar_comment_text'>";
					comentarioHTML += "		<div class='educar_detail_author_date'>";
					comentarioHTML += "			<div class='inline'><h4 class='educar_comment_author'><span class='nombre" + objetoActual.id_autor + "' >...</span></h4></div>";
					comentarioHTML += "			<div class='inline'>, </div>";
					comentarioHTML += "			<div class='inline'><h4 class='educar_comment_date'>" + objetoActual.creado + "</h4></div>";
					comentarioHTML += "		</div>";
					comentarioHTML += "		<div class='educar_comment_onlytext' >";
					comentarioHTML += "		" + objetoActual.comentario + "";
					comentarioHTML += "		</div>";
					comentarioHTML += "	</div>";
					comentarioHTML += "</div>";
					comentarioHTML += "<div class='educar_comment_buttons_left'>";
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
					comentarioHTML += "</div> <!-- end .educar_comments_item -->";
						
					respuestaFinal += comentarioHTML;
						
					colaCargasImagenes.push("<script>cargarImagenNombre(" + objetoActual.id_autor + ");</script>");
						
				}
				
				document.getElementById("educar_comments_list").innerHTML = respuestaFinal;
				
				for(i = 0; i < colaCargasImagenes.length; i++){
					$(document.body).append(colaCargasImagenes[i]);
				}
				
			}

		}

		objetoAjax.open("GET", "/revistauca/__controller/educar_controller.php?select&educarid=" + educarId + "&comments&json");
		objetoAjax.send(null);
		
		if(highlightfirst){
			var condicion = 1;
			$(".educar_comments_item").each(function(){
				if(condicion == 1){
					function unhighlight(){
						var condicion2 = 1;
						$(".educar_comments_item").each(function(){
							if(condicion2 == 1){
								$(this).css("background", "");
								condicion2++;
							}
						});
					};
					function highlight(){
						var condicion2 = 1;
						$(".educar_comments_item").each(function(){
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

function mostrarImagenEducar(event) {
	var imagen = document.getElementById('educarPreviewImg');
	imagen.src = URL.createObjectURL(event.target.files[0]);
	URL.revokeObjectURL(event.target.files[0]);
};
				
function crearEducar(educarId){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					//hay que hacer la mejora cambiar este alert por un pop up modal
					alert("Revista publicada con exito!");
					location.href = "/revistauca/revistas/educar/";
				}
				else{
					//hay que hacer la mejora cambiar este alert por un pop up modal
					alert("No se pudo publicar la revista ...");
				}
			}

		}
		
		//var educarId = document.getElementById('educarId').innerHTML.trim();
		if(educarId == '')
			objetoAjax.open("POST", "/revistauca/__controller/educar_controller.php?insert", true);
		else
			objetoAjax.open("POST", "/revistauca/__controller/educar_controller.php?insert&educarid=" + educarId + "", true);
		
		var inputFile = document.getElementById('educarPreview');
		var educarPreview = inputFile.files[0];
		
		var educarTitle = document.getElementById('educarTitle').value;
		var educarDescription = document.getElementById('educarDescription').innerHTML;
		var educarContent = document.getElementById('educarContent').innerHTML;
		
		var educarArchivo = document.getElementById('educarArchivo').innerHTML;
		educarArchivo = educarArchivo.split("<br>")[0];
		
		var validation = "";
		validation += (educarTitle.trim() === "") ? "El titulo es obligatorio\n" : "";
		validation += (educarDescription.trim() === "") ? "La descripcion es obligatoria\n" : "";
		validation += (educarContent.trim() === "") ? "El contenido es obligatorio\n" : "";
		
		if(validation !== ""){
			alert(validation);
			return;
		}
		
		var formData = new FormData();
		formData.append("preview", educarPreview);
		formData.append("titulo", educarTitle);
		formData.append("descripcion", educarDescription);
		formData.append("contenido", educarContent);
		formData.append("archivo", educarArchivo);
		
		objetoAjax.send(formData);
	}
}

function enviarComment(){
	
	if(document.getElementById('educar_comment_edittext').innerHTML.trim() === ""){
		return;
	}

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				if(objetoAjax.responseText == 1){
					highlightfirst = true;
					cargarComentariosEducar(document.getElementById('id_padre').value);
					document.getElementById('educar_comment_edittext').innerHTML = '';
				}
				else{
					//hay que hacer la mejora cambiar este alert por un pop up modal
					alert("No se pudo enviar el comentario ...");
				}
			}

		}

		objetoAjax.open("POST", "/revistauca/__controller/educar_controller.php?newcomment", true);
		
		var formData = new FormData();
		formData.append("id_padre", document.getElementById('id_padre').value);
		formData.append("comentario", document.getElementById('educar_comment_edittext').innerHTML);
		
		objetoAjax.send(formData);
	}
}


function eliminarEducar(){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				
				if(objetoAjax.responseText == 1){
					
					//este alert se cambio por un pop up esta en modal.php
					//alert("noticia eliminada con exito!");
					location.href = "/revistauca/revistas/educar/";
				}
				else{
					//hay que hacer la mejora cambiar este alert por un pop up modal
					alert("No se pudo eliminar la revista ...");
				}
			}

		}
		
		var educarId = document.getElementById('educarId').innerHTML.trim();
		objetoAjax.open("POST", "/revistauca/__controller/educar_controller.php?educarid=" +educarId+ "&delete", true);
		
		objetoAjax.send();
	}
}


function eliminarComment(id_comment){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				if(objetoAjax.responseText == 1){
					//hay que hacer la mejora cambiar este alert por un pop up modal
					alert("Comentario eliminado!");
					//document.getElementById('educar_comment_' + id_comment + '').style.display = 'none';
					cargarComentariosEducar(document.getElementById('id_padre').value);
				}
				else{
					//hay que hacer la mejora cambiar este alert por un pop up modal
					alert("No se pudo eliminar el comentario ...");
				}
			}

		}

		objetoAjax.open("POST", "/revistauca/__controller/educar_controller.php?deletecomment", true);
		
		var formData = new FormData();
		//formData.append("id_padre", document.getElementById('id_padre').value);
		formData.append("comentario", id_comment);
		
		objetoAjax.send(formData);
	}
}



function refreshComments(){
	//console.log("Refrescando comentarios");
	try{
		cargarComentariosEducar(document.getElementById('id_padre').value);
	}
	catch(err){
		//console.log("Refrescando comentarios");
	}
	setTimeout(refreshComments, 30000);
};


refreshComments();





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







