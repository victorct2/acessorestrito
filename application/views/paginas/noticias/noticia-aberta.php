<div class="wrapper">

<?php

$this->load->view('include/header'); 
$this->load->view('include/menuLateral'); 


$estiloColuna_1 = '';
$estiloColuna_2 = '';
//$imagem = '';
$url = base_url().'noticias/noticiaAberta/'.$noticia[0]->friendly_url;
$title = $noticia[0]->descricao;
$description = $noticia[0]->sinopse;

//$foto =  $this->input->get('foto') ? $this->input->get('foto') : FALSE;
?>
<div class="content-wrapper">
<section class="content-header">
  
    
      <hgroup>
       <h1>Notícias</h1>

      </hgroup>
    </div>
    <div class="overlay-internos"></div>
  </div>
</section>
<section>
  <div class="container textos-internos">

    <!--LINHA-->
    <div class="row">
        <div class="col-sm-12 texto-artigo">

        <?php
		//if($noticia[0]->imagens == '' && $noticia[0]->linkVideo == '' && $noticia[0]->codigoEmbed == ''){

		$estiloColuna_1 = "style='display:none'";
		$estiloColuna_2 = "style='width:90%;float:none !important; margin:0 auto'";

		//}
		?>

        <div class="col-sm-5" <?php echo @$estiloColuna_1 ?> >

        <?php //if($noticia[0]->imagens != ''){
              //foreach ($imagem as $key => $img) { ?>
                <img src="<?php// echo  IMAGEM_NOTICIA_SITE.$img ?>" class="img-responsive">
                <div class="legenda-video">
                  <?php //echo $arrayLegendasImagem[$key] ?>
                </div>
            <?php //} ?>
        <?php //} ?>
       

        </div>

       <div class="col-sm-7 descricaoCompleta" <?php echo $estiloColuna_2; ?>>

     	<h3><?php echo $noticia[0]->descricao; ?> <span class="small"> <em><strong>[<?php echo converteDataInterface($noticia[0]->dia); ?>]</strong></em></span></h3>

         <br/>

        <div class="row">
            <div class="col-sm-12" style="padding:6px 0 0 0">
                   <!-- AddToAny BEGIN -->
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">


                <a class="a2a_button_email" style="float:right !important"></a>
                <a class="a2a_button_twitter" style="float:right !important"></a>
                <a class="a2a_button_whatsapp" style="float:right !important"></a>
                <a class="a2a_button_facebook" style="float:right !important"></a>
                <a class="a2a_button_linkedin" style="float:right !important" ></a>
                <a class="" style="display:inline-block; padding:10px 10px; float:right !important; background:none !important; background-image:none !important"><strong>Compartilhar</strong></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
            </div>
        </div>
        <hr>


               <?php echo $noticia[0]->descricao_completa; ?>

        </div>

         </div>


    </div>
    <!--//-->


  </div>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <!-- <h4 class="modal-title">Como Assistir com antena parabólica</h4>-->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <!--<div class="modal-body"> <img src="images/instrucoesAntena.jpg" style="width:100%" alt="Instruções Antena Parabólica"> </div>-->

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
  
<?php $this->load->view('include/footer.php'); ?>
