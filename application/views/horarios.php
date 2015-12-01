<?php $this->view('header', $header); ?>
<div style="background: white; border: 1px solid #BBB; padding: 10px">
  
  <?php if(isset($msg_ok)){?>
  <div class="alert alert-ok alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b style="font-size: larger; color: #FFF"><?=$msg_ok?></b></div>
  <?php } ?>

  <?php if(isset($msg_error)){?>
  <div class="alert alert-error alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b style="font-size: larger; color: #FFF"><?=$msg_error?></b></div>
  <?php } ?>

  <select form="form_grupo" name="grupo_aula" class="form-control" style="width: auto">
  <?php foreach($aulas as $each){ ?>
    <option value="<?=$each['id']?>">&nbsp;<?=$each['nombre']?>&nbsp;</option>
  <?php } ?>
  </select><br>
  <table id="example" class="display table table-striped table-bordered table-border-bold" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Hora</th>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miercoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sabado</th>
      </tr>
    </thead>
      <tr>
        <td>6:20 - 8:00</td>
        <td id="1"></td>
        <td id="9"></td>
        <td id="17"></td>
        <td id="25"></td>
        <td id="33"></td>
        <td id="41"></td>
      </tr>
      <tr>
        <td>8:05 - 9:50</td>
        <td id="2"></td>
        <td id="10"></td>
        <td id="18"></td>
        <td id="26"></td>
        <td id="34"></td>
        <td id="42"></td>
      </tr>
      <tr>
        <td>9:50 - 11:30</td>
        <td id="3"></td>
        <td id="11"></td>
        <td id="19"></td>
        <td id="27"></td>
        <td id="35"></td>
        <td id="43"></td>
      </tr>
     <tr>
        <td>11:35 - 1:15</td>
        <td id="4"></td>
        <td id="12"></td>
        <td id="20"></td>
        <td id="28"></td>
        <td id="36"></td>
        <td id="44"></td>
      </tr>
     <tr>
        <td>1:20 - 3:00</td>
        <td id="5"></td>
        <td id="13"></td>
        <td id="21"></td>
        <td id="29"></td>
        <td id="37"></td>
        <td id="45"></td>
      </tr>
     <tr>
        <td>3:05 - 4:45</td>
        <td id="6"></td>
        <td id="14"></td>
        <td id="22"></td>
        <td id="30"></td>
        <td id="38"></td>
        <td id="46"></td>
      </tr>
     <tr>
        <td>4:50 - 6:30</td>
        <td id="7"></td>
        <td id="15"></td>
        <td id="23"></td>
        <td id="31"></td>
        <td id="39"></td>
        <td id="47"></td>
      </tr>
     <tr>
        <td>6:35 - 8:15</td>
        <td id="8"></td>
        <td id="16"></td>
        <td id="24"></td>
        <td id="32"></td>
        <td id="40"></td>
        <td id="48"></td>
      </tr>
  </table>
</div>


<ul id="context-menu" class="dropdown-menu" aria-labelledby="dropdownMenu1">
  <li><a href="#" onclick='$("#nuevo_grupo_modal").modal();$("select[name=grupo_asignatura]").trigger("change");'>Asignar grupo en este horario</a></li>
  <li role="separator" class="divider"></li>
</ul>

<form role="form" method="POST" action="" id="form_grupo">
  <div class="modal <!-- fade--> " id="nuevo_grupo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="message-text" class="control-label">Asignatura:</label>
              <select name="grupo_asignatura" class="form-control" style="width: auto">
              <?php foreach($asignaturas as $each){ ?>
                <option value="<?=$each['id']?>">&nbsp;<?=$each['codigo']?> - <?=$each['nombre']?>&nbsp;</option>
              <?php } ?>
              </select>
            </div>
            
            <div class="form-group">
              <label for="message-text" class="control-label">Encargado:</label>
              <select name="grupo_personal" class="form-control" style="width: auto">
              <?php foreach($personal as $each){ ?>
                <option value="<?=$each['id']?>">&nbsp;<?=$each['nombre']?>&nbsp;</option>
              <?php } ?>
              </select>
            </div> 

            <div class="form-group">
              <label for="message-text" class="control-label">Tipo:</label>
              <select name="grupo_tipo" class="form-control" style="width: auto">
                <option value="G.T.">Teorico (G.T.)</option>
                <option value="G.D.">Discusion (G.D.)</option>
                <option value="G.L.">Laboratorio (G.L.)</option>
              </select>
            </div> 

            <div class="form-group">
              <label for="message-text" class="control-label">Numero:</label>
              <input type="text" name="grupo_numero" class="form-control" />
            </div>
            <input type="hidden" name="grupo_horario" value="" />
            <input type="hidden" name="grupo_segundo_horario" value="" />

            <label for="message-text" class="control-label">Grupos:</label>
            <div class="form-group" id="grupo_radio_div">

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" form="form_grupo">Asignar</button>
        </div>
      </div>
    </div>
  </div>
