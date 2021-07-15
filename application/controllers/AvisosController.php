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
		$arquivo = is_array($this->input->post('listaImagem'))? $this->input->post('listaImagem') : null;        
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
            //$data['arquivo'] = $arquivo;

			if($this->AvisosDao_model->insertAvisos($data,$arquivo)){
				$this->session->set_flashdata('resultado_ok','Aviso cadastrado com sucesso!');
				redirect(base_url() . 'AvisosController/viewCadastro','refresh');
			}
			else {
				$this->session->set_flashdata('resultado_error','Erro ao cadastrar a Aviso!');
				redirect(base_url() . 'AvisosController/viewCadastro','refresh');
			}

		}

    }



   public function upload(){

  		$this->load->library("upload");
  		 $this->upload->initialize(array(
  				 "upload_path" => './uploadImagens/arquivos/',
  				 'allowed_types' => 'png|jpg|jpeg|png|gif|psd|pdf|xls|txt',
  				 "overwrite" => FALSE,
  				 "max_filename" => 0,
  				 "encrypt_name" => TRUE,
  				 'multi' => 'all'
  		 ));

  		 $successful = $this->upload->do_upload('userfile');
  		 $fileName = array();
  		 $data = array();

  		 if($successful)
  		 {
  			$data[] = $this->upload->data();
  			$resp =  is_array($data);

  			if(count($data[0])>6){
  				foreach ($data as $key => $value) {
  					$fileName[] = $value['file_name'];
  				}
  			}else{
  				foreach ($data as $key => $value) {
  					if(count($value)> 1){
  						foreach ($value as $file) {
  							$fileName[] = $file['file_name'];
  						}
  					}
  				}
  			}



  		 } else {

  			 $msg = $this->upload->display_errors();
  		 }

  		 echo json_encode(['result' => $successful, 'file_name'=>$fileName]);

  	 }

	/*public function alterar(){
		$idAvisos = $this->input->post('idAvisos');
		$data['avisos'] = $this->avisosDao_model->selectAvisosById($idAvisos);
		$this->load->view('paginas/avisos/alterar',$data);
	}*/

	

	/*public function excluir(){
		$idAviso = $this->input->post('idAviso');
		if($this->avisosDao_model->deleteAvisos($idAviso)){
			echo 'sucesso';
		}else{
			echo 'error';
		}
	}*/


	

	

}
