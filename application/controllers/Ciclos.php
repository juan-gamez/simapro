<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciclos extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MCiclos','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Ciclos';
    $this->load->view('ciclos', $data);
    /* Luego listar a que cargos pertenece cada usuario */
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Ciclos';
    $this->load->view('ciclos_formulario', $data);
  }

 function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('ciclos_nombre', 'nombre', 'trim|required|is_unique[ciclos.nombre]');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Ciclos';
      $this->load->view('ciclos_formulario', $data);
      return;
    }
    else{
      $id = $this->MCiclos->save($this->input->post('ciclos_nombre'));
      if($id==true)  $data['msg_ok']    = 'La facultad ha sido agregada';
      if($id==false) $data['msg_error'] = 'Error: La facultad no fue agregada';
      $data['header']['title'] = 'Agregar Ciclos';
      $this->load->view('ciclos', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $id = $this->uri->segment(3);
    if(is_numeric($id)){
      $row = $this->MCiclos->getOneById($id);
      $data['mod'] = array(
        'ciclos_id' => $row->id,
        'ciclos_nombre' => $row->nombre
      );
      $data['header']['title'] = 'Modificar Ciclos';
      $data['action'] = "/ciclos/modificar/{$id}";
      $this->load->view('ciclos_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('ciclos_nombre', 'nombre', 'trim|required');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Ciclos';
      $data['action'] = "/ciclos/modificar/{$this->input->post('ciclos_id')}";
      $this->load->view('ciclos_formulario', $data);
      return;
    }
    else{
      $id = $this->MCiclos->update($this->input->post('ciclos_id'), $this->input->post('ciclos_nombre'));
      if($id==true)  $data['msg_ok']    = 'La facultad ha sido modificado';
      if($id==false) $data['msg_error'] = 'Error: La facultad no fue modificado';
      $data['header']['title'] = 'Ciclos';
      $this->load->view('ciclos', $data);
      return;
    }
  }

  function ajax()
  {
    $table = 'ciclos';
    $primaryKey = 'id';
    $columns = array(
      array( 'db' => 'id',       'dt' => 0 ),
      array( 'db' => 'nombre',   'dt' => 1 ),
      array( 'db' => 'fecha_inicio',   'dt' => 2 ),
      array( 'db' => 'fecha_fin',   'dt' => 3 ),
      array( 'db' => 'paridad',   'dt' => 4 ),
      array( 
        'db' => 'activo',   
        'dt' => 5, 
        'formatter' => function( $d, $row ) {
          return $d==1 ? "Si" : "No";
        }),
      array(
        'db' => 'id', 
        'dt' => 6, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/ciclos/modificar_formulario/{$row['id']}\">Modificar</a>";
        }),
      array(
        'db' => 'id', 
        'dt' => 7, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/ciclos/eliminar/{$row['id']}\">Eliminar</a>";
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
