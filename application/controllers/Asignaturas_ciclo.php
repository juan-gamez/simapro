<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignaturas_ciclo extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MAsignaturas','',TRUE);
    $this->load->model('MAulas','',TRUE);
    $this->load->model('MGrupos','',TRUE);
    $this->load->helper('url');
    date_default_timezone_set("America/El_Salvador");
  }

  function index()
  {
    $data['header']['title'] = 'Asignaturas en el Ciclo';
    $this->load->view('asignaturas_en_el_ciclo', $data);
  }

  function ajax()
  {
    $table = 'v_asignaturas';
    $primaryKey = 'codigo';
    $columns = array(
      array( 'db' => 'nombre_area_administrativa',   'dt' => 0 ),
      array( 'db' => 'codigo',       'dt' => 1 ),
      array( 'db' => 'nombre',   'dt' => 2 ),
      array(
        'db' => 'codigo', 
        'dt' => 3, 
        'formatter' => function( $d, $row ) {
          return '<input type="checkbox" name="asignatura_ciclo" value="'. $d. '" onclick="$.ajax({method: \'POST\', url: \'/asignaturas_ciclo/asociar_asignatura_ciclo\', data: { asignatura: \''. $d .'\'}})">';
        }
      )
    );
    $sql_details = array(
      'user' => 'root',
      'pass' => 'root',
      'db'   => 'simapro',
      'host' => 'localhost'
    );
    require( 'ssp.class.php' );
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
    );
  }

  function asociar_asignatura_ciclo(){
    echo json_encode(
      $this->input->post('asignatura')
    );
  }

  function asignaturas_ciclo(){
    $grupoHorariosAula = $this->MGrupos->getAllGrupoHorariosAula();
    print "<tr><th colspan=\"2\">Asignaturas</th>";
    foreach ($this->MAulas->getAulas() as $aulas){
      print "<th>".$aulas['nombre']."</th>";
    }
    print "</tr>";
    foreach ($this->MAsignaturas->getAsignaturas_ciclo() as $asignaturas_ciclo){
      print "<tr><td>".$asignaturas_ciclo['codigo']."</td><td>".$asignaturas_ciclo['nombre']."</td>";
      foreach ($this->MAulas->getAulas() as $aulas){
        print "<td>";
        foreach ($grupoHorariosAula as $row){
          if($row['codigo']==$asignaturas_ciclo['codigo'] and $row['aula_id']==$aulas['id']){
            $hora_inicio = date("G:i",strtotime($row['hora_inicio']));
            $hora_fin = date("G:i",strtotime($row['hora_fin']));
            print "{$row['tipo']} {$row['numero']} {$this->MAsignaturas->nombre_dia_semana($row['dia_semana'])} {$hora_inicio}-{$hora_fin}<br>";
          }
        }
        print "</td>";
      }
      print "</tr>";
    }
  }
}