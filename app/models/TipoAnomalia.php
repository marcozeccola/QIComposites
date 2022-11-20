<?php
class TipoAnomalia {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($anomalia) {
        $this->db->query('INSERT INTO tipi_anomalie (anomalia)
                             VALUES(:anomalia )');
 
        $this->db->bind(':anomalia', $anomalia);  
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }

    public function getAllTipiAnomalie(){
          $this->db->query('SELECT * FROM tipi_anomalie;');
   
          $result = $this->db->resultSet();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }
    
    
          
    public function deleteTipoAnomaliaById($id){
        $this->db->query("DELETE FROM tipi_anomalie WHERE idTipoAnomalia = :id");
        $this->db->bind(':id', $id); 
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
 
}