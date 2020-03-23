<?php
  session_start();                      //extendemos CI_Controller
class educar_controller extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();

        //llamo al helper url
        $this->load->helper("url");

        //llamo o incluyo el modelo
        $this->load->model("educar_model");
    }

    //controlador por defecto
    public function index(){

        //array asociativo con la llamada al metodo
        //del modelo
        $datos["ver"]=$this->educar_model->ver();
       $datos["ver_usuarios"]=$this->educar_model->ver_usuarios();
        //cargo la vista y le paso los datos
				$this->load->view('templates/header');
        $this->load->view("EducarView/index",$datos);
	      $this->load->view('templates/footer');

    }

		public function create_view(){
			$datos["ver_usuarios"]=$this->educar_model->ver_usuariosAdmin();
			$this->load->view('templates/header');
			$this->load->view("EducarView/create_view",	$datos);
			$this->load->view('templates/footer');
		}
    //controlador para añadir
		public function add(){
			if($this->input->post("submit")){
				$add=$this->educar_model->add(
						  $this->input->post("preview"),
							$this->input->post("archivo"),
							$this->input->post("titulo"),
							$this->input->post("id_autor"),
							$this->input->post("descripcion"),
							$this->input->post("contenido")
							);
						if($add==true){
								//Sesion de una sola ejecución
								console.log('correcto', 'Usuario modificado correctamente');
						}else{
								console.log('incorrecto', 'Usuario modificado correctamente');
						}
						redirect(base_url("educar_controller"));

		}else{
				redirect(base_url("educar_controller"));
		}
	}


    //controlador para modificar al que
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->educar_model->mod($id);
					$this->load->view('templates/header');
          $this->load->view("EducarView/edit_view",$datos);
					$this->load->view('templates/footer');
          if($this->input->post("submit")){
                $mod=$this->educar_model->mod(
                        $id,
											  $this->input->post("submit"),
												$this->input->post("preview"),
												$this->input->post("archivo"),
												$this->input->post("titulo"),
												$this->input->post("descripcion"),
												$this->input->post("contenido")
                        );
                if($mod==true){
                    //Sesion de una sola ejecución
                    console.log('correcto', 'Usuario modificado correctamente');
                }else{
                    console.log('incorrecto', 'Usuario modificado correctamente');
                }
                redirect(base_url("educar_controller"));
            }
        }else{
            redirect(base_url("educar_controller"));
        }
    }

    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->educar_model->eliminar($id);
          if($eliminar==true){
            console.log('correcto', 'Usuario eliminado correctamente');
          }else{
          console.log('incorrecto', 'Usuario eliminado correctamente');
          }
          redirect(base_url("educar_controller"));
        }else{
          redirect(base_url());
        }
    }
}
?>
