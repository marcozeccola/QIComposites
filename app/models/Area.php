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

    public function modifica($data){
        $this->db->query("UPDATE aree_riferimento 
                        SET area = :area
                        WHERE idAreaRiferimento = :id;");

        $this->db->bind(":area", $data["area"]);
        $this->db->bind(":id", $data["idArea"]); 

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    } 


     public function getAreaById($id){
          $this->db->query('SELECT * FROM aree_riferimento WHERE idAreaRiferimento = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->single();
 
          if( $result) {
               return $result;
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

    public function getIdProgettoByIdArea($id){

          $this->db->query('SELECT fk_idProgetto FROM aree_riferimento WHERE  idAreaRiferimento = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->single();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }
    
    public function getAreeByIspezioneCostruzione($id){
          $this->db->query('SELECT aree_riferimento.* FROM aree_riferimento 
                            INNER JOIN ispezioni_costruzione ON ispezioni_costruzione.fk_idProgetto = aree_riferimento .fk_idProgetto
                            WHERE idIspezioneCostruzione = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->resultSet();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }

    public function getAreaBySottoArea($id){
          $this->db->query('SELECT aree_riferimento.idAreaRiferimento FROM aree_riferimento 
                            INNER JOIN sotto_aree ON sotto_aree.fk_idAreaRiferimento = aree_riferimento.idAreaRiferimento
                            WHERE idSottoArea = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->single();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }
    
 
}