<div class="wrapper">

  <?php $this->load->view('include/header') ?>
  <?php $this->load->view('include/menuLateral') ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Sistemas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $this->videosDao_model->totalVideos() ?></h3>

              <p>Total de Vídeos</p>
            </div>
            <div class="icon">
              <i class="ion-android-film"></i>
            </div>
            <a href="<?php echo base_url('VideosController/viewLista')  ?>" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $this->usuariosDao_model->totalUsuarios() ?></h3>

              <p>Total de Usuários</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url('UsuariosController/viewLista')  ?>" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              
              <h3 id="totalAcessosOnDemand"><small style="color:#FFF">contabilizando...</small></h3>

              <p>Total de Acessos</p>
            </div>
            <div class="icon">
              <i class="ion-android-contacts"></i> 
            </div>
            <a href="<?php echo base_url('RelatorioAcessosController/relatorioDeAcessos')  ?>" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              
              <h3 id="totalDownloadsOnDemand"><small style="color:#FFF">contabilizando...</small></h3>

              <p>Total de Downloads</p>
            </div>
            <div class="icon">
              <i class="ion-android-download"></i>
            </div>
            <a href="<?php echo base_url('RelatorioDownloadsController/relatorioDeDownload')  ?>" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
         
          

          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Lista de Avisos</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                    <?php echo $paginacao; ?>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <?php foreach ($listaAvisos as $aviso) { ?>
                
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fa fa-ellipsis-v"></i>
                      <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <input type="checkbox" value="" name=""/>
                    <!-- todo text -->
                    <span class="text"><?php echo $aviso->descricao?></span>
                    <!-- Emphasis label -->
                    <label class="label label-success"><i class="fa fa-clock-o"></i> <?php echo retornaDataEstilizada($aviso->dataAviso) ?></label>
                    <?php switch ($aviso->prioridade) {
                      case '1':
                        echo '<small class="label label-danger"><i class="fa fa-bolt"></i> Alta</small>';
                        break;
                      case '2':
                        echo '<small class="label label-warning"><i class="fa fa-bolt"></i> Média</small>';
                        break;
                      case '3':
                        echo '<small class="label label-default"><i class="fa fa-bolt"></i> Baixa</small>';
                        break;
                      default:

                        break;
                    }?>

                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <!--<a href="#" class="alterarAviso" id="<?php echo $aviso->idAviso?>"><i class="fa fa-edit"></i></a>-->
                      <a href="#" class="excluirAviso" id="<?php echo $aviso->idAviso?>"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </li>
                <?php  } ?>
                
              </ul>
              <div  id="myModal"></div>
              </div><!-- /.box-body -->
              <div class="box-footer clearfix no-border">
                <button class="btn btn-default pull-right" id="cadastrarAviso"><i class="fa fa-plus"></i> Novo Aviso</button>  
              </div>
          </div>
          <!-- /.box -->

         
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">
                   

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  