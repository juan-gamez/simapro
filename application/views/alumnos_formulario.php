<?php
  $this->load->library('form_validation'); 
  $this->view('header', $header); 
?>
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border" style="background: rgba(0,0,0,0.05)">
          <h3 class="box-title"><?php echo $header['title']?></h3>
        </div>


        <?php if(isset($msg_ok)){?>
        <div class="alert alert-ok alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b style="font-size: larger; color: #FFF"><?=$msg_ok?></b></div>
        <?php } ?>

        <?php if(isset($msg_error)){?>
        <div class="alert alert-error alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b style="font-size: larger; color: #FFF"><?=$msg_error?></b></div>
        <?php } ?>


        <!-- form start -->
        <form role="form" method="POST" action="<?php echo isset($action)?$action:"/alumnos/agregar" ?>">
          
          <?php $cn = "alumnos_carnet" ?>
          <input type="hidden" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>">

          <div class="box-body">

            <?php $cn = "alumnos_carnet" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Carnet: [@@#####]</label>
              <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Carnet de Alumnos: @@#####">
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>


            <?php $cn = "alumnos_nombres" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Nombres</label>
              <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Nombre de Alumnos">
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>

            <?php $cn = "alumnos_apellidos" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Apellidos</label>
              <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Apellidos de Alumno">
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>
          </div>

          <!-- /.box-footer -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </form>
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </div>   <!-- /.row -->

<?php $this->view('footer'); ?>