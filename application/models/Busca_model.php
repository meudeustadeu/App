<?php

class Busca_model extends CI_Model
{
    public function buscar($busca)
    {
        if(empty($busca)){
            return array();
        }

        $busca = $this->input->post("busca");
        $this->db->like("modelo", $busca);
        return $this->db->get("lista_carros")->result_array();
    }
}
