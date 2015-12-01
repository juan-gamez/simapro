<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Escuelas extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MFacultades','',TRUE);
    $this->load->model('MPersonal','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Escuelas';
    $this->load->view('escuelas', $data);
    /* Luego listar a que cargos pertenece cada usuario */
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Escuelas';
    $data['facultades'] = $this->MEscuelas->getFacultades();
    $data['personal'] = $this->MPersonal->getPersonal();
    $this->load->view('escuelas_formulario', $data);
  }

 function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('escuelas_nombre', 'nombre', 'trim|required|is_unique[escuelas.nombre]');
    $this->form_validation->set_rules('escuelas_facultad', 'facultad', 'trim|is_unique[escuelas.facultad]|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un facultad valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Escuelas';
      $this->load->view('escuelas_formulario', $data);
      return;
    }
    else{
      $id = $this->MEscuelas->save($this->input->post('escuelas_nombre'), $this->input->post('escuelas_facultad'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido agregado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue agregado';
      $data['header']['title'] = 'Agregar Escuelas';
      $data['facultades'] = $this->MEscuelas->getFacultades();
      $this->load->view('escuelas', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $id = $this->uri->segment(3);
    if(is_numeric($id)){
      $row = $this->MEscuelas->getOneById($id);
      $data['mod'] = array(
        'escuelas_id' => $row->id,
        'escuelas_nombre' => $row->nombre,
        'escuelas_facultad' => $row->facultad
      );
      $data['header']['title'] = 'Modificar Escuelas';
      $data['action'] = "/escuelas/modificar/{$id}";
      $this->load->view('escuelas_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('escuelas_nombre', 'nombre', 'trim|required');
    $this->form_validation->set_rules('escuelas_facultad', 'facultad', 'trim|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un facultad valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Escuelas';
      $data['action'] = "/escuelas/modificar/{$this->input->post('escuelas_id')}";
      $this->load->view('escuelas_formulario', $data);
      return;
    }
    else{
      $id = $this->MFacultades->update($this->input->post('escuelas_id'), $this->input->post('escuelas_nombre'), $this->input->post('escuelas_facultad'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido modificado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue modificado';
      $data['header']['title'] = 'Escuelas';
      $this->load->view('escuelas', $data);
      return;
    }
  }

  function ajax()
  {
    $table = 'v_escuelas';
    $primaryKey = 'id';
    $columns = array(
      array( 'db' => 'id',       'dt' => 0 ),
      array( 'db' => 'nombre',   'dt' => 1 ),
      array( 'db' => 'facultad',   'dt' => 2 ),
      array( 'db' => 'director',   'dt' => 3 ),
      array(
        'db' => 'id', 
        'dt' => 4, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/escuelas/modificar_formulario/{$row['id']}\">Modificar</a>";
        }
      ),
      array(
        'db' => 'id', 
        'dt' => 5, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/escuelas/eliminar/{$row['id']}\">Eliminar</a>";
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
