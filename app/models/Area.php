<?php
class Area {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO aree_riferimento (area, fk_idProgetto)
                             VALUES(:area, :idProgetto )');
 
        $this->db->bind(':area', $data['area']);  
        $this->db->bind(':idProgetto', $data['idProgetto']);  
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }

    public function getAreeByProgetto($id){
          $this->db->query('SELECT * FROM aree_riferimento WHERE fk_idProgetto = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->resultSet();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }
 
}