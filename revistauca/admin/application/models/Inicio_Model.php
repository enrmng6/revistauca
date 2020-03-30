<?php

class Inicio_Model extends CI_Model{
	
	public function login($correo, $passw){
		
		//$resultadoConsulta = $this->db->get('usuarios');
		$this->db->where('correo', $correo);
		$this->db->where("passw = SHA1('$passw')");
		$this->db->from('usuarios');
		$resultadoConsulta = $this->db->get_where();
		
		foreach ($resultadoConsulta->result() as $fila)
		{
			return $fila;
		}		
	}
}

?>
