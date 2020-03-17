<?php

class Machotes_Model extends CI_Model{
	
	/*
	| id          | int(11)      | NO   | PRI | NULL                | auto_increment              |
	| preview     | varchar(250) | YES  |     | NULL                |                             |
	| archivo     | varchar(250) | YES  |     | NULL                |                             |
	| titulo      | varchar(100) | YES  |     | NULL                |                             |
	| id_autor    | int(11)      | YES  |     | NULL                |                             |
	| modificado  | timestamp    | NO   |     | CURRENT_TIMESTAMP   | on update CURRENT_TIMESTAMP |
	| creado      | timestamp    | NO   |     | 0000-00-00 00:00:00 |                             |
	| descripcion | varchar(250) | YES  |     | NULL                |                             |
	| contenido   | text         | YES  |     | NULL                |                             |
	| megusta     | int(11)      | YES  |     | 0                   |                             |
	| nomegusta   | int(11)      | YES  |     | 0                   |                             |
	| compartido  | int(11)      | YES  |     | 0                   |                             |
	*/
	public function __construct()
	{
		$this->load->database();
	}
	
	public function select_machote($id = FALSE)
	{
		//$query = $this->db->get('ht_usuarios');
		//return $query->result_array();
		if ($id === FALSE)
		{
			$this->db->from('machotes');
			$query = $this->db->get();
			return $query->result_array();
		}

		$query = $this->db->get_where('machotes', array('id' => $id));
		return $query->result_array();//return $query->row_array();
	}

	public function insert_machote($preview, $archivo, $titulo, $id_autor, $descripcion, $contenido)
	{
		//$this->load->helper('url');
		//$id = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'preview' => $preview,
			'archivo' => $archivo,
			'titulo' => $titulo,
			'id_autor' => $id_autor,
			'descripcion' => $descripcion,
			'contenido' => $contenido			
		);

		$resultadoInsert = $this->db->insert('machotes', $data); // 1 si fue exitoso
		return $this->db->insert_id(); // devuelve el id del nuevo elemento insertado
	}

	public function update_machote($id, $preview, $archivo, $titulo, $id_autor, $descripcion, $contenido)
	{
		$data = array(
			'preview' => $preview,
			'archivo' => $archivo,
			'titulo' => $titulo,
			'id_autor' => $id_autor,
			'descripcion' => $descripcion,
			'contenido' => $contenido	
		);

		$this->db->where('id', $id);
		return $this->db->update('machotes', $data); 
	}
	
	public function delete_machote($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('machotes'); 
	}
	
}

?>
