<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMAPRO - <?php echo $title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/plugins/DataTables/css/dataTables.bootstrap.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- SIMAPRO -->
    <link rel="stylesheet" href="/css/simapro.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">

    <!-- <link rel="stylesheet" type="text/css" href="/plugins/DataTables/datatables.min.css"/>-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo hidden-xs">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SMP</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SIMAPRO</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

            <div class="nav navbar-nav visible-xs" style=" padding: 0; margin:0; display: inline; float: left; padding-left: 15px; margin-top: 3px;">
              <a href="/" style="font-size: 20px;line-height: 50px;text-align: center;font-family: Helvetica,Arial,sans-serif;color: #FFF;font-weight: 700">
                <b>SIMAPRO</b>
              </a>
            </div>  

          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-user" style="vertical-align: middle;margin-right:10px;font-size: 18px;margin-top:-2px"></span><span class="hidden-xs">
                  <?php
                    if(isset($this->session->userdata('logged_in')['username'])){
                      echo $this->session->userdata('logged_in')['username'];
                    }
                  ?>
                  </span>&nbsp;<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="width: 200px; border: 1px solid rgba(0, 0, 0, 0.15); border-radius: 4px; box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.176);">
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="/login/logout" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Cerrar Sesion</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>


          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="/">
                <i class="fa fa-file-text-o"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/locales"><i class="fa fa-circle"></i>Locales</a></li>
                <li><a href="/diferidos"><i class="fa fa-circle"></i>Diferidos</a></li>
                <li><a href="/revision"><i class="fa fa-circle"></i>Revision de Notas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Mantto General</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/personal"><i class="fa fa-circle"></i>Personal</a></li>
                <li><a href="/alumnos"><i class="fa fa-circle"></i>Alumnos</a></li>
                <li><a href="/facultades"><i class="fa fa-circle"></i>Facultades</a></li>
                <li><a href="/escuelas"><i class="fa fa-circle"></i>Escuelas</a></li>
                <li><a href="/carreras"><i class="fa fa-circle"></i>Carreras</a></li>
                <li><a href="/areas_administrativas"><i class="fa fa-circle"></i>Areas Administrativas</a></li>
                <li><a href="/ciclos"><i class="fa fa-circle"></i>Ciclos</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Asignaturas y Horarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/aulas"><i class="fa fa-circle"></i>Aulas</a></li>
                <li><a href="/asignaturas"><i class="fa fa-circle"></i>Asignaturas</a></li>
                <li><a href="/asignaturas_ciclo"><i class="fa fa-circle"></i>Asignaturas en el Ciclo</a></li>
                <li><a href="/asignaturas_grupos"><i class="fa fa-circle"></i>Grupos de Asignaturas</a></li>
                <li><a href="/horarios"><i class="fa fa-circle"></i>Horarios</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-check"></i>
                <span>Revisiones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-history"></i>
                <span>Diferidos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-database"></i>
                <span>Respaldos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> Aplicacion</a></li>
                <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Datos</a></li>
                <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Aplicacion + Datos</a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Flash Data -->
        <?php
          /*$fd = $this->session->flashdata('item');
          if($fd){

          }
          */
        ?>
        <!-- Main content -->
        <section class="content">
          <script>
          window.addEventListener('load', function(){
            var pathArray = window.location.pathname.split( '/' );
            if(pathArray[1]!=""){
              $('li.treeview a[href="/' + pathArray[1] + '"]').addClass("active-menu-item").parent().parent().parent().addClass("active");
            }
          });
          </script>