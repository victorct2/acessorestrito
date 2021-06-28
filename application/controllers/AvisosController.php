<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AvisosController extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		if(!$this->session->userdata('logged_in')){
			redirect(base_url() . 'Login', 'refresh');
		}

		/*
		 * Carregando DAO model
		*/
        $this->load->model('avisosDao_model');
	}


	public function cadastrar(){
		$this->load->view('paginas/avisos/cadastrar');
	}

	public function cadastrarBanco(){


		$descricao = $this->input->post('descricao');
		$prioridade = $this->input->post('prioridade');

		$mensagem = array();

		if(empty($descricao)){
			$mensagem[] = "Por favor, informe a descrição do Avisos!";
		}

		if(empty($prioridade)){
			$mensagem[] = "Por favor, informe a prioridade do Avisos!";
		}

		$avisosExistente = $this->avisosDao_model->selectAvisosExistente($descricao,$prioridade,'A');
		if (!$avisosExistente){
			$mensagem[] = "Este Avisos já foi cadastrado!";
		}

		if(count($mensagem)>0){
			$this->session->set_flashdata('mensagem',$mensagem);
			redirect(base_url() . 'HomeIntranet','refresh');
		}
		else{
			$data["idAviso"] = null;
			$data["descricao"] = $descricao;
			$data["prioridade"] = $prioridade;

			if(!$this->avisosDao_model->insertAvisos($data)){

				$this->session->set_flashdata('resultado_error','Erro ao cadastrar o Avisos!');
				redirect(base_url() . 'Home','refresh');
			}else{

				$this->session->set_flashdata('resultado_ok','Avisos cadastrado com sucesso!');
				redirect(base_url() . 'Home','refresh');
			}

		}


	}




	public function alterar(){
		$idAvisos = $this->input->post('idAvisos');
		$data['avisos'] = $this->avisosDao_model->selectAvisosById($idAvisos);
		$this->load->view('paginas/avisos/alterar',$data);
	}

	public function alterarBanco(){

		$idAvisos = $this->input->post('idAvisos');
		$nome = $this->input->post('nome');

		$mensagem = array();

		if(empty($nome)){
			$mensagem[] = "Por favor, informe o nome do Avisos!";
		}
		$AvisosExistente = $this->Avisoss_model->selectAvisosByNome($nome);
		if (!$AvisosExistente){
			$mensagem[] = "Este Avisos já foi cadastrado!";
		}

		if(count($mensagem)>0){
			$this->session->set_flashdata('resultado_error',$mensagem[0]);
			redirect(base_url() . 'ControlAvisos/listar','refresh');
		}
		else{
			$data["idAvisos"] = $idAvisos;
			$data["nome"] = $nome;

			if(!$this->avisosDao_model->updateAvisos($data)){
				$this->session->set_flashdata('resultado_error','Erro ao alterar o Avisos!');
				redirect(base_url() . 'ControlAvisos/listar','refresh');
			}else{
				$this->session->set_flashdata('resultado_ok','Avisos alterado com sucesso!');
				redirect(base_url() . 'ControlAvisos/listar','refresh');
			}

		}


	}

	public function excluir(){
		$idAviso = $this->input->post('idAviso');
		if($this->avisosDao_model->deleteAvisos($idAviso)){
			echo 'sucesso';
		}else{
			echo 'error';
		}
	}


}
