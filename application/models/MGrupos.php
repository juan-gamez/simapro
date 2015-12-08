<?php
class MGrupos extends CI_Model{

  function save($numero, $asignatura_ciclo, $encargado, $tipo){
    if($this->db->insert('grupos', array(
      "numero" => $numero,
      "asignatura_ciclo" => $asignatura_ciclo,
      "encargado" => $encargado,
      "tipo" => $tipo
    ))){
      return $this->db->insert_id();
    }
    else{
      print_r($this->db->error());
      die();
      return false;
    }
  }
  
  function asociar_horario_aula($horario, $aula, $grupo){
    if($this->db->insert('grupo_horario_aula', array(
      "horario" => $horario,
      "aula" => $aula,
      "grupo" => $grupo
    ))){
      return $this->db->insert_id();
    }
    else{
      print_r($this->db->error());
      die();
      return false;
    }
  }
  function getGrupoHorariosAula($id){
    $this->db->select('id, horario_id, aula_id, tipo, numero, encargado, codigo, nombre');
    $this->db->from('v_grupo_horarios_aula');
    $this->db->where('aula_id', $id);
    $query = $this->db->get();
    print json_encode($query->result());
    die();
  }

  function getGrupoHorariosAulaporAsignatura($id){
    $this->db->select('id, horario_id, aula_id, grupo_id, tipo, numero, encargado, codigo, nombre');
    $this->db->from('v_grupo_horarios_aula');
    $this->db->group_by('grupo_id');
    $this->db->where('asignatura_ciclo', $id);
    $query = $this->db->get();
    print json_encode($query->result());
    die();
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

  function getAsignaturas(){
    $this->db->select('codigo, nombre');
    $this->db->from('v_asignaturas_del_ciclo');
    $query = $this->db->get();
    return $query->result_array();
  }

  function getAllGrupoHorariosAula(){
    $this->db->select('aula_id, aula_nombre, codigo, nombre, hora_inicio, hora_fin, dia_semana, tipo, numero');
    $this->db->from('v_grupo_horarios_aula');
    $query = $this->db->get();
    return $query->result_array();
  }

}
?>