<div class="wrapper">
  <?php $this->load->view('include/header') ?>
  <?php $this->load->view('include/menuLateral') ?>
  <div class="content-wrapper">
  <section id="parallaxBar" class="noticias" data-speed="6">
  <div class="container-fluid">
    <div class="hero">
      <hgroup>    
    <h1>Avisos</h1><big><?php echo date("d/m/Y");?></big>
  <br>
      </hgroup>
    </div>
    <div class="overlay-internos"></div>
  </div>
</section>
<section>
  <div class="container textos-internos "> 
        <?php foreach ($listAvisos as $key => $avisos) { ?>
          <?php  echo (!(intval($key) % 2) || $key == '0') ? '<div class="row linhaNoticia"> ' : '';   ?>   

                   <div class="col-sm-6">        
                      <h3><a href="<?php echo base_url('Home/avisoAberto/'.$avisos->friendly_url)?>"></a></h3>
<h3><span class="glyphicon glyphicon-arrow-right " aria-hidden="true"></span><?php echo converteDataInterface($avisos->dia) .' :: '. $avisos->descricao ?> </h3>
<p><a href="<?php echo base_url('Home/avisoAberto/'.$avisos->friendly_url)?>"><?php echo $avisos->sinopse ?>»»</a></p>
                  </div>


                
            
            <?php echo ((intval($key) % 2) && $key != '0') ? '</div><hr> ' : '';?>                   
            
        <?php } ?>
        

      </div>

      
</section>

<div class="row" >                       
        <div  style="text-align:center"> 
            <?php echo $paginacao ?>
        </div>
</div>

</div>


    
  