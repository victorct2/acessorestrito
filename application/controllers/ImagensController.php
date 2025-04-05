<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImagensController extends CI_Controller {

    function __construct() {
		parent:: __construct();

		if(!$this->session->userdata('logged_in')){
			redirect(base_url() . 'Login', 'refresh');
		}
        $grupos = $this->session->userdata('grupos');
        if(in_array("1", $grupos) || in_array("14", $grupos)){
        }else{
            redirect(base_url() . 'Home', 'refresh');
        }
		$this->load->model('imagensDao_model');
	}


    public function viewLista($offset=0){

        $open['assetsBower'] = 'datatables.net-bs/css/dataTables.bootstrap.min.css';
        $open['assetsCSS'] = 'imagens/imagens-list.css';
        $this->load->view('include/openDoc',$open);

		$data['mainNav'] = 'imagens';
        $data['mainNavSub'] = 'imagens';
		$data['subMainNav'] = 'listaImagens';
		$this->load->view('paginas/imagens/lista',$data);

        $footer['assetsJsBower'] = 'moment/min/moment.min.js,datatables.net/js/jquery.dataTables.min.js,datatables.net-bs/js/dataTables.bootstrap.min.js';
        $footer['assetsJs'] = 'imagens/imagens-home.js';
        $this->load->view('include/footer',$footer);
    }

	public function listaImagensDataTables(){

        $fetch_data = $this->imagensDao_model->make_datatables();
        $data = array();
        foreach($fetch_data as $row){

            $situacao = '';
            if($row->ativo == 'S'){
                $situacao = '<span class="label pull-right bg-green">ATIVO</span><br>';
            }else if($row->ativo == 'N'){
                $situacao = '<span class="label pull-right bg-red">INATIVO</span><br>';
            }

            $sub_array = array();
            $sub_array[] = '<img src="'.IMAGEM_IMAGENS.$row->imagem.'" class="img-rounded  imgList" />';
            $sub_array[] = $row->nome;
            $sub_array[] = $row->url;
            $sub_array[] = $situacao;
            $sub_array[] = '<a href="'.base_url('ImagensController/viewAlterar/'.$row->id).'" class="btn btn-app"><i class="fa fa-edit"></i> Alterar</a>
                            <a href="'.base_url('ImagensController/excluirImagens/'.$row->id).'" class="btn btn-app"><i class="fa fa-trash"></i> Excluir</a>';

            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->imagensDao_model->get_all_data(),
            "recordsFiltered" => $this->imagensDao_model->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }


	public function viewCadastro(){

        $open['assetsBower'] = 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css,select2/dist/css/select2.min.css';
        $open['pluginCSS'] = 'bootstrap-fileinput/css/fileinput.min.css';
        $open['assetsCSS'] = 'imagens/imagens-cadastro.css';

        $this->load->view('include/openDoc',$open);

		$data['mainNav'] = 'imagens';
        $data['mainNavSub'] = 'imagens';
		$data['subMainNav'] = 'cadastroImagens';
		$this->load->view('paginas/imagens/cadastro',$data);

        $footer['assetsJsBower'] = 'moment/min/moment.min.js,select2/dist/js/select2.full.min.js,bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';
        $footer['pluginJS'] = 'input-mask/jquery.inputmask.js,bootstrap-fileinput/js/fileinput.min.js,bootstrap-fileinput/js/fileinput_locale_pt-BR.js';
        $footer['assetsJs'] = 'imagens/imagens-cadastro.js';

		$this->load->view('include/footer',$footer);
	}

    public function cadastrarImagens(){

        $nome   = $this->input->post('nome');
		$imagens = is_array($this->input->post('listaImagem'))? $this->input->post('listaImagem') : null;
		$situacao   = $this->input->post('situacao');
		
		$friendly_url = getRawUrl($nome);
		$mensagem = array();

		if(empty($nome)){
			$mensagem[] = 'O <b>NOME</b> para a imagem é Obrigatório.';
		}

		if(empty($imagens)){
			$mensagem[] = 'A <b>IMAGEM</b> é Obrigatória.';
		}

		if(empty($situacao)){
			$mensagem[] = 'A <b>SITUAÇÃO</b> da imagem é Obrigatório.';
		}

		/**
		 * VERIFICANDO NO BANCO SE EXISTE O NOME A SER CADASTRADO
		 */
		$nome_existente = $this->imagensDao_model->nome_disponivel($nome);
		if (count($nome_existente) > 0){
			$mensagem[] = 'Nome <b>'.$nome.'</b> já cadastrado.';
		}

		if (count($mensagem) > 0) {
			$this->session->set_flashdata('mensagem',$mensagem);
			redirect(base_url() . 'imagensController/viewCadastro','refresh');
		}
		else{

			chmod('uploadImagens/arquivos/resized/'.$imagens[0], 0777);
			$novo_nome_imagem = $friendly_url . '.' . @end(explode(".",$imagens[0]));
			rename( 'uploadImagens/arquivos/resized/'.$imagens[0],  'uploadImagens/arquivos/resized/'.$novo_nome_imagem);

			/*
			** Armazenando dados do formulário no Array $data
			*/
			$data['id'] = null;
			$data['nome'] = $nome;
			$data['imagem'] = $novo_nome_imagem;
			$data['url'] = IMAGEM_IMAGENS.$novo_nome_imagem;
			$data['ativo'] = $situacao;
			


			if($this->imagensDao_model->insertImagens($data)){

				if(!empty($novo_nome_imagem)){
					copy('uploadImagens/arquivos/resized/'.$novo_nome_imagem, 'assets/img/imagens/'.$novo_nome_imagem);
					chmod('assets/img/imagens/'.$novo_nome_imagem, 0777);
					unlink('uploadImagens/arquivos/resized/'.$novo_nome_imagem);
					
				}

				$this->session->set_flashdata('resultado_ok','Imagem <b>'.$nome.'</b> foi cadastrado com sucesso!');
				redirect(base_url() . 'ImagensController/viewLista','refresh');
			}
			else {

				$this->session->set_flashdata('resultado_error','Erro ao cadastrar a Imagem!');
				redirect(base_url() . 'ImagensController/viewLista','refresh');
			}

		}
    }

	public function viewAlterar($id){

        $open['assetsBower'] = 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css,select2/dist/css/select2.min.css';
		$open['pluginCSS'] = 'bootstrap-fileinput/css/fileinput.min.css';
		$open['assetsCSS'] = 'imagens/imagens-cadastro.css';

        $this->load->view('include/openDoc',$open);

		$data['imagens'] = $this->imagensDao_model->selectImagensById($id);
		$this->load->view('paginas/imagens/alterar',$data);

        $footer['assetsJsBower'] = 'moment/min/moment.min.js,select2/dist/js/select2.full.min.js,bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';
        $footer['pluginJS'] = 'input-mask/jquery.inputmask.js,bootstrap-fileinput/js/fileinput.min.js,bootstrap-fileinput/js/fileinput_locale_pt-BR.js';
        $footer['assetsJs'] = 'imagens/imagens-cadastro.js';

		$this->load->view('include/footer',$footer);
	}


	public function alterarImagens(){

		$id = $this->input->post('id');
        $nome = $this->input->post('nome');
		$imagens = is_array($this->input->post('listaImagem'))? $this->input->post('listaImagem') : null;
		$situacao = $this->input->post('situacao');
		

		$dadosAtuais = $this->imagensDao_model->selectImagensById($id);

		$friendly_url = getRawUrl($nome);
		$mensagem = array();

		if(empty($nome)){
			$mensagem[] = 'O <b>NOME</b> da imagem é Obrigatório.';
		}

		if(empty($situacao)){
			$mensagem[] = 'A <b>SITUAÇÃO</b> da imagem é Obrigatório.';
		}

		/**
		* VERIFICANDO NO BANCO SE EXISTE O NOME A SER CADASTRADO
		*/
		if($nome != $dadosAtuais[0]->nome){
			$nome_existente = $this->imagensDao_model->nome_disponivel($nome);
			if(count($nome_existente) > 0){
				$mensagem[] = 'Nome <b>'.$nome.'</b> já cadastrado.';
			}
		}

		if (count($mensagem) > 0) {
			$this->session->set_flashdata('mensagem',$mensagem);
			redirect(base_url() . 'ImagensController/viewAlterar/'.$id,'refresh');
		}
		else{

			if(!empty($imagens)){
				chmod('uploadImagens/arquivos/'.$imagens[0], 0777);
				$novo_nome_imagem = $friendly_url . '.' . @end(explode(".",$imagens[0]));
				rename( 'uploadImagens/arquivos/'.$imagens[0],  'uploadImagens/arquivos/'.$novo_nome_imagem);
			}else{
				if($nome !== $dadosAtuais[0]->titulo){
					$novo_nome_imagem = $friendly_url . '.' . end(explode(".",$dadosAtuais[0]->imagem));
				}else{
					$novo_nome_imagem = $dadosAtuais[0]->imagem;
				}
			}

			/*
			** Armazenando dados do formulário no Array $data
			*/
			$data['id'] = $id;
			$data['nome'] = $nome;
			$data['imagem'] = $novo_nome_imagem;
			$data['url'] = IMAGEM_IMAGENS.$novo_nome_imagem;
			$data['ativo'] = $situacao ;
			

			if($this->imagensDao_model->updateImagens($data)){

				if(!empty($imagens)){
					unlink('assets/img/imagens/'.$dadosAtuais[0]->imagem);
					copy('uploadImagens/arquivos/'.$novo_nome_imagem, 'assets/img/imagens/'.$novo_nome_imagem);
					chmod('assets/img/imagens/'.$novo_nome_imagem, 0777);
					unlink('uploadImagens/arquivos/'.$novo_nome_imagem);
				}else{
					rename('assets/img/imagens/'.$dadosAtuais[0]->imagem,'assets/img/imagens/'.$novo_nome_imagem);
				}

				$this->session->set_flashdata('resultado_ok','Imagem <b>'.$nome.'</b> foi cadastrado com sucesso!');
				redirect(base_url() . 'ImagensController/viewLista','refresh');
			}
			else {

				$this->session->set_flashdata('resultado_error','Erro ao cadastrar o Imagem!');
				redirect(base_url() . 'ImagensController/viewLista','refresh');
			}

		}
    }

    function excluirImagens($id){

		$dadosAtuais = $this->imagensDao_model->selectImagensById($id);

        if($this->imagensDao_model->deleteImagens($id)){

			unlink('assets/img/imagens/' . $dadosAtuais[0]->imagem);

            $this->session->set_flashdata('resultado_ok', 'Exclusão de Imagem efetuada com sucesso!');
            redirect(base_url() . 'ImagensController/viewLista', 'refresh');
        }
        else {
            $this->session->set_flashdata('resultado_error', 'Erro ao Excluir a Imagem!');
            redirect(base_url() . 'ImagensController/viewLista','refresh');
        }
	}


}
