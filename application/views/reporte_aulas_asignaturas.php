<?php $this->view('header', $header); ?>
<div style="background: white; border: 1px solid #BBB; padding: 10px">

  <table id="tabla_reporte_horarios_aulas">
  </table>
</div>


<script>
  window.onload = function() {
    $.ajax({
      type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
      url         : '/asignaturas_ciclo/asignaturas_ciclo', // the url where we want to POST
      dataType    : 'text' // what type of data do we expect back from the server
    }).done(function(data) {
      $("#tabla_reporte_horarios_aulas").html(data);
    });
  };
</script>
<?php $this->view('footer'); ?>