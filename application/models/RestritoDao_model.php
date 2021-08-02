<?php 

Class RestritoDao_model extends CI_Model {

	public function __construct() {
		parent:: __construct();
	}

	 function listarGrupos(){
		$this->db->order_by('nome','asc');		
		$this->db->where('id','49');
        return $this->db->get('grupos')->result();
	}

    function listarCooperado($limit = null,$offset = null){
		
$this->db->select('usuarios.id,usuarios.nome');
$this->db->from('usuarios');
$this->db->join('usuarios_grupos','usuarios.id = usuarios_grupos.idUsuario');
$this->db->where('usuarios_grupos.idGrupo','49');
$this->db->where('usuarios.ativo','S');
return $this->db->get()->result();
	}

	function listarSituacao(){
		$this->db->order_by('descricao');
		return $this->db->get('tipo_arquivo')->result();
	}

	function selectUsuarioById($id){
		$this->db->where('id', $id);
		return $this->db->get('usuarios')->result();	
    }

    function selectArquivoById($id){
		$this->db->where('id', $id);
		return $this->db->get('usuarios')->result();	
    }
	/*
	** Adicionar Figurino
    */

    function insertArquivo($data){	
		return $this->db->insert('arquivo_upload',$data);	
	}

	function insertRestrito($data2){	
		return $this->db->insert('cooperado_arquivo',$data2);	
	}

	function insertTipoArquivo($data){	
		return $this->db->insert('tipo_arquivo',$data);	
	}

	
	function completar_cadastro($nome_arquivo,$arquivo,$id){	
		$this->db->where('id',$id);	
		$this->db->set('nome_arquivo', $nome_arquivo);
		$this->db->set('arquivo', $arquivo);
		return $query = $this->db->update('arquivo_upload');		
	}

	 function listarUsuarios($limit = null,$offset = null){
		$this->db->order_by('idUsuario','desc');
		$this->db->where('idGrupo','49');
		$this->db->limit($limit,$offset);
		return $this->db->get('usuarios_grupos')->result();
	}

	function totalUsuarios($ativos = false, $inativos= false){
		if($ativos == true){
			$this->db->where('ativo','S');
		}
		if($inativos == true){
			$this->db->where('ativo','N');
		}
		return $this->db->get('usuarios')->num_rows();
	}

	function make_query(){

		$gruposArray = $this->session->userdata('grupos');
		if(in_array("50",$gruposArray))
		{
		$order_column = array("id","usuarios.nome","login", "email");
		$this->db->group_by('usuarios.id');
		$this->db->select('usuarios.id,usuarios.nome,login, email');
		$this->db->from('usuarios');
		$this->db->join('usuarios_grupos','usuarios_grupos.idUsuario = usuarios.id');
		$this->db->join('grupos','usuarios_grupos.idGrupo = grupos.id');
        $this->db->where('usuarios_grupos.idGrupo','49');
        }else{
        $order_column = array("id","usuarios.nome","login", "email");
		$this->db->group_by('usuarios.id');
		$this->db->select('usuarios.id,usuarios.nome,login, email');
		$this->db->from('usuarios');
		$this->db->join('usuarios_grupos','usuarios_grupos.idUsuario = usuarios.id');
		$this->db->join('grupos','usuarios_grupos.idGrupo = grupos.id');
        $this->db->where('usuarios_grupos.idGrupo','49');
        $this->db->where('usuarios.id',$this->session->userdata("idUsuario"));
    }


        

		if(!empty($_POST['columns'][1]["search"]["value"])){
			$this->db->where("usuarios.id", $_POST['columns'][1]["search"]["value"]);  
		}
		if(!empty($_POST['columns'][2]["search"]["value"])){
			$this->db->like("usuarios.nome", $_POST['columns'][2]["search"]["value"]);
		}
		if(!empty($_POST['columns'][3]["search"]["value"])){
			$this->db->like("login", $_POST['columns'][3]["search"]["value"]);  	
		}
		
		if(!empty($_POST['columns'][4]["search"]["value"])){
			$this->db->like("email", $_POST['columns'][4]["search"]["value"]);
		}
		
		if(isset($_POST["order"])){
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else{
			$this->db->order_by('id', 'DESC');
		}
	}


   

	function make_datatables(){  
		$this->make_query();  
		if($_POST["length"] != -1){  
			$this->db->limit($_POST['length'], $_POST['start']); 
			 
		}  
		$query = $this->db->get();  
		return $query->result();  
    } 

    function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
    }

    function get_all_data(){  
		$this->db->select("*");  
		$this->db->from('usuarios');  
		return $this->db->count_all_results();  
    }
     


    function selectArquivoUsuario($id=0){



		$order_column = array("tipo_arquivo.descricao as descr","arquivo_upload.nome_arquivo","arquivo_upload.arquivo","arquivo_upload.Data_cadastro");

			
		$this->db->select('nome, login, id_user,id_arquivo,nome_arquivo, arquivo, arquivo_upload.Descricao, Data_cadastro, tipo_arquivo.descricao as descr, tipo_arquivo.id as  id');
		$this->db->from('cooperado_arquivo');
		$this->db->order_by('Data_cadastro','desc');
		$this->db->join('usuarios','cooperado_arquivo.id_user = usuarios.id');
		$this->db->join('arquivo_upload','cooperado_arquivo.id_arquivo = arquivo_upload.id');
		$this->db->join('tipo_arquivo','arquivo_upload.tipo_arquivo = tipo_arquivo.id');
		
		
		$gruposArray = $this->session->userdata('grupos');
		
		if(!in_array("50",$gruposArray)){
			$id_user = $this->session->userdata('idUsuario');
			$this->db->where('usuarios.id',$id_user);
		}else{

			$this->db->where('cooperado_arquivo.id_user',$id);
		}

		if(!empty($_POST['columns'][1]["search"]["value"])){
			$this->db->like("tipo_arquivo.descricao", $_POST['columns'][1]["search"]["value"]);  
		}
		if(!empty($_POST['columns'][2]["search"]["value"])){
			$this->db->like("nome_arquivo", $_POST['columns'][2]["search"]["value"]);
		}
		if(!empty($_POST['columns'][3]["search"]["value"])){
			$this->db->like("arquivo", $_POST['columns'][3]["search"]["value"]);  	
		}
		
		if(!empty($_POST['columns'][4]["search"]["value"])){
			$this->db->like("Data_cadastro", $_POST['columns'][4]["search"]["value"]);
		}
		
		if(isset($_POST["order"])){
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}

		else{
			$this->db->order_by('Data_cadastro', 'DESC');
		}
				
			
		}

    function make_datatables2($id){  
		$this->selectArquivoUsuario($id);  
		if($_POST["length"] != -1){  
			$this->db->limit($_POST['length'], $_POST['start']); 
			

		}  
		$query = $this->db->get();  
		return $query->result();  
    } 

    
    function get_filtered_data2($id){  
		$this->selectArquivoUsuario($id);  
		$query = $this->db->get();  
		return $query->num_rows();  
    }

	

    function get_all_files($id){  
		$this->selectArquivoUsuario($id);  
		$query = $this->db->get();  
		return $this->db->count_all_results();  
    }

	

	

		
	
	
	

}

?>