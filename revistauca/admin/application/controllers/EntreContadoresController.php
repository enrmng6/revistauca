
<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
   
   class EntreContadoresController extends CI_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model('EntreContadoresModel');
            
        }

        public function index(){
            $this->load->view('MantenimientoContadores');
        }

        function guardar(){
            if($_POST){
                $this->EntreContadoresModel->guardar($_POST);
            }

            $this->load->view('MantenimientoContadores');
        }    

    
        function eliminar(){
           
             $this->EntreContadoresModel->eliminar($_GET);
             $this->load->view('MantenimientoContadores');
        } 
    
    }





?>       