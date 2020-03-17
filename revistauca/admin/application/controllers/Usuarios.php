<?php
session_start();

class Usuarios extends CI_Controller{
	
	public function login(){
		
		//$datosPost = $this->input->post();
		$correo = $this->input->get_post('correo', TRUE);
		$passw = $this->input->get_post('passw', TRUE);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('correo', 'correo', 'required');
		$this->form_validation->set_rules('passw', 'passw', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			// respuesta
			echo "Debe llenar todos los datos";
			return;
		}
		
		$this->load->model('Usuarios_Model', 'UM', true);
		
		$datos['Usuario'] = $this->UM->login($correo, $passw);
		
		if($datos['Usuario'] == NULL){
			echo "Datos incorrectos!";
			return;
		}
		
		$_SESSION['id_usuario'] = $datos['Usuario']->id + 0;
		$_SESSION['nombre_usuario'] = $datos['Usuario']->nombre;
		$_SESSION['tipo_usuario'] = $datos['Usuario']->tipo;
		$_SESSION['imagen_usuario'] = $datos['Usuario']->imagen;
		
		//echo $this->load->view('inicio', $datos);
		//$string = $this->load->view('inicio', '', TRUE);
		//$destino = APPPATH . 'views/'. 'inicio';//VIEWPATH . 'views/'. 'inicio';
		$destino = "/revistauca/admin/inicio";
		echo $destino;
		return;
	}
	
	public function logout(){
		$_SESSION['id_usuario'] = NULL;
		$_SESSION['nombre_usuario'] = NULL;
		$_SESSION['tipo_usuario'] = NULL;
		$_SESSION['imagen_usuario'] = NULL;
		
		session_destroy();
		
		echo "<script>location.href = '/revistauca/admin/';</script>";
		
		return;
	}
}

?>
