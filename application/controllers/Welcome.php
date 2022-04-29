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
		$data["marcas"] = $this->carros_model->listarmarcas();
		$this->load->view('cadastro',$data);
	}


	public function lista()
	{
		$info = $this->input->post();
		
		$data['listagem'] = $this->carros_model->buscar($info);
		$data["marcas"] = $this->carros_model->listarmarcas();
		$this->load->view('lista', $data);

	
	}


	public function deletar()
	{
		$post = $this->input->post();
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
		$param = $this->input->post();
		$data["resultado"] = $this->carros_model->buscar($param);
		$data["contagem"] = count($data["resultado"]);
		$data["filtro"] = $this->input->post();
		$this->load->view('pesquisa', $data);
	}

	public function edit($id)
	{
		$data["edicao"] = $this->carros_model->show($id);
		$data["marcas"] = $this->carros_model->listarmarcas();
		// echo '<pre>'; print_r($data['marcas']); echo '</pre>';
		$update = $_POST;
		
		$this->load->view("editar", $data, $update);
	}

	public function gravar_update()
	{
		$post = $this->input->post();
		
		$arrayEdicao = [
			'marca_id' => $post['marca_id'],
			'cor' => $post['cor'],
			'modelo' => $post['modelo'],
			'ano' => $post['ano']
		];

		$this->carros_model->update($arrayEdicao, $post['id_carro']);

	}
}

