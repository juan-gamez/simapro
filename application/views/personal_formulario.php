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
        
        <!-- form start -->
        <form role="form" method="POST" action="<?php echo isset($action)?$action:"/personal/agregar" ?>">
          <?php $cn = "personal_id" ?>
          <input type="hidden" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>">
          <div class="box-body">
            <div class="form-group">
            <?php $cn = "personal_nombre" ?>
              <label for="<?=$cn?>">Apellidos y Nombres</label>
              <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Nombre de Personal">
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>

            <?php $cn = "personal_correo" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Correo</label>
              <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Correo Electronico">
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