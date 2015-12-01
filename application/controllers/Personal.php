<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MPersonal','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Personal';
    $this->load->view('personal', $data);
    /* Luego listar a que cargos pertenece cada usuario */
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Personal';
    $this->load->view('personal_formulario', $data);
  }

 function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('personal_nombre', 'nombre', 'trim|required|is_unique[personal.nombre]');
    $this->form_validation->set_rules('personal_correo', 'correo', 'trim|is_unique[personal.correo]|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un correo valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Personal';
      $this->load->view('personal_formulario', $data);
      return;
    }
    else{
      $id = $this->MPersonal->save($this->input->post('personal_nombre'), $this->input->post('personal_correo'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido agregado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue agregado';
      $data['header']['title'] = 'Agregar Personal';
      $this->load->view('personal', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $id = $this->uri->segment(3);
    if(is_numeric($id)){
      $row = $this->MPersonal->getOneById($id);
      $data['mod'] = array(
        'personal_id' => $row->id,
        'personal_nombre' => $row->nombre,
        'personal_correo' => $row->correo
      );
      $data['header']['title'] = 'Modificar Personal';
      $data['action'] = "/personal/modificar/{$id}";
      $this->load->view('personal_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('personal_nombre', 'nombre', 'trim|required');
    $this->form_validation->set_rules('personal_correo', 'correo', 'trim|valid_email');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('valid_email', 'El campo %s debe ser un correo valido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Personal';
      $data['action'] = "/personal/modificar/{$this->input->post('personal_id')}";
      $this->load->view('personal_formulario', $data);
      return;
    }
    else{
      $id = $this->MPersonal->update($this->input->post('personal_id'), $this->input->post('personal_nombre'), $this->input->post('personal_correo'));
      if($id==true)  $data['msg_ok']    = 'El usuario ha sido modificado';
      if($id==false) $data['msg_error'] = 'Error: El usuario no fue modificado';
      $data['header']['title'] = 'Personal';
      $this->load->view('personal', $data);
      return;
    }
  }

  function ajax()
  {
    $table = 'personal';
    $primaryKey = 'id';
    $columns = array(
      array( 'db' => 'id',       'dt' => 0 ),
      array( 'db' => 'nombre',   'dt' => 1 ),
      array( 'db' => 'correo',   'dt' => 2 ),
      array(
        'db' => 'id', 
        'dt' => 3, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/personal/modificar_formulario/{$row['id']}\">Modificar</a>";
        }
      ),
      array(
        'db' => 'id', 
        'dt' => 4, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/personal/eliminar/{$row['id']}\">Eliminar</a>";
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
