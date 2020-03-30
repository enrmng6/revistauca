<?php
  session_start();                      //extendemos CI_Controller
class Educar extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();

        //llamo al helper url
        $this->load->helper("url");

        //llamo o incluyo el modelo
        $this->load->model("Educar_Model");
    }

    //controlador por defecto
    public function index(){

        //array asociativo con la llamada al metodo
        //del modelo
        $datos["ver"]=$this->Educar_Model->ver();
       $datos["ver_usuarios"]=$this->Educar_Model->ver_usuarios();
        //cargo la vista y le paso los datos
				$this->load->view('templates/header');
        $this->load->view("educar/index",$datos);
	      $this->load->view('templates/footer');

    }

		public function create_view(){
			$datos["ver_usuarios"]=$this->Educar_Model->ver_usuariosAdmin();
			$this->load->view('templates/header');
			$this->load->view("educar/create_view",	$datos);
			$this->load->view('templates/footer');
		}
    //controlador para añadir
		public function add(){
			if($this->input->post("submit")){
				$add=$this->Educar_Model->add(
						  $this->input->post("preview"),
							$this->input->post("archivo"),
							$this->input->post("titulo"),
							$this->input->post("id_autor"),
							$this->input->post("descripcion"),
							$this->input->post("contenido")
							);
						if($add==true){
								//Sesion de una sola ejecución
								console.log('correcto', 'Publicaciòn agregada correctamente');
						}else{
								console.log('incorrecto', 'Publicaciòn no pudo ser agregada');
						}
						redirect(base_url("educar"));

		}else{
				redirect(base_url("educar"));
		}
	}


    //controlador para modificar al que
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->Educar_Model->mod($id);
					$this->load->view('templates/header');
          $this->load->view("educar/edit_view",$datos);
					$this->load->view('templates/footer');
          if($this->input->post("submit")){
                $mod=$this->Educar_Model->mod(
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
                    console.log('correcto', 'Publicaciòn modificada correctamente');
                }else{
                    console.log('incorrecto', 'Publicaciòn no pudo ser modificada');
                }
                redirect(base_url("educar"));
            }
        }else{
            redirect(base_url("educar"));
        }
    }

    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->Educar_Model->eliminar($id);
          if($eliminar==true){
            console.log('correcto', 'Publicaciòn eliminada correctamente');
          }else{
          console.log('incorrecto', 'Publicaciòn no pudo ser eliminada');
          }
          redirect(base_url("educar"));
        }else{
          redirect(base_url());
        }
    }
}
?>
