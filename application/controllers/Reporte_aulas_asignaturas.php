<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Reporte de aulas usadas por materias impartidas en el ciclo (como matriz).

class Reporte_aulas_asignaturas extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MAsignaturas','',TRUE);
    $this->load->model('MAulas','',TRUE);
    $this->load->model('MPersonal','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Reporte de Aulas y Asignaturas en Matriz';
    $this->load->view('reporte_aulas_asignaturas', $data);
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Asignaturas';
    $data['escuelas'] = $this->MAreasAdministrativas->getAreas_Administrativas();
    $this->load->view('asignaturas_formulario', $data);
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
