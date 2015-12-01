<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends LoggedInController {
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('User','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    $data['header']['title'] = 'Inicio';
    $data['header']['username'] = $this->session->userdata('logged_in')['username'];
    $this->load->view('home', $data);
  }

  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('/');
  }

}
