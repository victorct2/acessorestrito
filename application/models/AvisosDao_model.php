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

	

	 function selectNoticiaByFriendly_url($friendly_url){
        $this->db->where('friendly_url',$friendly_url);
        $this->db->select('descricao,subtitulo,sinopse,descricao_completa,link,friendly_url,linkVideo,legendaVideo,imagem,dia,codigoEmbed,releaseNoticia, ativa,id,GROUP_CONCAT(tb_imagem_noticia.nomeImagem) as imagens,GROUP_CONCAT(tb_imagem_noticia.legendaImagem) as legendasImagem');	
        $this->db->from('novidades');
        $this->db->join('tb_imagem_noticia','tb_imagem_noticia.noticia_id = novidades.id','LEFT');
        return $this->db->get()->result();
    }
}
?>