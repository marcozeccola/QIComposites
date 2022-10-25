<?php
class IspezioneCostruzione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO ispezioni_costruzione (data, fine,  luogo, risultato , cliente,fk_idProgetto, operatori,  aree, sonde, reticoli )
                             VALUES(:data, :fine, :luogo, :risultato , :cliente,  :progetto, :operatori, :aree, :sonde, :reticoli )');
 
        $this->db->bind(':data', $data['data']);
        $this->db->bind(':fine', $data['fine']);
        $this->db->bind(':luogo', $data['luogo']);
        $this->db->bind(':risultato', $data['risultato']);
        $this->db->bind(':progetto', $data['progetto']); 
        $this->db->bind(':cliente', $data['cliente']); 
        $this->db->bind(':operatori', $data['operatori']); 
        $this->db->bind(':aree', $data['aree']);  
        $this->db->bind(':sonde', $data['sonde']); 
        $this->db->bind(':reticoli', $data['reticoli']); 
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }
 

    public function getIspezioniByProgetto($id){
        $this->db->query("SELECT ispezioni_costruzione.*,  
                              progetti.nome AS nomeProgetto
                         FROM ispezioni_costruzione  
                         INNER JOIN progetti ON ispezioni_costruzione.fk_idProgetto = idProgetto
                         WHERE ispezioni_costruzione.fk_idProgetto = :id
                         ORDER BY data;");
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }

    public function getIspezioniByOperatore($operatore, $oggi){
        $this->db->query("SELECT ispezioni_costruzione.*,  
                              progetti.nome AS nomeProgetto
                         FROM ispezioni_costruzione  
                         INNER JOIN progetti ON ispezioni_costruzione.fk_idProgetto = idProgetto
                         WHERE INSTR(operatori, :operatore)>0
                         AND inizio< :oggi
                         AND fine> :oggi;");
    
        $this->db->bind(':operatore', $operatore);
        $this->db->bind(':oggi', $oggi);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }


    public function modificaIspezione($ispezione){
        $this->db->query("UPDATE ispezioni_costruzione 
                        SET data = :data, fine = :fine, luogo = :luogo, cliente = :cliente, operatori = :operatori, reticoli = :reticoli, aree = :aree
                        WHERE idIspezioneCostruzione = :id");

        $this->db->bind(":data", $ispezione["data"]);
        $this->db->bind(":fine", $ispezione["fine"]);
        $this->db->bind(":luogo", $ispezione["luogo"]);
        $this->db->bind(":cliente", $ispezione["cliente"]);
        $this->db->bind(":operatori", $ispezione["operatori"]);
        $this->db->bind(":reticoli", $ispezione["reticoli"]);
        $this->db->bind(":aree", $ispezione["aree"]);
        $this->db->bind(":id", $ispezione["idIspezione"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function modificaIspezioneWithSonda($ispezione){
        $this->db->query("UPDATE ispezioni_costruzione 
                        SET data = :data, luogo = :luogo, cliente = :cliente, operatori = :operatori, reticoli = :reticoli, aree = :aree, sonde = :sonde
                        WHERE idIspezioneCostruzione = :id");

        $this->db->bind(":data", $ispezione["data"]);
        $this->db->bind(":luogo", $ispezione["luogo"]);
        $this->db->bind(":cliente", $ispezione["cliente"]);
        $this->db->bind(":operatori", $ispezione["operatori"]);
        $this->db->bind(":reticoli", $ispezione["reticoli"]);
        $this->db->bind(":sonde", $ispezione["sonde"]);
        $this->db->bind(":aree", $ispezione["aree"]);
        $this->db->bind(":id", $ispezione["idIspezione"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getIspezioneById($id){
        $this->db->query('SELECT ispezioni_costruzione.*,  
                              progetti.nome AS nomeProgetto
                         FROM ispezioni_costruzione  
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
        $this->db->query('UPDATE ispezioni_costruzione SET presente = 0 WHERE idAnomaliaCostruzione = :id;');
   
        $this->db->bind(':id', $idAnomalia); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

     
}