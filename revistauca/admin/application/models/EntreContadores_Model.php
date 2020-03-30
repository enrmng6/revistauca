<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
   
   class EntreContadores_Model extends CI_Model{
        public $variable;
       
        public function __construct(){
            parent::__construct();
        }

        function guardar($post){
            $datosContadores=array();
            $datosContadores['id']=$post['id'];
            $datosContadores['preview']=$post['preview'];
            $datosContadores['archivo']=$post['archivo'];
            $datosContadores['titulo']=$post['titulo'];
            $datosContadores['id_autor']=$post['id_autor'];
            $datosContadores['modificado']=$post['modificado'];
            $datosContadores['creado']=$post['creado'];
            $datosContadores['descripcion']=$post['descripcion'];
            $datosContadores['contenido']=$post['contenido'];
            $datosContadores['megusta']=$post['megusta'];
            $datosContadores['nomegusta']=$post['nomegusta'];
            $datosContadores['compartido']=$post['compartido'];
            
            if($datosContadores['id'] > 0){
                $this->db->where('id',$datosContadores['id']);    
                $this->db->update('entrecontadores',$datosContadores);
                $ruta =base_url('EntreContadoresController');
                echo"<script>
                    alert('Registro Actualizado');
                    window.location ='{$ruta}';
                </script>"; 
            }else{
                $this->db->insert('entrecontadores',$datosContadores);
                $ruta =base_url('EntreContadoresController');
                echo"<script>
                    alert('Registro Guardado');
                    window.location ='{$ruta}';
                </script>";   
            }
                
        
        
        }

        function eliminar($get){
            $this->db->where('id',$get['eliminar']);
            $this->db->delete('entrecontadores');
        }
    }

?>  