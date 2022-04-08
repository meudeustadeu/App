<?php

class Carros_model extends CI_Model{

	public function listar()
	{
		//SELECT * FROM lista_carros;
		return $this->db->get("lista_carros")->result_array();
		$this->db->where("deletado","1");
	}

	public function gravar($info){
		$this->db->insert("lista_carros", $info);
	}

	public function deletar($dados)
	{
		$this->db->set("deletado", "1");
		$this->db->where("id", $dados['id']);
		return $this->db->update("lista_carros");	

	}
}
