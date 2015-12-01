<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('MAlumnos','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Alumnos';
    $this->load->view('alumnos', $data);
    /* Luego listar a que cargos pertenece cada usuario */
  }

  function formulario_agregar()
  {
    $data['header']['title'] = 'Agregar Alumnos';
    $this->load->view('alumnos_formulario', $data);
  }

 function agregar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('alumnos_carnet', 'carnet', 'trim|required|regex_match[/[A-Za-z]{2}[0-9]{5}/]');
    $this->form_validation->set_rules('alumnos_nombres', 'nombres', 'trim|required');
    $this->form_validation->set_rules('alumnos_apellidos', 'apellidos', 'trim|required');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    $this->form_validation->set_message('is_unique', 'El campo %s debe ser unico');
    $this->form_validation->set_message('regex_match', 'El campo %s debe tener el formato apropiado');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Agregar Alumnos';
      $this->load->view('alumnos_formulario', $data);
      return;
    }
    else{
      $id = $this->MAlumnos->save(
        $this->input->post('alumnos_carnet'), 
        $this->input->post('alumnos_nombres'), 
        $this->input->post('alumnos_apellidos')
      );
      if(!is_array($id)) $data['msg_ok'] = 'El usuario ha sido agregado';
      if(is_array($id)){
        $data['msg_error'] = 'Error: El usuario no fue agregado.';
        if($id['code']==1062) $data['msg_error'] .= "<br>El carnet ya esta es uso";
        $data['header']['title'] = 'Agregar Alumnos';
        $this->load->view('alumnos_formulario', $data);
        return;
      }        
      $data['header']['title'] = 'Agregar Alumnos';
      $this->load->view('alumnos', $data);
      return;
    }
  }
  
  function modificar_formulario()
  {
    $carnet = $this->uri->segment(3);
    if(isset($carnet)){
      $row = $this->MAlumnos->getOneById($carnet);
      $data['mod'] = array(
        'alumnos_carnet' => $row->carnet,
        'alumnos_nombres' => $row->nombres,
        'alumnos_apellidos' => $row->apellidos
      );
      $data['header']['title'] = 'Modificar Alumnos';
      $data['action'] = "/alumnos/modificar/{$carnet}";
      $this->load->view('alumnos_formulario', $data);
      return;
    }
  }

  function modificar()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('alumnos_nombres', 'nombre', 'trim|required');
    $this->form_validation->set_rules('alumnos_apellidos', 'apellidos', 'trim|required');
    $this->form_validation->set_message('required', 'El campo %s es requerido');
    
    if($this->form_validation->run() == FALSE){
      $data['header']['title'] = 'Modificar Alumnos';
      $data['action'] = "/alumnos/modificar/{$this->input->post('alumnos_carnet')}";
      $this->load->view('alumnos_formulario', $data);
      return;
    }
    else{
      $id = $this->MAlumnos->update($this->input->post('alumnos_carnet'), $this->input->post('alumnos_nombres'), $this->input->post('alumnos_apellidos'));
      if(!is_array($id)) $data['msg_ok'] = 'El usuario ha sido modificado';
      if(is_array($id)){
        $data['msg_error'] = 'Error: El usuario no fue modificado.';
        if($id['code']==1062) $data['msg_error'] .= "<br>El carnet ya esta es uso";
      }        
      $data['header']['title'] = 'Alumnos';
      $this->load->view('alumnos', $data);
      return;
    }
  }

  function ajax()
  {
    $table = 'alumnos';
    $primaryKey = 'carnet';
    $columns = array(
      array( 'db' => 'carnet',   'dt' => 0 ),
      array( 'db' => 'apellidos',   'dt' => 1 ),
      array( 'db' => 'nombres',   'dt' => 2 ),
      array(
        'db' => 'carnet', 
        'dt' => 3, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/alumnos/modificar_formulario/{$row['carnet']}\">Modificar</a>";
        }
      ),
      array(
        'db' => 'carnet', 
        'dt' => 4, 
        'formatter' => function( $d, $row ) {
          return "<a href=\"/alumnos/eliminar/{$row['carnet']}\">Eliminar</a>";
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
