<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carreras extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MCarreras','',TRUE);
    $this->load->model('MEscuelas','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Carreras';
    $this->load->view('carreras', $data);
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Carreras';
    $data['escuelas'] = $this->MEscuelas->getEscuelas();
    $this->load->view('carreras_formulario', $data);
  }

 function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('carreras_nombre', 'nombre', 'trim|required|is_unique[carreras.nombre]');
    $this->form_validation->set_rules('carreras_facultad', 'escuela', 'trim|is_unique[carreras.escuela]|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un escuela valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Carreras';
      $this->load->view('carreras_formulario', $data);
      return;
    }
    else{
      $id = $this->MCarreras->save($this->input->post('carreras_nombre'), $this->input->post('carreras_facultad'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido agregado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue agregado';
      $data['header']['title'] = 'Agregar Carreras';
      $data['facultades'] = $this->MCarreras->getFacultades();
      $this->load->view('carreras', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $id = $this->uri->segment(3);
    if(is_numeric($id)){
      $row = $this->MCarreras->getOneById($id);
      $data['mod'] = array(
        'carreras_id' => $row->id,
        'carreras_nombre' => $row->nombre,
        'carreras_facultad' => $row->escuela
      );
      $data['header']['title'] = 'Modificar Carreras';
      $data['action'] = "/carreras/modificar/{$id}";
      $this->load->view('carreras_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('carreras_nombre', 'nombre', 'trim|required');
    $this->form_validation->set_rules('carreras_facultad', 'escuela', 'trim|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un escuela valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Carreras';
      $data['action'] = "/carreras/modificar/{$this->input->post('carreras_id')}";
      $this->load->view('carreras_formulario', $data);
      return;
    }
    else{
      $id = $this->MCarreras->update($this->input->post('carreras_id'), $this->input->post('carreras_nombre'), $this->input->post('carreras_facultad'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido modificado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue modificado';
      $data['header']['title'] = 'Carreras';
      $this->load->view('carreras', $data);
      return;
    }
  }

  function ajax()
  {
    $table = 'v_carreras';
    $primaryKey = 'codigo';
    $columns = array(
      array( 'db' => 'escuela',   'dt' => 0 ),
      array( 'db' => 'codigo',       'dt' => 1 ),
      array( 'db' => 'nombre',   'dt' => 2 ),
      array(
        'db' => 'codigo', 
        'dt' => 3, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/carreras/modificar_formulario/{$row['codigo']}\">Modificar</a>";
        }
      ),
      array(
        'db' => 'codigo', 
        'dt' => 4, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/carreras/eliminar/{$row['codigo']}\">Eliminar</a>";
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
