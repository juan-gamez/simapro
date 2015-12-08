<?php
class MAsignaturas extends CI_Model{

  function save($nombre, $escuela){
    if($this->db->insert('asignaturas', array(
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
    if(!$this->db->update('asignaturas', $data)){
      return $this->db->error();
    }
    return $this->db->last_query();
  }

  function getOneById($id){
    $this->db->select('id, nombre, escuela');
    $this->db->from('asignaturas');
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

  function getAsignaturas_ciclo(){
    $this->db->select('id, codigo, nombre');
    $this->db->from('v_asignaturas_del_ciclo');
    $this->db->order_by("codigo", "asc"); 
    $query = $this->db->get();
    return $query->result_array();
  }

  function nombre_dia_semana($dia_semana){
    switch($dia_semana){
      case 0:
        return "Lun";
      break;
      case 1:
        return "Mar";
      break;
      case 2:
        return "Mier";
      break;
      case 3:
        return "Jue";
      break;
      case 4:
        return "Vie"; 
      break;
      case 5:
        return "Sab";
      break;
      case 6:
        return "Dom";
      break;
    }
  }

}
?>