</form>  


<script>
  function getMenuPosition(mouse, direction, scrollDir) {
    var win = $(window)[direction](),
      scroll = $(window)[scrollDir](),
      menu = $("#context-menu")[direction](),
      position = mouse + scroll;
    // opening menu would pass the side of the page
    if (mouse + menu > win && menu < mouse) 
      position -= menu;
    return position
  }

  function borrarHorarios(){
    for(var i=1; i<=48; i++){
      $("#"+i).html("");
    }
  }
  function llenarHorarios(data){
    borrarHorarios();
    for(var i in data){
      var horario_id = data[i].horario_id;
      $("#"+horario_id).html(data[i].codigo + " " + data[i].tipo + " " + data[i].numero);
    }
  }

  window.onload = function() {
    $("body").on("click", "#example td", function(e){
      $("#context-menu").css({
        display: "block",
        left: getMenuPosition(e.clientX, 'width',  'scrollLeft'),
        top:  getMenuPosition(e.clientY, 'height', 'scrollTop')
      });
      $('[name="grupo_horario"]').val(e.target.id);
      e.stopPropagation();
      return false;
    });
    $("body").on("click", ":not(#example td)", function(e){
      $("#context-menu").css({
        display: "none"
      });
    });

    $("#form_grupo").submit(function(e){
      var form_data = {
        grupo_aula :       $("select[name=grupo_aula]").val(),
        grupo_horario :    $("input[name=grupo_horario]").val(),
        grupo_asignatura : $("select[name=grupo_asignatura]").val(),
        grupo_personal :   $("select[name=grupo_personal]").val(),
        grupo_tipo :       $("select[name=grupo_tipo]").val(),
        grupo_numero :     $("input[name=grupo_numero]").val(),
        grupo_radio :      $("input[name=grupo_radio]:checked").val(),
      };
      $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '/grupos/crear_y_asignar', // the url where we want to POST
        data        : form_data, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true
      }).done(function(data) {
        gha = JSON.parse(JSON.stringify(data));
        console.log(gha);
      });
      $("#nuevo_grupo_modal").modal('hide');
      e.preventDefault();
      setTimeout(function(){
        $("select[name=grupo_aula]").trigger('change');
        $("input:radio").attr("checked", false);
      }, 200);
    });


    $("select[name=grupo_aula]").change(function(e){
      $.ajax({      
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '/grupos/grupo_horarios_aula', // the url where we want to POST
        data        : {grupo_aula: $("select[name=grupo_aula]").val()}, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true
      }).done(function(data) {
        /*Iterate over the array of objects and write to the cells*/
        llenarHorarios(data);
      });
    });

    $("select[name=grupo_asignatura]").change(function(e){
      $.ajax({      
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '/grupos/grupo_horarios_aula_por_asignatura', // the url where we want to POST
        data        : {grupo_asignatura: $("select[name=grupo_asignatura]").val()}, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true
      }).done(function(data) {
        var radio = "";
        for(var i in data){
          radio = radio + '<input type="radio" name="grupo_radio" value="' + data[i].grupo_id + '">&nbsp;' + data[i].codigo + " " + data[i].tipo + " " + data[i].numero + '<br>';
        }
        $("#grupo_radio_div").html(radio);
      });
    });

    $("select[name=grupo_aula]").trigger('change');

  };



</script>
<?php $this->view('footer'); ?>