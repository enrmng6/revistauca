
function registrarLikes(id_elemento){debugger

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				alert(objetoAjax.responseText);
				if(objetoAjax.responseText == 1){
					console.log("like registrado!");
				}
				else{
					console.log("No se pudo registrar el like ...");
				}
			}

		}
		
		objetoAjax.open("POST", "/revistauca/__controller/likes_controller.php?insert", true);
		
		var formData = new FormData();
		formData.append("id_elemento", id_elemento);
		
		objetoAjax.send(formData);
	}
}