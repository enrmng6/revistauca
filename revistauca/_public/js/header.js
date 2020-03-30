
function showLeftMenu(){
	var leftPopout = document.getElementById("left_popout");
	var width = leftPopout.style.width;
	
	width = width.split("%")[0] + 0;
	
	if(width == 0){
		var ancho = 0;
		var mostrando = setInterval(function (){
			document.getElementById("left_popout").style.width = ''+ancho+'%'; // establece el nuevo width
			ancho += 5;
			if(ancho >= 85){
				clearInterval(mostrando);
				document.getElementById("left_popout").style.width = ''+85+'%';
				document.getElementById("left_popout_cover").style.display = 'block';
				
				document.getElementById("left_popout_scroll_cover").style.display = 'block';
				document.body.style.overflow = 'hidden';
				
				ancho = 90;	// esto solamente para que la rotacion se haga completa (lo del 90 es pura casualidad)
				
			}
			
			//$("#menu").addClass("rotated");
			var rotating = document.getElementById("menu")
			rotating.style.webkitTransform = 'rotate('+ancho+'deg)'; 
			rotating.style.mozTransform    = 'rotate('+ancho+'deg)'; 
			rotating.style.msTransform     = 'rotate('+ancho+'deg)'; 
			rotating.style.oTransform      = 'rotate('+ancho+'deg)'; 
			rotating.style.transform       = 'rotate('+ancho+'deg)'; 
			
		}, 1);
	}
	else{
		var ancho = 85;
		var ocultando = setInterval(function (){
			document.getElementById("left_popout").style.width = ''+ancho+'%'; // establece el nuevo width
			ancho -= 5;
			if(ancho <= 0){
				clearInterval(ocultando);
				document.getElementById("left_popout").style.width = ''+0+'%';
			}
			
			var rotating = document.getElementById("menu")
			rotating.style.webkitTransform = 'rotate('+ancho+'deg)'; 
			rotating.style.mozTransform    = 'rotate('+ancho+'deg)'; 
			rotating.style.msTransform     = 'rotate('+ancho+'deg)'; 
			rotating.style.oTransform      = 'rotate('+ancho+'deg)'; 
			rotating.style.transform       = 'rotate('+ancho+'deg)'; 
			
			document.getElementById("left_popout_cover").style.display = 'none';
			
			document.getElementById("left_popout_scroll_cover").style.display = 'none';
			document.body.style.overflow = 'auto';
			
		}, 1);
	}
}



function registrarVisita(idElemento, entidad){

	if(window.XMLHttpRequest){
		
		var objetoAjax = new XMLHttpRequest();

		objetoAjax.onreadystatechange = function () {

			if(objetoAjax.readyState == 4 && objetoAjax.status == 200){
				//console.log(objetoAjax.responseText);
				var respuesta = JSON.parse(objetoAjax.responseText);
				
				if(respuesta.numeroVisitas == 1){
					document.getElementById("numeroVisitas").innerText = "1 visita";
				}
				else if(respuesta.numeroVisitas > 1){
					document.getElementById("numeroVisitas").innerText = respuesta.numeroVisitas + " visitas";
				}
			}

		}
		
		objetoAjax.open("POST", "/revistauca/__controller/visitas_controller.php?insert", true);
		
		var formData = new FormData();
		formData.append("id_elemento", idElemento);
		formData.append("entidad", entidad);
		
		objetoAjax.send(formData);
	}
}
