<?php

Class AvisosDao_model extends CI_Model {

	public function __construct() {
		parent:: __construct();
	}
	
		
	function insertAvisos($data){
		return $this->db->insert('tbl_avisos',$data);
	}
	
	
	function selectAvisos($limite, $offset){
		$this->db->order_by('prioridade', 'asc');
		$this->db->order_by('dataAviso', 'asc');	
		$this->db->order_by('idAviso', 'asc');	
		$this->db->limit($limite, $offset);	
		return $this->db->get('tbl_avisos')->result();
	}
	
	function updateAvisos($data){
		$this->db->where('idAviso',$data['idAviso']);
		return $this->db->update('tbl_avisos',$data);
	}
	
	function selectAvisosExistente($descricao,$prioridade,$situacao){
		$this->db->where('descricao',$descricao);
		$this->db->where('prioridade',$prioridade);
		$this->db->where('situacao',$situacao);
		$query =  $this->db->get('tbl_avisos')->result();
		if(count($query) > 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function deleteAvisos($idAviso){
		$this->db->where('idAviso',$idAviso);
		return $this->db->delete('tbl_avisos');
	}



	 function selectAvisoByFriendly_url($friendly_url){
        $this->db->where('friendly_url',$friendly_url);
        $this->db->select('descricao,descricao_completa,link,friendly_url,dia,releaseAviso,ativa,id,arquivo,alinfile,sinopse');	
        $this->db->from('avisos');
        //$this->db->join('tb_imagem_noticia','tb_imagem_noticia.noticia_id = novidades.id','LEFT');
        return $this->db->get()->result();
    }

     function countAllAvisos($dadosBusca){
        if($dadosBusca !=''){
            $this->db->like('descricao',$dadosBusca);
            $this->db->or_like('sinopse',$dadosBusca);
            $this->db->or_like('descricao_completa',$dadosBusca);
        }
        //$this->db->where('ativa','S');
        $this->db->where('(ativa = "S" OR site_novo = "S")',NULL,FALSE);
        $this->db->where('releaseNoticia = "N" OR releaseNoticia = "NR"',NULL,FALSE);
        return $this->db->count_all_results('novidades');
    }

    function selectAllAvisos($dadosBusca,$limite,$offset){        
        if($dadosBusca != ''){
            $this->db->like('descricao',$dadosBusca);
            //$this->db->or_like('sinopse',$dadosBusca);
            $this->db->or_like('descricao_completa',$dadosBusca);
        }        
        $this->db->where('ativa','S');
        //$this->db->where('(ativa = "S" OR site_novo = "S")',NULL,FALSE);
        $this->db->where('(releaseAviso = "N" OR releaseAviso = "NR")',NULL,FALSE);
        $this->db->order_by('id','desc');
        $this->db->group_by('id');
        $this->db->limit($limite,$offset);
        $this->db->select('descricao,descricao_completa,link,friendly_url,arquivo,dia,releaseAviso,ativa,id,alinfile,sinopse');	
        $this->db->from('avisos');
		//$this->db->join('tb_imagem_noticia','tb_imagem_noticia.noticia_id = novidades.id','LEFT');
        return $this->db->get()->result();
    }
}
?>