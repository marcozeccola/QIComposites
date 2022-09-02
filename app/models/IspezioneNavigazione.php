<?php
class IspezioneNavigazione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO ispezioni_navigazione (data, luogo, dettagli, risultato ,cliente,fk_idProgetto, fk_idOperatore,  fk_idAreaRiferimento)
                             VALUES(:data, :luogo, :dettagli  , :risultato, :cliente , :progetto, :operatore, :area)');
 
        $this->db->bind(':data', $data['data']);
        $this->db->bind(':luogo', $data['luogo']);
        $this->db->bind(':risultato', $data['risultato']);
        $this->db->bind(':progetto', $data['progetto']); 
        $this->db->bind(':cliente', $data['cliente']); 
        $this->db->bind(':operatore', $data['operatore']); 
        $this->db->bind(':area', $data['area']); 
        $this->db->bind(':dettagli', $data['dettagli']); 
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }
 

    public function getIspezioneById($id){
        $this->db->query('SELECT ispezioni_navigazione.*,
                              operatori.nome AS nomeOperatore,
                              operatori.cognome AS cognomeOperatore, 
                              aree_riferimento.area AS area,
                              progetti.nome AS nomeProgetto
                         FROM ispezioni_navigazione
                         INNER JOIN operatori ON fk_idOperatore = idOperatore
                         INNER JOIN aree_riferimento ON fk_idAreaRiferimento = idAreaRiferimento 
                         INNER JOIN progetti ON ispezioni_navigazione.fk_idProgetto = idProgetto
                          WHERE idIspezioneNavigazione = :id;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->single();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getIspezioniByProgetto($id){
        $this->db->query("SELECT ispezioni_navigazione.*,
                              operatori.nome AS nomeOperatore,
                              operatori.cognome AS cognomeOperatore, 
                              aree_riferimento.area AS area,
                              progetti.nome AS nomeProgetto
                         FROM ispezioni_navigazione
                         INNER JOIN operatori ON fk_idOperatore = idOperatore
                         INNER JOIN aree_riferimento ON fk_idAreaRiferimento = idAreaRiferimento 
                         INNER JOIN progetti ON ispezioni_navigazione.fk_idProgetto = idProgetto
                         WHERE ispezioni_navigazione.fk_idProgetto = :id;");
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
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