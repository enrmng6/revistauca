
function logout(){
	$.ajax({
		type:"POST",
		url:"/revistauca/__controller/usuarios_controller.php?logout",
		data:"nothing",
		success:function(responseText){
			//if(responseText==1){
				location.href = "/revistauca/usuarios/login.php";
			//}
		}
	});
}