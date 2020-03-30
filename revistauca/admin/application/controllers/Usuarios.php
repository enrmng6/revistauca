<?php

//extendemos CI_Controller
class Usuarios extends CI_Controller{
	
	public function __construct() {
		
        //llamamos al constructor de la clase padre
        parent::__construct();

        //llamo al helper url
        $this->load->helper("url");

        //llamo o incluyo el modelo
        $this->load->model("Usuarios_Model");

        //cargo la libreria de sesiones
        //$this->load->library("session");
		
		session_start(); // lo necesita el header.php, la lìnea 18 la colocamos mas abajo cuando se ocupe ...
    }

    //controlador por defecto
    public function index(){
		
        //array asociativo con la llamada al metodo
        //del modelo
        $usuarios["ver"]=$this->Usuarios_Model->ver();
        $usuarios["ver_carreras"]=$this->Usuarios_Model->ver_carreras();
        //cargo la vista y le paso los datos
        $this->load->view('templates/header');
        $this->load->view("usuarios/usuarios_view",$usuarios);
      	$this->load->view('templates/footer');

    }

    //controlador para añadir
    public function add(){

        //compruebo si se a enviado submit
        if($this->input->post("submit")){

        //llamo al metodo add
        $add=$this->Usuarios_Model->add(
                $this->input->post("nombre"),
                $this->input->post("correo"),
                $this->input->post("passw"),
                $this->input->post("id_carrera"),
                $this->input->post("tipo")
                );
        }
		
		$this->load->library("session");
		
        if($add==true){
            //Sesion de una sola ejecución
            $this->session->set_flashdata('correcto', 'Usuario añadido correctamente');
        }else{
            $this->session->set_flashdata('incorrecto', 'Usuario no pudo se añadido');
        }

        //redirecciono la pagina a la url por defecto
        redirect(base_url("usuarios")); // enr: antes decìa "usuarios_controller" pero por convencion, lo cambie
    }

    //controlador para modificar al que
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->Usuarios_Model->mod($id);
          $datos["ver_carreras"]=$this->Usuarios_Model->ver_carreras();
            $this->load->view('templates/header');
            $this->load->view("usuarios/editusuario_view",$datos);
          	$this->load->view('templates/footer');

          if($this->input->post("submit")){
                $mod=$this->Usuarios_Model->mod(
                        $id,
                        $this->input->post("submit"),
                        $this->input->post("nombre"),
                        $this->input->post("correo"),
                        $this->input->post("passw"),
                        $this->input->post("tipo"),
                        $this->input->post("id_carrera")
                        );
                if($mod==true){
                    //Sesion de una sola ejecución
                    console.log('correcto', 'Usuario modificado correctamente');
                }else{
                    console.log('incorrecto', 'Usuario no pudo ser modificado');
                }
                redirect(base_url("usuarios"));
            }
        }else{
            redirect(base_url("usuarios"));
        }
    }

    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->Usuarios_Model->eliminar($id);
		  $this->load->library("session");
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Usuario eliminado correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Usuario no pudo ser eliminado');
          }
          redirect(base_url("usuarios"));
        }else{
          redirect(base_url());
        }
    }
	
}

?>
