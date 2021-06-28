<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo IMAGEM_AVATAR.$this->session->userdata("avatar")?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php $nome = explode(' ' ,$this->session->userdata("nomeUsuario")); ?>
          <p><?php echo $nome[0] . ' ' . $nome[1] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU NAVEGAÇÃO</li>
        <li <?php echo (isset($mainNav) && $mainNav == 'home')? 'class="active"':'' ?> >
          <a href="<?php echo base_url('Home') ?>">
            <i class="fa fa-th"></i> <span>Home</span>
          </a>
        </li>
        <li <?php echo (isset($mainNav) && $mainNav == 'perfil')? 'class="active"':'' ?>>
          <a href="<?php echo base_url('UsuariosController/viewPerfil') ?>">
            <i class="fa fa-user-circle text-yellow"></i> <span>Perfil</span>
          </a>
        </li>
       
       
      
        <li <?php echo (isset($mainNav) && $mainNav == 'grupos')?'class="active treeview"':'class="treeview"' ?>>
          <a href="#">
            <i class="fa fa-users"></i> <span>Grupos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo (isset($subMainNav) && $subMainNav == 'cadastroGrupo')? 'class="active"':'' ?>><a href="<?php echo base_url('GruposController/viewCadastro') ?>"><i class="fa fa-circle-o"></i> Cadastro</a></li>
            <li <?php echo (isset($subMainNav) && $subMainNav == 'listaGrupos')? 'class="active"':'' ?>><a href="<?php echo base_url('GruposController/viewLista') ?>"><i class="fa fa-circle-o"></i> lista</a></li>
          </ul>
        </li>

         <li <?php echo (isset($mainNav) && $mainNav == 'restrito')?'class="active treeview"':'class="treeview"' ?>>
          <a href="#">
            <i class="fa fa-circle-o text-aqua"></i> <span>Acesso Restrito</span>
           <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php echo (isset($subMainNav) && $subMainNav == 'restrito')? 'class="active"':'' ?>><a href="<?php echo base_url('RestritoController/viewCadastro') ?>"><i class="fa fa-circle-o"></i> Cadastro</a></li>
            <li <?php echo (isset($subMainNav) && $subMainNav == 'restrito')? 'class="active"':'' ?>><a href="<?php echo base_url('RestritoController/viewLista') ?>"><i class="fa fa-circle-o"></i> lista</a></li>
             
          </ul>
        </li>

         <li><a href="http://coopas.tv.br/" target="_blank"><i class="fa fa-circle-o text-aqua"></i><span>Site COOPAS</span></a></li>
       
       


        
    <!-- /.sidebar -->


  </aside>
