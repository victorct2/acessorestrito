<div class="wrapper">

  <?php $this->load->view('include/header') ?>
  <?php $this->load->view('include/menuLateral') ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Avisos
        <small><?php echo date("d/m/Y");?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Avisos</li>
      </ol>
    </section>

    <br>

        <?php foreach ($listNoticias as $key => $noticia) { ?>
          <?php  echo (!(intval($key) % 2) || $key == '0') ? '<div class="row linhaNoticia"> ' : '';      

                if ($noticia->imagens != '') {
                    $imagem = explode(',',$noticia->imagens);
                    //print_r($imagem);
                ?>
                  <div class="col-sm-6">        
                      <h3><a href="<?php echo base_url('Home/noticiaAberta/'.$noticia->friendly_url)?>"></a>
                          <?php echo converteDataInterface($noticia->dia) .' :: '. $noticia->descricao ?> 
                      </h3>
                      <p>
                        <a href="<?php echo base_url('Home/noticiaAberta/'.$noticia->friendly_url)?>">
                          <?php echo $noticia->sinopse ?>»»
                        </a>
                      </p>
                  </div>
                <?php }else{ ?>
                  <div class="col-sm-6">
                    <h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?php echo converteDataInterface($noticia->dia) .' :: '. $noticia->descricao ?> </h3>              
                    <p><a href="<?php echo base_url('Home/noticiaAberta/'.$noticia->friendly_url)?>"><?php echo $noticia->sinopse ?>»»</a></p>
                  </div> 
                <?php } ?>
            
            <?php echo ((intval($key) % 2) && $key != '0') ? '</div><hr> ' : '';?>                   
            
        <?php } ?>
        

      <div class="row" >                       
        <div  style="text-align:center"> 
            <?php echo $paginacao ?>
        </div>
      </div>

  </div>
                   

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  