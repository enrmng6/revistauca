
<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
   
class EntreContadores extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('EntreContadoresModel');
		$this->load->model('EntreContadores_Model','EntreContadoresModel');
		$this->load->helper('url');	// tuve que agregar esto sino, no servìa el base_url
		$this->load->database();	// tuve que agregar esto o si no, no servìa el this.db
	}

	public function index(){
		$this->load->view('entrecontadores/MantenimientoContadores');
	}

	function guardar(){
		if($_POST){
			$this->EntreContadoresModel->guardar($_POST);
		}

		$this->load->view('entrecontadores/MantenimientoContadores');
	}    

	function eliminar(){
	   
		 $this->EntreContadoresModel->eliminar($_GET);
		 $this->load->view('entrecontadores/MantenimientoContadores');
	} 
}

/*?>*/





?>       