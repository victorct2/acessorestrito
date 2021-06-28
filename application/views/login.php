<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url()?>"><b>Canal Saúde</b> - COOPAS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php $this->load->view('include/alertsMsg') ?>
    <p class="login-box-msg">Faça login para iniciar sua sessão</p>

    <form action="<?php echo base_url('Login/autentication') ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="login" class="form-control" placeholder="Login">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senha" class="form-control" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    <!--<a href="#">Esqueci a minha senha</a><br>
    <a href="register.html" class="text-center">Cadastrar novo usuário</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

