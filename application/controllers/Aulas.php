<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aulas extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MAulas','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Aulas';
    $this->load->view('aulas', $data);
    /* Luego listar a que cargos pertenece cada usuario */
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Aulas';
    $this->load->view('aulas_formulario', $data);
  }

 function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('aulas_nombre', 'nombre', 'trim|required|is_unique[aulas.nombre]');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Aulas';
      $this->load->view('aulas_formulario', $data);
      return;
    }
    else{
      $id = $this->MAulas->save($this->input->post('aulas_nombre'));
      if($id==true)  $data['msg_ok']    = 'La facultad ha sido agregada';
      if($id==false) $data['msg_error'] = 'Error: La facultad no fue agregada';
      $data['header']['title'] = 'Agregar Aulas';
      $this->load->view('aulas', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $id = $this->uri->segment(3);
    if(is_numeric($id)){
      $row = $this->MAulas->getOneById($id);
      $data['mod'] = array(
        'aulas_id' => $row->id,
        'aulas_nombre' => $row->nombre
      );
      $data['header']['title'] = 'Modificar Aulas';
      $data['action'] = "/aulas/modificar/{$id}";
      $this->load->view('aulas_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('aulas_nombre', 'nombre', 'trim|required');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Aulas';
      $data['action'] = "/aulas/modificar/{$this->input->post('aulas_id')}";
      $this->load->view('aulas_formulario', $data);
      return;
    }
    else{
      $id = $this->MAulas->update($this->input->post('aulas_id'), $this->input->post('aulas_nombre'));
      if($id==true)  $data['msg_ok']    = 'La facultad ha sido modificado';
      if($id==false) $data['msg_error'] = 'Error: La facultad no fue modificado';
      $data['header']['title'] = 'Aulas';
      $this->load->view('aulas', $data);
      return;
    }
  }

  function ajax()
  {
    $table = 'aulas';
    $primaryKey = 'id';
    $columns = array(
      array( 'db' => 'id',       'dt' => 0 ),
      array( 'db' => 'nombre',   'dt' => 1 ),
      array(
        'db' => 'id', 
        'dt' => 2, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/aulas/modificar/{$row['id']}\">Modificar</a>";
        }
      ),
      array(
        'db' => 'id', 
        'dt' => 3, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/aulas/eliminar/{$row['id']}\">Eliminar</a>";
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
