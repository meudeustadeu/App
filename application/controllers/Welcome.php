<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("carros_model",'', TRUE);
	}


	public function gravar(){
		$info=$this->input->post();
		$this->carros_model->lista($info);
		
		
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
		$info=$this->input->post();
			if($info){
				print_r($info);
			} else{
				$data['listagem']=$this->carros_model->listar();
			}
		$this->load->view('lista', $data);
		
	}

	public function deletar()
	{
		$post=$this->input->post();

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
}


