<?php
class My404 extends CI_Controller{
  public function __construct() 
  {
    parent::__construct(); 
  } 

  public function index() 
  { 
    $this->output->set_status_header('404'); 
    $data['header']['title'] = 'Inicio';
    $data['header']['username'] = "";
    $this->load->view('error_404', $data);//loading in my template 
  } 
}

?>
