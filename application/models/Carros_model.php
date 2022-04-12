<?php

class Carros_model extends CI_Model{

	public function listar()
	{
		//SELECT * FROM lista_carros;
		return $this->db
			->where("deletado", 0)
			->get("lista_carros")->result_array();
	
	}

	public function gravar($info){
		$this->db->insert("lista_carros", $info);
		return $this->db->insert_id();
	}

	public function deletar($dados)
	{
		$this->db->set("deletado", "1");
		$this->db->where("id", $dados['id']);
		return $this->db->update("lista_carros");	
	}

	

	public function show($id)
	{
		return $this->db->get_where("lista_carros", array(
			"id"=>$id
		))->row_array();
	}
	
	public function buscar($busca)
    {
        if(empty($busca)) {
            return array();
        }
        $busca = $this->input->post("busca");
        $this->db->like("marca", $busca);
        return $this->db->get("lista_carros")->result_array();
    }

	public function listmarcas()
	{
		return $this->db->get('marca')->result_array();
	}

}
