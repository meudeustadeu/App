<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("carros_model", '', TRUE);
	}


	public function gravar()
	{
		$info = $this->input->post();
	
		$id=$this->carros_model->gravar($info);
		return $id;
	}



	public function index()
	{

		$this->load->view('dashboard');
	}


	public function cadastro()
	{
		$this->load->view('cadastro');
	}


	public function lista()
	{
		$info = $this->input->post();
		if ($info) {
			print_r($info);
		} else {
			$data['listagem'] = $this->carros_model->listar();
		}
		$this->load->view('lista', $data);
		$this->load->model("busca_model", '', TRUE);
	}


	public function deletar()
	{
		$post = $this->input->post();
		$this->load->model("busca_model", '', TRUE);
		$retorno = $this->carros_model->deletar($post);

		// passos: enviar para a model para fazer a exclusão
		// em seguida, caso sucesso, vc vai enviar um parametro de sucesso ou erro
		if ($retorno == true) {
			$dados['error'] = 0;
			$dados['msg'] = "Carro deletado com sucesso";
		} else {
			$dados['error'] = 1;
			$dados['msg_error'] = "Erro ao deletar o carro escolhido";
		}
		echo json_encode($dados);
	}

	public function pesquisar()
	{
		$this->load->model("carros_model", '', TRUE);
		$this->load->model("busca_model");
		$this->load->view('pesquisa');
		$busca["listagem"] = $this->busca_model->buscar($_POST);
	
	}

		
}

