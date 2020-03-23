<?php
               //extendemos CI_Model
class usuarios_model extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();

        //cargamos la base de datos
        $this->load->database();
    }

    public function ver(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM usuarios;");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

    public function ver_carreras(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM carreras;");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

    public function add($nombre,$correo,$passw,$id_carrera,$tipo){
            $consulta=$this->db->query("INSERT INTO usuarios VALUES(NULL,'$nombre','$correo','$passw','$id_carrera','$tipo',NULL,NULL);");
            if($consulta==true){
              return true;
            }else{
                return false;
            }
    }

    public function mod($id,$modificar="NULL",$nombre="NULL",$correo="NULL",$passw="NULL",$tipo="NULL",$id_carrera="NULL",$creado="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM usuarios WHERE id=$id");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("
              UPDATE usuarios SET nombre='$nombre', correo='$correo',
              passw='$passw',tipo='$tipo',id_carrera='$id_carrera' WHERE id=$id;
                  ");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }

    public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM usuarios WHERE id=$id");
      if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
  }
