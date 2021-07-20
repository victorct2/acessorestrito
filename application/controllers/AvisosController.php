<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AvisosController extends CI_Controller {

	 function __construct() {
		parent:: __construct();

		 if(!$this->session->userdata('logged_in')){
            redirect(base_url() . 'Login', 'refresh');
        }
        $grupos = $this->session->userdata('grupos');
        if(in_array("1", $grupos) || in_array("49", $grupos)){             
        }else{
            redirect(base_url() . 'Home', 'refresh');
        }
        

        $this->load->model('AvisosDao_model');

	}


	public function viewCadastro(){

		$open['assetsBower'] = 'select2/dist/css/select2.min.css';
		$open['pluginCSS'] = 'jqueryUi/jquery-ui.min.css,bootstrap-fileinput/css/fileinput.min.css';
    	$open['assetsCSS'] = 'noticias/noticias-cadastro.css';
        $this->load->view('include/openDoc',$open);

		$data['mainNav'] = 'avisos';
		$data['subMainNav'] = 'cadastroAvisos';
		$this->load->view('paginas/avisos/cadastro',$data);

        $footer['assetsJsBower'] = 'moment/min/moment.min.js,select2/dist/js/select2.full.min.js,ckeditor/ckeditor.js';
		$footer['pluginJS'] = 'input-mask/jquery.inputmask.js,jqueryUi/jquery-ui.min.js,bootstrap-fileinput/js/fileinput.min.js,bootstrap-fileinput/js/fileinput_locale_pt-BR.js';
        $footer['assetsJs'] = 'noticias/noticias-cadastro.js';
		$this->load->view('include/footer',$footer);
	}

	public function cadastrarAvisos(){
        
        $descricao   = $this->input->post('descricao');
		$sinopse = $this->input->post('sinopse');		
		$dia = $this->input->post('dia');
        $situacao = $this->input->post('ativa');
        $descricao_completa = $this->input->post('descricao_completa');		
		$friendly_url = getRawUrl($dia.$arquivo[0]);
        $mensagem = array();

        if(empty($descricao)){
            $mensagem[] = 'A <b>DESCRIÇÃO</b> do arquivo é Obrigatória.';
        }

		if(empty($sinopse)){
			$mensagem[] = 'A <b>SINOPSE</b> de exibição da notícia é Obrigatória.';
		}

		if(empty($descricao_completa)){
			$mensagem[] = 'A <b>DESCRIÇÃO COMPLETA</b> da notícia é Obrigatória.';
		}

		if(empty($dia)){
			$mensagem[] = 'A <b>DATA</b> da notícia é Obrigatório.';
		}

		if(empty($situacao)){
			$mensagem[] = 'A <b>SITUAÇÃO</b> da notícia é Obrigatória.';
		}

		if (count($mensagem) > 0) {     
            $this->session->set_flashdata('mensagem',$mensagem);
			redirect(base_url() . 'AvisosController/viewCadastro','refresh');
		}
		
		else{


			$data['id'] = null;
			$data['descricao'] = $descricao;
			$data['sinopse'] = $sinopse;			
			$data['descricao_completa'] = $descricao_completa;			
			$data['dia'] = converteDataBanco($dia) ;			
			$data['friendly_url'] = getRawUrl($descricao.$dia);
			$data['ativa'] = $situacao;			
           

			if($this->AvisosDao_model->insertAvisos($data)){
				$this->session->set_flashdata('resultado_ok','Aviso cadastrado com sucesso!');
				redirect(base_url() . 'AvisosController/viewCadastro','refresh');
			}
			else {
				$this->session->set_flashdata('resultado_error','Erro ao cadastrar a Aviso!');
				redirect(base_url() . 'AvisosController/viewCadastro','refresh');
			}

		}

    }


     public function viewLista($offset=0){

		$open['assetsBower'] = 'bootstrap-daterangepicker/daterangepicker.css,datatables.net-bs/css/dataTables.bootstrap.min.css,select2/dist/css/select2.min.css';
		$open['assetsCSS'] = 'noticias/noticias-list.css';
		$open['pluginCSS'] = 'iCheck/all.css,jqueryUi/jquery-ui.min.css';
        $this->load->view('include/openDoc',$open);

		$data['mainNav'] = 'avisos';
		$data['subMainNav'] = 'listaAvisos';
		$this->load->view('paginas/avisos/lista',$data);

		$footer['assetsJsBower'] = 'moment/min/moment.min.js,bootstrap-daterangepicker/daterangepicker.js,datatables.net/js/jquery.dataTables.min.js,datatables.net-bs/js/dataTables.bootstrap.min.js,select2/dist/js/select2.full.min.js';
        $footer['assetsJs'] = 'noticias/noticias-home.js';
        $this->load->view('include/footer',$footer);
    }

    public function listaAvisoDataTables(){

        $fetch_data = $this->AvisosDao_model->make_datatables();
        $data = array();
        foreach($fetch_data as $row){

            $situacao = '';
            if($row->ativa == 'S'){
                $situacao = '<span class="label pull-right bg-green">ATIVO</span><br>';
            }else if($row->ativa == 'N'){
                $situacao = '<span class="label pull-right bg-red">INATIVO</span><br>';
			}

			

			$sub_array = array();
			
            $sub_array[] = converteDataInterface($row->dia);
            $sub_array[] = $row->descricao;
            $sub_array[] = $row->sinopse;
            $sub_array[] = $situacao;
            $sub_array[] = '<a href="'.base_url('NoticiasController/viewAlterar/'.$row->id).'" class="btn btn-app"><i class="fa fa-edit"></i> Alterar</a>
                            <a href="'.base_url('NoticiasController/apagarNoticias/'.$row->id).'" class="btn btn-app"><i class="fa fa-trash"></i> Excluir</a>';
           

            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->AvisosDao_model->get_all_data(),
            "recordsFiltered" => $this->AvisosDao_model->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }


	

	

}
