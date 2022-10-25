<?php
class AnomaliaNavigazione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO anomalie_navigazione (causa, localizzazione, estensione ,profondita, presente,  fk_idIspezioneNavigazione, anomalia)
                             VALUES(:causa,:localizzazione, :estensione , :profondita, 1, :ispezione, :tipo )');
 
        $this->db->bind(':causa', $data['causa']);
        $this->db->bind(':localizzazione', $data['localizzazione']);
        $this->db->bind(':estensione', $data['estensione']);
        $this->db->bind(':profondita', $data['profondita']); 
        $this->db->bind(':ispezione', $data['ispezione']); 
        $this->db->bind(':tipo', $data['tipo']); 
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }
 

    public function getAnomaliaById($id){
        $this->db->query('SELECT anomalie_navigazione.*
                            FROM anomalie_navigazione 
                            WHERE idAnomaliaNavigazione=:id ;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->single();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }

    public function modificaAnomalia($anomalia){
        $this->db->query("UPDATE anomalie_navigazione 
                        SET localizzazione = :loc, estensione = :est, profondita = :prof, causa = :causa
                        WHERE idAnomaliaNavigazione = :id");

        $this->db->bind(":loc", $anomalia["localizzazione"]);
        $this->db->bind(":est", $anomalia["estensione"]);
        $this->db->bind(":prof", $anomalia["profondita"]);
        $this->db->bind(":id", $anomalia["idAnomalia"]);
        $this->db->bind(":causa", $anomalia["causa"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function modificaAnomaliaWithTipo($anomalia){
        $this->db->query("UPDATE anomalie_navigazione 
                        SET localizzazione = :loc, estensione = :est, profondita = :prof, anomalia = :tipo, causa = :causa
                        WHERE idAnomaliaNavigazione = :id");

        $this->db->bind(":loc", $anomalia["localizzazione"]);
        $this->db->bind(":est", $anomalia["estensione"]);
        $this->db->bind(":prof", $anomalia["profondita"]);
        $this->db->bind(":causa", $anomalia["causa"]);
        $this->db->bind(":id", $anomalia["idAnomalia"]);
        $this->db->bind(":tipo", $anomalia["tipo"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        } 
    }

    public function getAnomaliaByIspezione($id){
        $this->db->query('SELECT anomalie_navigazione.*, anomalia , ispezioni_navigazione.data AS data FROM anomalie_navigazione  
                            INNER JOIN ispezioni_navigazione ON idIspezioneNavigazione = fk_idIspezioneNavigazione 
                             WHERE fk_idIspezioneNavigazione = :id;');
   
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

    public function getAnomaliaByProgetto($id){
        $this->db->query('SELECT anomalie_navigazione.*, anomalia ,  ispezioni_navigazione.data AS data FROM anomalie_navigazione  
                            INNER JOIN ispezioni_navigazione ON idIspezioneNavigazione = fk_idIspezioneNavigazione 
                            WHERE ispezioni_navigazione.fk_idProgetto = :id AND anomalie_navigazione.presente = 1;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        }
    }
}