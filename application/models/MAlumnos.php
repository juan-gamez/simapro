<?php
class MAlumnos extends CI_Model{

  function save($carnet, $nombres, $apellidos){
    if($this->db->insert('alumnos', array(
      "carnet" => $carnet,
      "apellidos" => $apellidos,
      "nombres" => $nombres
    ))){
      return true;
    }
    else{
      return $this->db->error();
    }
  }
  
  function update($carnet, $nombres, $apellidos){
    $data = array(
      'nombres' => $nombres,
      'apellidos' => $apellidos
    );
    $this->db->where('carnet', $carnet);
    if(!$this->db->update('alumnos', $data)){
      return $this->db->error();
    }
    return $this->db->last_query();
    
  }

  function getOneById($carnet){
    $this->db->select('carnet, nombres, apellidos');
    $this->db->from('alumnos');
    $this->db->where('carnet', $carnet); 
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }
}
?>