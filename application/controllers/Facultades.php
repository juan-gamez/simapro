<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facultades extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MFacultades','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Facultades';
    $this->load->view('facultades', $data);
    /* Luego listar a que cargos pertenece cada usuario */
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Facultades';
    $this->load->view('facultades_formulario', $data);
  }

 function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('facultades_nombre', 'nombre', 'trim|required|is_unique[facultades.nombre]');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Facultades';
      $this->load->view('facultades_formulario', $data);
      return;
    }
    else{
      $id = $this->MFacultades->save($this->input->post('facultades_nombre'));
      if($id==true)  $data['msg_ok']    = 'La facultad ha sido agregada';
      if($id==false) $data['msg_error'] = 'Error: La facultad no fue agregada';
      $data['header']['title'] = 'Agregar Facultades';
      $this->load->view('facultades', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $id = $this->uri->segment(3);
    if(is_numeric($id)){
      $row = $this->MFacultades->getOneById($id);
      $data['mod'] = array(
        'facultades_id' => $row->id,
        'facultades_nombre' => $row->nombre
      );
      $data['header']['title'] = 'Modificar Facultades';
      $data['action'] = "/facultades/modificar/{$id}";
      $this->load->view('facultades_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('facultades_nombre', 'nombre', 'trim|required');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Facultades';
      $data['action'] = "/facultades/modificar/{$this->input->post('facultades_id')}";
      $this->load->view('facultades_formulario', $data);
      return;
    }
    else{
      $id = $this->MFacultades->update($this->input->post('facultades_id'), $this->input->post('facultades_nombre'));
      if($id==true)  $data['msg_ok']    = 'La facultad ha sido modificado';
      if($id==false) $data['msg_error'] = 'Error: La facultad no fue modificado';
      $data['header']['title'] = 'Facultades';
      $this->load->view('facultades', $data);
      return;
    }
  }

  function ajax()
  {
    $table = 'facultades';
    $primaryKey = 'id';
    $columns = array(
      array( 'db' => 'id',       'dt' => 0 ),
      array( 'db' => 'nombre',   'dt' => 1 ),
      array(
        'db' => 'id', 
        'dt' => 2, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/facultades/modificar_formulario/{$row['id']}\">Modificar</a>";
        }
      ),
      array(
        'db' => 'id', 
        'dt' => 3, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/facultades/eliminar/{$row['id']}\">Eliminar</a>";
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
