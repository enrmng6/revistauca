<?php
session_start();

class Noticias extends CI_Controller{
	
	public function index($id = FALSE)
	{
		if(!isset($_SESSION['id_usuario'])){
			echo "<script>location.href = '/revistauca/admin/';</script>";
			return;
		}

		$this->load->model('Noticias_Model','modeloNoticias');
		$datos['noticias'] = $this->modeloNoticias->select_noticias($id);
		
		if($datos['noticias'] == NULL){
			echo "�Datos incorrectos!";
			return;
		}

		$this->load->view('templates/header');
		$this->load->view('noticias/index', $datos);
		$this->load->view('templates/footer');
	}
	
	public function detail($id = FALSE)
	{
		if(!isset($_SESSION['id_usuario'])){
			echo "<script>location.href = '/revistauca/admin/';</script>";
			return;
		}

		if($id !== FALSE){
			$this->load->model('Noticias_Model','modeloNoticias');
			$datos['machote'] = $this->modeloNoticias->select_noticias($id);
			
			if($datos['machote'] == NULL){
				echo "�Datos incorrectos!";
				return;
			}
			
			$datos['machote'] = $datos['machote'][0];
		}
		else{
			$datos['machote']['titulo'] = "";
			$datos['machote']['id_autor'] = "";
			$datos['machote']['descripcion'] = "";
			$datos['machote']['contenido'] = "";
			$datos['machote']['preview'] = "";
			$datos['machote']['archivo'] = "";
			$datos['machote']['id'] = "";
		}

		$this->load->view('templates/header');
		$this->load->view('noticias/detail', $datos);
		$this->load->view('templates/footer');
	}
	
	public function crear()
	{
		$preview = $this->input->get_post('preview', TRUE);
		$archivo = $this->input->get_post('archivo', TRUE);
		$titulo = $this->input->get_post('titulo', TRUE);
		$id_autor = $this->input->get_post('id_autor', TRUE);
		$descripcion = $this->input->get_post('descripcion', TRUE);
		$contenido = $this->input->get_post('contenido', TRUE);
			
		//$ret=$this->input->get_post('id_usuario',TRUE).','.$this->input->get_post('nombre_usuario',TRUE).','.$this->input->get_post('correo_usuario',TRUE).','.$this->input->get_post('telefono',TRUE).','.$this->input->get_post('contrasena',TRUE);
		$this->load->model('Noticias_Model','modeloNoticias');
		$nuevo_id = $this->modeloNoticias->insert_Noticias($preview, $archivo, $titulo, $id_autor, $descripcion, $contenido);
		
		echo $nuevo_id;
		return;
	}
	
	public function modificar()
	{
		$id = $this->input->get_post('id',TRUE);
		$preview = $this->input->get_post('preview', TRUE);
		$archivo = $this->input->get_post('archivo', TRUE);
		$titulo = $this->input->get_post('titulo', TRUE);
		$id_autor = $this->input->get_post('id_autor', TRUE);
		$descripcion = $this->input->get_post('descripcion', TRUE);
		$contenido = $this->input->get_post('contenido', TRUE);
			
		//$ret=$this->input->get_post('id_usuario',TRUE).','.$this->input->get_post('nombre_usuario',TRUE).','.$this->input->get_post('correo_usuario',TRUE).','.$this->input->get_post('telefono',TRUE).','.$this->input->get_post('contrasena',TRUE);
		$this->load->model('Noticias_Model','modeloNoticias');
		
		$resultadoUpdate = $this->modeloNoticias->update_Noticias($id, $preview, $archivo, $titulo, $id_autor, $descripcion, $contenido);
		
		echo $resultadoUpdate;
		return;
	}
	
	public function eliminar()
	{
		$id = $this->input->get_post('id',TRUE);
		
		$this->load->model('Noticias_Model','modeloNoticias');
		
		$resultadoDelete = $this->modeloNoticias->delete_Noticias($id);
		
		echo $resultadoDelete;
		return;
	}
}

?>
