<?php
class MPersonal extends CI_Model{

  function save($nombre, $correo){
    if($this->db->insert('personal', array(
      "nombre" => $nombre,
      "correo" => $correo
    ))){
      return true;
    }
    else{
      return false;
    }
  }
  
  function update($id, $nombre, $correo){
    $data = array(
      'nombre' => $nombre,
      'correo' => $correo
    );
    $this->db->where('id', $id);
    if(!$this->db->update('personal', $data)){
      return $this->db->error();
    }
    return $this->db->last_query();
    
  }

  function getOneById($id){
    $this->db->select('id, nombre, correo');
    $this->db->from('personal');
    $this->db->where('id', $id); 
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  function getPersonal(){
    $this->db->select('id, nombre, correo');
    $this->db->from('personal');
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>