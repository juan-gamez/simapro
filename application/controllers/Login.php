<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('User','',TRUE);
  }

  function _check_database($password)
  {
    $username = $this->input->post('username');
    $result = $this->User->checkLogin($username, $password);

    if($result){
      $sess_array = array();
      foreach($result as $row){
        $sess_array = array(
          'id' => $row->id,
          'username' => $row->usuario
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    }
    else{
      $this->form_validation->set_message('_check_database', 'Credenciales invalidas');
      return FALSE;
    }
  }

  function check()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="validation-error"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
    $this->form_validation->set_rules('username', 'usuario', 'trim|required');
    $this->form_validation->set_rules('password', 'clave', 'trim|required|callback__check_database');
    $this->form_validation->set_message('required', 'El campo %s es requerido');

    if($this->form_validation->run() == FALSE){
      $this->load->view('login');
      return;
    }
    else{
      header('Location: /');
    }
  }

  function index()
  {
    $this->load->view('login');
  }

  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    header('Location: /');
  }

}
