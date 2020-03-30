<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		session_start();
		if(!isset($_SESSION['id_usuario'])){
			echo "<script>location.href = '/revistauca/admin/';</script>";
			return;
		}

		defined('BASEPATH') OR exit('No direct script access allowed');

		$this->load->view('templates/header');
		$this->load->view('inicio');
		$this->load->view('templates/footer');
	}
	
	public function login(){
		
		session_start();
		
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
		
		$this->load->model('Inicio_Model', 'IM', true);
		
		$datos['Usuario'] = $this->IM->login($correo, $passw);
		
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
		
		session_start();
		
		$_SESSION['id_usuario'] = NULL;
		$_SESSION['nombre_usuario'] = NULL;
		$_SESSION['tipo_usuario'] = NULL;
		$_SESSION['imagen_usuario'] = NULL;
		
		session_destroy();
		
		echo "<script>location.href = '/revistauca/admin/';</script>";
		
		return;
	}
}
