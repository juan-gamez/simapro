<?php
class User extends CI_Model{

  function checkLogin($username, $password){

    $this->db->select('id, usuario, password');
    $this->db->from('usuarios');
    $this->db->where('usuario', $username);
    $this->db->where('password', md5($password));
    $this->db->limit(1);

    $query = $this->db->get();
    if($query->num_rows() == 1){
      return $query->result();
    }
    else{
      return false;
    }

  }
}
?>