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
        <form role="form" method="POST" action="<?php echo isset($action)?$action:"/escuelas/agregar" ?>">
          <?php $cn = "escuelas_id" ?>
          <input type="hidden" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>">
          <div class="box-body">
            <div class="form-group">
            <?php $cn = "escuelas_nombre" ?>
              <label for="<?=$cn?>">Nombre</label>
              <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Nombre de Escuela">
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>

            <?php $cn = "escuelas_facultad" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Facultad</label><br>
              <!-- <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Correo Electronico">-->
              <select name="" class="form-control">
              <?php foreach($facultades as $each){ ?>
                &nbsp;&nbsp;<option value="<?=$each['id']?>">&nbsp;<?=$each['nombre']?>&nbsp;</option>
              <?php } ?>
              </select>
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>

            <?php $cn = "escuelas_director" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Director</label><br>
              <!-- <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Correo Electronico">-->
              <select name="" class="form-control">
              <?php foreach($personal as $each){ ?>
                &nbsp;&nbsp;<option value="<?=$each['id']?>">&nbsp;<?=$each['nombre']?>&nbsp;</option>
              <?php } ?>
              </select>
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