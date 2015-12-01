<?php
class MEscuelas extends CI_Model{

  function save($nombre, $facultad){
    if($this->db->insert('escuelas', array(
      "nombre" => $nombre,
      "facultad" => $facultad
    ))){
      return true;
    }
    else{
      return false;
    }
  }
  
  function update($id, $nombre, $facultad){
    $data = array(
      'nombre' => $nombre,
      'facultad' => $facultad
    );
    $this->db->where('id', $id);
    if(!$this->db->update('escuelas', $data)){
      return $this->db->error();
    }
    return $this->db->last_query();
    
  }

  function getOneById($id){
    $this->db->select('id, nombre, facultad');
    $this->db->from('escuelas');
    $this->db->where('id', $id); 
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  function getEscuelas(){
    $this->db->select('id, nombre');
    $this->db->from('escuelas');
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>