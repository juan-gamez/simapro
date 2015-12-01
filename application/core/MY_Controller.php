<?php
class MY_Controller extends CI_Controller{
  function __construct(){
    parent::__construct();
  }
}

class LoggedInController extends MY_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('logged_in')){
      
    }
    else{
      header('Location: /login');
    }
  }
}
?>