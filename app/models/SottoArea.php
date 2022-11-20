<?php
class SottoArea {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO sotto_aree (nome, fk_idAreaRiferimento)
                             VALUES(:nome, :fk_idAreaRiferimento )');
 
        $this->db->bind(':nome', $data['sottoAreaInput']);  
        $this->db->bind(':fk_idAreaRiferimento', $data['fk_idAreaRiferimento']);  
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }

     public function modifica($data){
        $this->db->query("UPDATE sotto_aree 
                        SET nome = :nome
                        WHERE idSottoArea = :id;");

        $this->db->bind(":nome", $data["sottoArea"]);
        $this->db->bind(":id", $data["id"]); 

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    } 


    public function getSottoAreaById($id){
          $this->db->query('SELECT * FROM sotto_aree WHERE idSottoArea = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->single();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
     }

    public function getSottoAreeByArea($id){
          $this->db->query('SELECT * FROM sotto_aree 
                              WHERE fk_idAreaRiferimento = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->resultSet();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }
    public function getSottoAreeByProgetto($id){
          $this->db->query('SELECT * FROM sotto_aree 
                              INNER JOIN aree_riferimento ON aree_riferimento.idAreaRiferimento = fk_idAreaRiferimento
                              WHERE aree_riferimento.fk_idProgetto = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->resultSet();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }
    
    
    public function getSottoAreeByIspezioneCostruzione($id){
          $this->db->query('SELECT  sotto_aree.* FROM sotto_aree 
                            INNER JOIN aree_riferimento ON aree_riferimento.idAreaRiferimento = fk_idAreaRiferimento
                            INNER JOIN ispezioni_costruzione ON ispezioni_costruzione.fk_idProgetto = aree_riferimento .fk_idProgetto
                            WHERE ispezioni_costruzione.idIspezioneCostruzione = :id;');
   
          $this->db->bind(':id', $id);  
          $result = $this->db->resultSet();
 
          if( $result) {
               return $result;
          } else {
               return false;
          }
    }

}