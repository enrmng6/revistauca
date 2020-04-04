$( document ).ready(function() {
setTimeout(function(){  Swal
  .fire({
      title: "Busqueda de Revistas",
      input: "text",
      showCancelButton: true,
      confirmButtonText: "Buscar",
      confirmButtonColor: "#e9b73f",
      cancelButtonText: "Cancelar",
       cancelButtonColor:"#e9b73f",
      inputValidator: nombre => {
          // Si el valor es válido, debes regresar undefined. Si no, una cadena
          if (!nombre) {
              return "¡Por favor escriba una clave de busqueda!";
          } else {
              return undefined;
          }
      }
  })
  .then(resultado => {
      if (resultado.value) {
          let name = resultado.value;
            $.ajax({
                           data: 'name='+name, //datos que se envian a traves de ajax
                           url:  '/revistauca/__controller/busqueda_controller.php?select', //archivo que recibe la peticion
                           type:  'post', //método de envio
                           beforeSend: function () {

let timerInterval
Swal.fire({
  title: 'Procesando!',
  html: 'Buscando <b></b> Resultados .',
  timer: 2000,
  timerProgressBar: true,
  onBeforeOpen: () => {
    Swal.showLoading()
    timerInterval = setInterval(() => {
      const content = Swal.getContent()
      if (content) {
        const b = content.querySelector('b')
        if (b) {
          b.textContent = Swal.getTimerLeft()
        }
      }
    }, 100)
  },
  onClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('Solicitud al Servidor')
  }
})

                           },
                           success:  function (response) {
                             var ucaprofesionallist_div = document.getElementById("ucaprofesional_list");
                             ucaprofesionallist_div.innerHTML = "";//una vez que el archivo recibe el request lo procesa y lo devuelve
                           $(ucaprofesionallist_div).append(response);
                           }
                   });
        	}

  }); }, 1000);

});
function showUcaProfesional(ucaProfesionalId){
	location.href = "/revistauca/revistas/ucaprofesional/detail.php?ucaprofesionalid=" + ucaProfesionalId;
}

function showEducar(educarId){
	location.href = "/revistauca/revistas/educar/detail.php?educarid=" + educarId;
}

function showEntreContadores(entreContadoresId){
	location.href = "/revistauca/revistas/entrecontadores/detail.php?entrecontadoresid=" + entreContadoresId;
}

function showBoletines(boletinesId){
	location.href = "/revistauca/boletines/detail.php?boletinesid=" + boletinesId;
}
function showNoticia(noticiaId){
	location.href = "/revistauca/noticias/detail.php?noticiaid=" + noticiaId;
}
