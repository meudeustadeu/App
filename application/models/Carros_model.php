<?php

class Carros_model extends CI_Model{

	public function listar()
	{
		//SELECT * FROM veiculos;
		return $this->db
			->where("deletado", 0)
			->get("veiculos")->result_array();
	
	}

	public function gravar($info){
		$this->db->insert("veiculos", $info);
		return $this->db->insert_id();
	}

	public function deletar($dados)
	{
		$this->db->set("deletado", "1");
		$this->db->where("id", $dados['id']);
		return $this->db->update("veiculos");	
	}

	

	public function show($id)
	{
		return $this->db->get_where("veiculos", array(
			"id"=>$id
		))->row_array();
	}
	
	public function buscar($param)
    {	

		if(isset($param['modelo']) && $param['modelo'] != ""){
			$this->db->like("vei.modelo", $param["modelo"]);
		}

		if(isset($param['marca']) && $param['marca'] != ""){
			$this->db->where("vei.marca_id", $param["marca"]);
		}

        return $this->db
					->select(
						"vei.id as veiculo_id, mar.descricao,
						vei.modelo, vei.cor, vei.ano,
						vei.id as veiculo_id
					")
					->from("veiculos vei")
					->join("marcas mar", "vei.marca_id = mar.id", "inner")
					->where("deletado" , 0)
					->get()->result_array();
					
    }

	public function listarmarcas()
	{
		return $this->db->get('marcas')->result_array();
	}



	public function update ($array, $id)
	{
		// $this->db->set("ano", $array['ano']); aqui serve pra quando eu quiser alterar apenas um campo, como o exemplo do deletado
		$this->db->where("id", $id);
		return $this->db->update("veiculos", $array); // aqui eu altero tudo de uma vez, meu array todo
		
	}
}
