<?php
                        //extendemos CI_Controller
class usuarios_controller extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();

        //llamo al helper url
        $this->load->helper("url");

        //llamo o incluyo el modelo
        $this->load->model("usuarios_model");

        //cargo la libreria de sesiones
        $this->load->library("session");
    }

    //controlador por defecto
    public function index(){

        //array asociativo con la llamada al metodo
        //del modelo
        $usuarios["ver"]=$this->usuarios_model->ver();
        $usuarios["ver_carreras"]=$this->usuarios_model->ver_carreras();
        //cargo la vista y le paso los datos
        $this->load->view('templates/header');
        $this->load->view("UsuariosView/usuarios_view",$usuarios);
      	$this->load->view('templates/footer');

    }

    //controlador para añadir
    public function add(){

        //compruebo si se a enviado submit
        if($this->input->post("submit")){

        //llamo al metodo add
        $add=$this->usuarios_model->add(
                $this->input->post("nombre"),
                $this->input->post("correo"),
                $this->input->post("passw"),
                $this->input->post("id_carrera"),
                $this->input->post("tipo")
                );
        }
        if($add==true){
            //Sesion de una sola ejecución
            $this->session->set_flashdata('correcto', 'Usuario añadido correctamente');
        }else{
            $this->session->set_flashdata('incorrecto', 'Usuario añadido correctamente');
        }

        //redirecciono la pagina a la url por defecto
        redirect(base_url("usuarios_controller"));
    }

    //controlador para modificar al que
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->usuarios_model->mod($id);
          $datos["ver_carreras"]=$this->usuarios_model->ver_carreras();
            $this->load->view('templates/header');
            $this->load->view("UsuariosView/editusuario_view",$datos);
          	$this->load->view('templates/footer');

          if($this->input->post("submit")){
                $mod=$this->usuarios_model->mod(
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
                    console.log('incorrecto', 'Usuario modificado correctamente');
                }
                redirect(base_url("usuarios_controller"));
            }
        }else{
            redirect(base_url("usuarios_controller"));
        }
    }

    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->usuarios_model->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Usuario eliminado correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Usuario eliminado correctamente');
          }
          redirect(base_url("usuarios_controller"));
        }else{
          redirect(base_url());
        }
    }
}
?>
