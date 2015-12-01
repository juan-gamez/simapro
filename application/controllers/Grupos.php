<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MGrupos','',TRUE);
    $this->load->model('MAreasAdministrativas','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Asignaturas';
    $this->load->view('asignaturas', $data);
  }

  function crear_y_asignar()
  {
    $grupo_id = $this->input->post('grupo_radio');
    if(is_numeric($grupo_id)){
      $grupo_aula = $this->input->post('grupo_aula');
      $grupo_horario = $this->input->post('grupo_horario');
      $id = $this->MGrupos->asociar_horario_aula($grupo_horario, $grupo_aula, $grupo_id);
    }
    else{
      $numero = $this->input->post('grupo_numero');
      $asignatura_ciclo = $this->input->post('grupo_asignatura');
      $encargado = $this->input->post('grupo_personal');
      $grupo_tipo = $this->input->post('grupo_tipo');
      $grupo_aula = $this->input->post('grupo_aula');
      $data['grupo_aula'] = $grupo_aula;
      $grupo_horario = $this->input->post('grupo_horario');
      $grupo_id = $this->MGrupos->save($numero, $asignatura_ciclo, $encargado, $grupo_tipo);
      $id = $this->MGrupos->asociar_horario_aula($grupo_horario, $grupo_aula, $grupo_id);      
    }

  }

  function grupo_horarios_aula(){
    $this->output->set_header('Content-Type: application/json; charset=utf-8');
    print $this->MGrupos->getGrupoHorariosAula($this->input->post('grupo_aula'));
  }

  function grupo_horarios_aula_por_asignatura(){
    $this->output->set_header('Content-Type: application/json; charset=utf-8');
    print $this->MGrupos->getGrupoHorariosAulaporAsignatura($this->input->post('grupo_asignatura'));
  }


  function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('asignaturas_nombre', 'nombre', 'trim|required|is_unique[asignaturas.nombre]');
    $this->form_validation->set_rules('asignaturas_facultad', 'escuela', 'trim|is_unique[asignaturas.escuela]|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un escuela valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Asignaturas';
      $this->load->view('asignaturas_formulario', $data);
      return;
    }
    else{
      $id = $this->MAsignaturas->save($this->input->post('asignaturas_nombre'), $this->input->post('asignaturas_facultad'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido agregado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue agregado';
      $data['header']['title'] = 'Agregar Asignaturas';
      $data['facultades'] = $this->MAsignaturas->getFacultades();
      $this->load->view('asignaturas', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $id = $this->uri->segment(3);
    if(is_numeric($id)){
      $row = $this->MAsignaturas->getOneById($id);
      $data['mod'] = array(
        'asignaturas_id' => $row->id,
        'asignaturas_nombre' => $row->nombre,
        'asignaturas_facultad' => $row->escuela
      );
      $data['header']['title'] = 'Modificar Asignaturas';
      $data['action'] = "/asignaturas/modificar/{$id}";
      $this->load->view('asignaturas_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('asignaturas_nombre', 'nombre', 'trim|required');
    $this->form_validation->set_rules('asignaturas_facultad', 'escuela', 'trim|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un escuela valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Asignaturas';
      $data['action'] = "/asignaturas/modificar/{$this->input->post('asignaturas_id')}";
      $this->load->view('asignaturas_formulario', $data);
      return;
    }
    else{
      $id = $this->MAsignaturas->update($this->input->post('asignaturas_id'), $this->input->post('asignaturas_nombre'), $this->input->post('asignaturas_facultad'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido modificado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue modificado';
      $data['header']['title'] = 'Asignaturas';
      $this->load->view('asignaturas', $data);
      return;
    }
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
          return "<a href=\"/asignaturas/modificar_formulario/{$row['codigo']}\">Modificar</a>";
        }
      ),
      array(
        'db' => 'codigo', 
        'dt' => 4, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/asignaturas/eliminar/{$row['codigo']}\">Eliminar</a>";
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

}
