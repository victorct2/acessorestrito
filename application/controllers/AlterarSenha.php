<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlterarSenha extends CI_Controller {

    function __construct() {
		parent:: __construct();

		

		$this->load->model('usuariosDao_model');
		$this->load->model('gruposDao_model');
		$this->load->model('programasDao_model');
		$this->load->model('LoginDao_model');

	}

     

    public function alterarSenha2(){
     
     	 
       	$senha       = ($this->input->post('senha'));
		$id          = ($this->input->post('id'));
		
        $dadosAtuais = $this->usuariosDao_model->selectUsuarioById($id);
		$mensagem = array();

		
		if (empty($senha)){ 			
           $mensagem[] = 'A alteração de Senha é Obrigatória'; 
		}else{
			 $this->load->library('form_validation');
			 $this->form_validation->set_rules('senha','Senha', 'required|min_length[8]|callback_is_password_strong');
             
			$senha = md5($senha);
			if ($this->form_validation->run() ==FALSE){
				$this->session->set_flashdata('resultado_error','A senha deve conter pelo menos 8 carácteres entre números e letras');			
				redirect(base_url() . 'AlterarSenha/alterarSenha/','refresh'); 
				}else{
			 


            
            $data['senha']      = $senha;
			$data['id'] = $id;
			$data['password_alterado'] = 'S';

            if($this->LoginDao_model->updateUsuario($data)){				
				$this->session->set_flashdata('resultado_ok','Senha alterada com sucesso!');			
				redirect(base_url().'Home','refresh');
			}
			
        

    }
		}
	}

  	
public function alterarSenha(){	
        

		 
        $open['assetsBower'] = 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css,select2/dist/css/select2.min.css';
        
        $this->load->view('include/openDoc',$open);

        $id = $this->session->userdata("idUsuario");
        $data['usuario'] = $this->usuariosDao_model->selectUsuarioById($id);
        $this->load->view('paginas/usuarios/alterar-senha',$data);
       

        $footer['assetsJsBower'] = 'moment/min/moment.min.js,select2/dist/js/select2.full.min.js,bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';
        $footer['pluginJS'] = 'input-mask/jquery.inputmask.js';
        $footer['assetsJs'] = 'usuarios/usuarios-cadastro.js';

		$this->load->view('include/footer',$footer);
	}
public function is_password_strong($senha)
{
   if (preg_match('#[0-9]#', $senha) && preg_match('#[a-zA-Z]#', $senha)) {
     return TRUE;
   }
   return FALSE;
}
	

}