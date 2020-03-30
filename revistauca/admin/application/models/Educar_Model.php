<?php
               //extendemos CI_Model
class Educar_Model extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();

        //cargamos la base de datos
        $this->load->database();
    }

    public function ver(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM educar;");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

    public function ver_usuarios(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM usuarios;");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

		public function ver_usuariosAdmin(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM usuarios WHERE tipo='administrador';");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

		public function add($preview, $archivo, $titulo, $id_autor, $descripcion, $contenido)
		{

			$consulta=$this->db->query("INSERT INTO educar VALUES(Null,'$preview','$archivo','$titulo','$id_autor',Null,Null,'$descripcion','$contenido','0','0','0');");

			if($consulta==true){
				return true;
			}

			else
			{
					return false;
			}

		}

    public function mod($id,$modificar="NULL",$preview="NULL",$archivo="NULL",$titulo="NULL",$descripcion="NULL",$contenido="NULL",$modificado="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM educar WHERE id=$id");
            return $consulta->result();
        }else{
					$modificado="NULL";
          $consulta=$this->db->query("
              UPDATE educar SET preview='$preview', archivo='$archivo',
              titulo='$titulo',modificado='$modificado',descripcion='$descripcion' WHERE id=$id;
                  ");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }

    public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM educar WHERE id=$id");
      if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
  }
