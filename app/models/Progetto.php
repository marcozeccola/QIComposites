<?php
class Progetto {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO progetti (nome, inizio ,progettista)
                             VALUES(:nome, :inizio , :progettista )');
 
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':inizio', $data['inizio']);
        $this->db->bind(':progettista', $data['progettista']); 
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }

    public function getAllProgetti(){
          $this->db->query('SELECT * FROM progetti;');
   
        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }
 
    public function getProgettoById($id){
        $this->db->query('SELECT * FROM progetti WHERE idProgetto = :id;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->single();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }
 
}