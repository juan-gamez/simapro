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
        <form role="form" method="POST" action="<?php echo isset($action)?$action:"/areas_administrativas/agregar" ?>">
          <?php $cn = "areas_administrativas_id" ?>
          <input type="hidden" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>">
          <div class="box-body">
            <div class="form-group">
            <?php $cn = "areas_administrativas_nombre" ?>
              <label for="<?=$cn?>">Nombre</label>
              <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Nombre de Area Administrativa">
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>

            <?php $cn = "areas_administrativas_escuela" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Escuela</label><br>
              <!-- <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Correo Electronico">-->
              <select name="" class="form-control">
              <?php foreach($escuelas as $each){ ?>
                &nbsp;&nbsp;<option value="<?=$each['id']?>">&nbsp;<?=$each['nombre']?>&nbsp;</option>
              <?php } ?>
              </select>
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>

            <?php $cn = "areas_administrativas_jefe" ?>
            <div class="form-group">
              <label for="<?=$cn?>">Jefe</label><br>
              <!-- <input type="text" class="form-control" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Correo Electronico">-->
              <select name="" class="form-control form-control-select">
              <?php foreach($personal as $each){ ?>
                <option value="<?=$each['id']?>">&nbsp;<?=$each['nombre']?>&nbsp;</option>
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