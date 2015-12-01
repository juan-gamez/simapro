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
        <form role="form" method="POST" action="<?php echo isset($action)?$action:"/ciclos/agregar" ?>">
          <?php $cn = "ciclos_id" ?>
          <input type="hidden" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>">
          <div class="box-body">

            <?php $cn = "ciclos_nombre" ?>
            <label for="<?=$cn?>">Nombre</label>
            <div class="form-group">
              <input type="text" class="form-control" id="<?=$cn?>" name="<?=$cn?>" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="Nombre de Facultad">
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>


            <?php $cn = "ciclos_fecha_inicio" ?>
            <label for="<?=$cn?>">Fecha de Inicio</label>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" id="<?=$cn?>" name="<?=$cn?>" data="DateTimePicker" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="dd/mm/YYYY">
                <span class="input-group-btn">
                  <button id="<?=$cn?>_button" class="btn btn-green" type="button" style="border: 1px solid #CCC"><i class="fa fa-calendar"></i></button>
                </span>
              </div>
            </div>
            <?php if(form_error($cn) != "") echo form_error($cn); ?>

            <?php $cn = "ciclos_fecha_fin" ?>
            <label for="<?=$cn?>">Fecha de Fin</label>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" id="<?=$cn?>" name="<?=$cn?>" data="DateTimePicker" value="<?=set_value($cn, @$mod[$cn])?>" placeholder="dd/mm/YYYY">
                <span class="input-group-btn">
                  <button id="<?=$cn?>_button" class="btn btn-green" type="button" style="border: 1px solid #CCC"><i class="fa fa-calendar"></i></button>
                </span>
              </div>
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

<script>
  window.addEventListener('load', function(){
      <?php $cn = "ciclos_fecha_inicio" ?>
      $('#<?=$cn?>').datetimepicker({
        format: 'YYYY-MM-DD',
        daysOfWeekDisabled: [0,6],
        locale: "es",
        useCurrent: false
      });
      $('#<?=$cn?>_button').click(function(){
        $('#<?=$cn?>').data("DateTimePicker").show();
      });


      <?php $cn = "ciclos_fecha_fin" ?>
      $('#<?=$cn?>').datetimepicker({
        format: 'YYYY-MM-DD',
        daysOfWeekDisabled: [0,6],
        locale: "es",
        useCurrent: false
      });
      $('#<?=$cn?>_button').click(function(){
        $('#<?=$cn?>').data("DateTimePicker").toggle();
      });
  });  
</script>
<?php $this->view('footer'); ?>