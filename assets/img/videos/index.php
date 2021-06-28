<?php 


// configuracoes do site
require_once realpath('../config.inc.php'); 

// iniciando sessao 
require_once realpath('../session.inc.php');

require_once realpath('../autenticacao.inc.php');

// Fun��o para tratar palavra
require_once realpath('../_funcoes/tratar-palavra.php');
// Fun��o para letras minusculas e maiusculas
require_once realpath('../_funcoes/real_upper_lower.php');

// ADODB
require_once realpath('../_adodb/adodb.inc.php');
// Conexao
require_once realpath('../conexao.inc.php');

require_once realpath('../_classes/BaseConnection.class.php');

$baseConnection = new BaseConnection($db);

/**
 * PEGANDO O USU�RIO, SE EXISTIR NA SESS�O
 */
$id_usuario = ( isset($_SESSION['usuario_id']) ) ? $_SESSION['usuario_id'] : 0 ;

 header('location:' . DOMINIO . '/index.php');

if($id_usuario == 0) {
  
  header('location:' . DOMINIO . '/index.php');
}
