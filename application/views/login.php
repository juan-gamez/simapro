<?php 
  $this->load->library('form_validation'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMAPRO - Iniciar Sesion</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- SIMAPRO -->
    <link rel="stylesheet" href="/css/simapro.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      
      <div class="login-logo">
        <b>SIMAPRO</b><br>
        <p style="font-size: 16pt;" class="simapro-title"> 
        <!-- <p style="font-size: 16pt;padding:0; margin-left:-100px;margin-right:-100px;padding-left:25px; padding-right:25px"> -->
          Sistema Informático para el manejo de procedimientos de <br>Reserva de Locales, Solicitudes de Diferidos y Revisión de Evaluaciones de la FIA
        </p>
      </div><!-- /.login-logo -->
      
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese su usuario y clave para iniciar sesion</p>
        <form action="/login/check" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" id="username" class="form-control" placeholder="Usuario">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <?php if(form_error('username') != "") echo form_error('username'); ?>

          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Clave">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <?php if(form_error('password') != "") echo form_error('password'); ?>
          <div class="row">
            <div class="col-xs-7">
            </div><!-- /.col -->
            <div class="col-xs-5">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesion</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="/js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- iCheck -->
  </body>
</html>
