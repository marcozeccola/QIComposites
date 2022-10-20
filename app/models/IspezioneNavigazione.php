<?php
class IspezioneNavigazione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO ispezioni_navigazione (data, fine, luogo, dettagli, risultato ,cliente,fk_idProgetto, operatori,  aree, fk_idSonda, reticolo )
                             VALUES(:data, :fine, :luogo, :dettagli  , :risultato, :cliente , :progetto, :operatori, :aree, :sonda, :reticolo)');
 
        $this->db->bind(':data', $data['data']);
        $this->db->bind(':fine', $data['fine']);
        $this->db->bind(':luogo', $data['luogo']);
        $this->db->bind(':risultato', $data['risultato']);
        $this->db->bind(':progetto', $data['progetto']); 
        $this->db->bind(':cliente', $data['cliente']); 
        $this->db->bind(':operatori', $data['operatori']); 
        $this->db->bind(':aree', $data['aree']); 
        $this->db->bind(':sonda', $data['sonda']); 
        $this->db->bind(':reticolo', $data['reticolo']); 
        $this->db->bind(':dettagli', $data['dettagli']); 
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }
 

    public function getIspezioneById($id){
        $this->db->query('SELECT ispezioni_navigazione.*,  
                              progetti.nome AS nomeProgetto,
                              sonde.sonda AS sonda
                         FROM ispezioni_navigazione  
                         INNER JOIN progetti ON ispezioni_navigazione.fk_idProgetto = idProgetto
                         INNER JOIN sonde ON ispezioni_navigazione.fk_idSonda = idSonda
                          WHERE idIspezioneNavigazione = :id;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->single();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }

        public function modificaIspezione($ispezione){
        $this->db->query("UPDATE ispezioni_navigazione
                        SET data = :data, fine= :fine, luogo = :luogo, cliente = :cliente, operatori = :operatori, reticolo = :reticolo, aree = :aree, dettagli = :dettagli
                        WHERE idIspezioneNavigazione = :id");

        $this->db->bind(":data", $ispezione["data"]);
        $this->db->bind(":fine", $ispezione["fine"]);
        $this->db->bind(":luogo", $ispezione["luogo"]);
        $this->db->bind(":cliente", $ispezione["cliente"]);
        $this->db->bind(":operatori", $ispezione["operatori"]);
        $this->db->bind(":reticolo", $ispezione["reticolo"]);
        $this->db->bind(":aree", $ispezione["aree"]);
        $this->db->bind(":id", $ispezione["idIspezione"]);
        $this->db->bind(":dettagli", $ispezione["dettagli"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function modificaIspezioneWithSonda($ispezione){
        $this->db->query("UPDATE ispezioni_navigazione 
                        SET data = :data, luogo = :luogo, cliente = :cliente, operatori = :operatori, reticolo = :reticolo, aree = :aree, fk_idSonda = :sonda, dettagli = :dettagli
                        WHERE idIspezioneNavigazione = :id");

        $this->db->bind(":data", $ispezione["data"]);
        $this->db->bind(":luogo", $ispezione["luogo"]);
        $this->db->bind(":cliente", $ispezione["cliente"]);
        $this->db->bind(":operatori", $ispezione["operatori"]);
        $this->db->bind(":reticolo", $ispezione["reticolo"]);
        $this->db->bind(":sonda", $ispezione["sonda"]);
        $this->db->bind(":aree", $ispezione["aree"]);
        $this->db->bind(":dettagli", $ispezione["dettagli"]);
        $this->db->bind(":id", $ispezione["isIspezione"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getIspezioniByProgetto($id){
        $this->db->query("SELECT ispezioni_navigazione.*,  
                              progetti.nome AS nomeProgetto,
                              sonde.sonda AS sonda
                         FROM ispezioni_navigazione  
                         INNER JOIN progetti ON ispezioni_navigazione.fk_idProgetto = idProgetto
                         INNER JOIN sonde ON ispezioni_navigazione.fk_idSonda = idSonda
                         WHERE ispezioni_navigazione.fk_idProgetto = :id
                         ORDER BY data;");
   
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