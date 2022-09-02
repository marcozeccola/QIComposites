<?php
class Componente {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO componenti (nome, fk_idProgetto)
                             VALUES(:nome, :idProgetto )');
 
        $this->db->bind(':nome', $data['nome']);  
        $this->db->bind(':idProgetto', $data['idProgetto']);  
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }

    public function getComponentiByProgetto($id){
          $this->db->query('SELECT * FROM componenti WHERE fk_idProgetto = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->resultSet();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }
 
}