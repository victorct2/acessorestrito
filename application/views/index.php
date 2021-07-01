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

        <?php foreach ($listAvisos as $key => $avisos) { ?>
          <?php  echo (!(intval($key) % 2) || $key == '0') ? '<div class="row linhaNoticia"> ' : '';   ?>   

                   <div class="col-sm-6">        
                      <h3><a href="<?php echo base_url('Home/avisoAberto/'.$avisos->friendly_url)?>"></a>
                          <?php echo converteDataInterface($avisos->dia) .' :: '. $avisos->descricao ?> 
                      </h3>
                      <p>
                        <a href="<?php echo base_url('Home/avisoAberto/'.$avisos->friendly_url)?>">
                          <?php echo $avisos->sinopse ?>»»
                        </a>
                      </p>
                  </div>
                
            
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

  