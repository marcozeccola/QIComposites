<?php
class IspezioneCostruzione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO ispezioni_costruzione (data, luogo, risultato , cliente,fk_idProgetto, fk_idOperatore,  fk_idAreaRiferimento )
                             VALUES(:data, :luogo, :risultato , :cliente,  :progetto, :operatore, :area )');
 
        $this->db->bind(':data', $data['data']);
        $this->db->bind(':luogo', $data['luogo']);
        $this->db->bind(':risultato', $data['risultato']);
        $this->db->bind(':progetto', $data['progetto']); 
        $this->db->bind(':cliente', $data['cliente']); 
        $this->db->bind(':operatore', $data['operatore']); 
        $this->db->bind(':area', $data['area']);  
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }
 

    public function getIspezioniByProgetto($id){
        $this->db->query("SELECT ispezioni_costruzione.*,
                              operatori.nome AS nomeOperatore,
                              operatori.cognome AS cognomeOperatore, 
                              aree_riferimento.area AS area,
                              progetti.nome AS nomeProgetto
                         FROM ispezioni_costruzione
                         INNER JOIN operatori ON fk_idOperatore = idOperatore
                         INNER JOIN aree_riferimento ON fk_idAreaRiferimento = idAreaRiferimento 
                         INNER JOIN progetti ON ispezioni_costruzione.fk_idProgetto = idProgetto
                         WHERE ispezioni_costruzione.fk_idProgetto = :id;");
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }

    public function getIspezioneById($id){
        $this->db->query('SELECT ispezioni_costruzione.*,
                              operatori.nome AS nomeOperatore,
                              operatori.cognome AS cognomeOperatore, 
                              aree_riferimento.area AS area,
                              progetti.nome AS nomeProgetto
                         FROM ispezioni_costruzione
                         INNER JOIN operatori ON fk_idOperatore = idOperatore
                         INNER JOIN aree_riferimento ON fk_idAreaRiferimento = idAreaRiferimento 
                         INNER JOIN progetti ON ispezioni_costruzione.fk_idProgetto = idProgetto
                          WHERE idIspezioneCostruzione = :id;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->single();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function risolvi($idAnomalia){
        $this->db->query('UPDATE anomalie_navigazione SET presente = 0 WHERE idAnomaliaNavigazione = :id;');
   
        $this->db->bind(':id', $idAnomalia); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

     
}