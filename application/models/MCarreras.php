<?php
class MCarreras extends CI_Model{

  function save($nombre, $escuela){
    if($this->db->insert('carreras', array(
      "nombre" => $nombre,
      "escuela" => $escuela
    ))){
      return true;
    }
    else{
      return false;
    }
  }
  
  function update($id, $nombre, $escuela){
    $data = array(
      'nombre' => $nombre,
      'escuela' => $escuela
    );
    $this->db->where('id', $id);
    if(!$this->db->update('carreras', $data)){
      return $this->db->error();
    }
    return $this->db->last_query();
    
  }

  function getOneById($id){
    $this->db->select('id, nombre, escuela');
    $this->db->from('carreras');
    $this->db->where('id', $id); 
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  function getFacultades(){
    $this->db->select('id, nombre');
    $this->db->from('facultades');
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>