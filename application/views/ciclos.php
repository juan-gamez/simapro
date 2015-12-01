<?php $this->view('header', $header); ?>
<div style="background: white; border: 1px solid #BBB; padding: 10px">
  
  <?php if(isset($msg_ok)){?>
  <div class="alert alert-ok alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b style="font-size: larger; color: #FFF"><?=$msg_ok?></b></div>
  <?php } ?>

  <?php if(isset($msg_error)){?>
  <div class="alert alert-error alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b style="font-size: larger; color: #FFF"><?=$msg_error?></b></div>
  <?php } ?>

  <a href="/ciclos/formulario_agregar" class="enlace-formulario"> <i class="fa fa-plus-circle"></i> &nbsp;Agregar Ciclos</a><br>
  <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th width="1px">id</th>
        <th>Nombre</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Paridad</th>
        <th>Activo</th>
        <th width="1px">Modificar</th>
        <th width="1px">Eliminar</th>
      </tr>
    </thead>
  </table>
</div>
<script>
  window.onload = function() {
    $('#example').DataTable( {
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      "ajax": "/ciclos/ajax",
      "language" : {
        "url": "/plugins/DataTables/spanish.json"
      },
      "order": [[ 0, "desc" ]],
      "columnDefs": [
        { "orderable": false, "targets": [6,7] }
      ]
    } );
  } ;  
</script>
<?php $this->view('footer'); ?>