<?php
class AnomaliaCostruzione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO anomalie_costruzione (
                            localizzazione, 
                            estensione,
                            profondita, 
                            presente,  
                            commenti, 
                            fk_idIspezioneCostruzione, 
                            anomalia)
                             VALUES(:localizzazione, 
                             :estensione , 
                             :profondita, 
                             1, 
                             :commenti, 
                             :ispezione, 
                             :tipo )');
 
        $this->db->bind(':localizzazione', $data['localizzazione']);
        $this->db->bind(':estensione', $data['estensione']);
        $this->db->bind(':profondita', $data['profondita']); 
        $this->db->bind(':commenti', $data['commenti']); 
        $this->db->bind(':ispezione', $data['ispezione']); 
        $this->db->bind(':tipo', $data['tipo']); 
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }
 

    public function getAnomaliaByIspezione($id){
        $this->db->query('SELECT anomalie_costruzione.*, anomalia,  ispezioni_costruzione.data AS data FROM anomalie_costruzione  
                            INNER JOIN ispezioni_costruzione ON idIspezioneCostruzione = fk_idIspezioneCostruzione
                            WHERE fk_idIspezioneCostruzione=:id ;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }

    public function getAnomaliaById($id){
        $this->db->query('SELECT anomalie_costruzione.*, 
                                 progetti.idProgetto AS idProgetto, 
                                 progetti.nome AS nomeProgetto, 
                                 ispezioni_costruzione.idIspezioneCostruzione  AS idIspezione
                            FROM anomalie_costruzione
                            INNER JOIN ispezioni_costruzione ON idIspezioneCostruzione = fk_idIspezioneCostruzione
                            INNER JOIN progetti ON progetti.idProgetto = ispezioni_costruzione.fk_idProgetto
                            WHERE idAnomaliaCostruzione=:id ;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->single();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }

    public function getAnomalieByTipo($id){
        $this->db->query('SELECT count(*) AS num FROM anomalie_costruzione
                            INNER JOIN tipi_anomalie ON anomalie_costruzione.anomalia = tipi_anomalie.anomalia
                            WHERE idTipoAnomalia = :id
                            ;');
   
   
        $this->db->bind(':id', $id);

        $result = $this->db->single();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }

    public function modificaAnomalia($anomalia){ 
        $this->db->query("UPDATE anomalie_costruzione 
                        SET localizzazione = :loc, 
                        estensione = :est, 
                        profondita = :prof,
                        commenti = :commenti, 
                        riparazione = :riparazione
                        WHERE idAnomaliaCostruzione = :id");

        $this->db->bind(":loc", $anomalia["localizzazione"]);
        $this->db->bind(":est", $anomalia["estensione"]);
        $this->db->bind(":prof", $anomalia["profondita"]);
        $this->db->bind(":id", $anomalia["idAnomalia"]);
        $this->db->bind(":commenti", $anomalia["commenti"]); 
        $this->db->bind(":riparazione", $anomalia["riparazione"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function modificaAnomaliaWithTipo($anomalia){
        $this->db->query("UPDATE anomalie_costruzione 
                        SET 
                            localizzazione = :loc, 
                            estensione = :est, 
                            profondita = :prof, 
                            anomalia = :tipo,
                            commenti = :commenti, 
                            riparazione = :riparazione
                        WHERE idAnomaliaCostruzione = :id");

        $this->db->bind(":loc", $anomalia["localizzazione"]);
        $this->db->bind(":est", $anomalia["estensione"]);
        $this->db->bind(":prof", $anomalia["profondita"]);
        $this->db->bind(":id", $anomalia["idAnomalia"]);
        $this->db->bind(":tipo", $anomalia["tipo"]);
        $this->db->bind(":riparazione", $anomalia["riparazione"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        } 
    }

    public function risolvi($idAnomalia, $commento){
        $this->db->query('UPDATE anomalie_costruzione 
                            SET presente = 0 ,
                                riparazione = :riparazione
                            WHERE idAnomaliaCostruzione = :id;');
   
        $this->db->bind(':id', $idAnomalia); 
        $this->db->bind(':riparazione', $commento); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    public function getAnomaliaByProgetto($id){
        $this->db->query('SELECT anomalie_costruzione.*, anomalia,  ispezioni_costruzione.data AS data FROM anomalie_costruzione  
                            INNER JOIN ispezioni_costruzione ON idIspezioneCostruzione = fk_idIspezioneCostruzione 
                            WHERE ispezioni_costruzione.fk_idProgetto = :id AND anomalie_costruzione.presente = 1;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }
}