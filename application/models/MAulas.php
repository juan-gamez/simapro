<?php
class MAulas extends CI_Model{

  function save($nombre){
    if($this->db->insert('aulas', array(
      "nombre" => $nombre
    ))){
      return true;
    }
    else{
      return false;
    }
  }
  
  function update($id, $nombre){
    $data = array(
      'nombre' => $nombre
    );
    $this->db->where('id', $id);
    if(!$this->db->update('aulas', $data)){
      return $this->db->error();
    }
    return $this->db->last_query();
    
  }

  function getOneById($id){
    $this->db->select('id, nombre');
    $this->db->from('aulas');
    $this->db->where('id', $id); 
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }

  function getAulas(){
    $this->db->select('id, nombre');
    $this->db->from('aulas');
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>