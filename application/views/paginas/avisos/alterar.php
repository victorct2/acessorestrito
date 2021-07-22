<div class="wrapper">

  <?php $this->load->view('include/header') ?>
  <?php $this->load->view('include/menuLateral') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sistema de Avisos
        <small>Cadastro</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('AvisosController/viewCadastro') ?>">Sistema de Avisos</a></li>
        <li class="active">Cadastro</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <form action="<?php echo base_url('AvisosController/alterarAvisos') ?>" method="POST" id="formNoticias">

              

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Informações</h3>

            <?php $this->load->view('include/alertsMsg') ?>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <input type="hidden" name="id" value="<?php echo $avisos[0]->id ?>">
            
            <div class="row">
              <div class="col-md-6">

               <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="descricao" class="form-control" rows="4" placeholder="Descrição ..."><?php echo $avisos[0]->descricao ?></textarea>
                </div>

                <div class="form-group">
                    <label>Sinopse</label>
                    <textarea name="sinopse" class="form-control" rows="4" placeholder="Sinopse ..."><?php echo $avisos[0]->sinopse ?></textarea>
                </div>

              
                              
              </div>
              <!-- /.col -->
              <div class="col-md-6">

                

                <!-- Date -->
                  <div class="form-group">
                    <label>Data:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="dia" type="text" class="form-control pull-right" id="datepicker" value="<?php echo converteDataInterface($avisos[0]->dia) ?>">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  
                 <div class="form-group">
                    <label>Situação</label>
                    <select name="ativa" class="form-control select2" style="width: 100%;">
                      <option value="S" <?php echo ($avisos[0]->ativa == 'S')? 'selected="selected"':'' ?>>ATIVO</option>
                    <option value="N" <?php echo ($avisos[0]->ativa == 'N')? 'selected="selected"':'' ?>>INATIVO</option>
                    </select>
                  </div>

                
                <div id="resp"></div>
                <button type="submit" class="btn btn-warning">Alterar</button>
               
              
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
          
        </div>
        <!-- /.box -->

        

        <!-- NOTÌCIA -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Aviso</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">          
            <div class="row">
                
                <div class="box-body pad">
                  <form>
                        <textarea id="editor1" name="descricao_completa" rows="10" cols="80">
                           <?php echo $avisos[0]->descricao_completa ?>
                           
                        </textarea>
                  </form>
                </div>
              
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
          
        </div>
        <!-- /.box -->

     </form>

     <br><br><br>

     <!-- IMAGEM -->
     <div class="box box-default">
      
      
        
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->