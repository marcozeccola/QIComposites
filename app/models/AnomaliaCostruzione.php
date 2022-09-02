<?php
class AnomaliaCostruzione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO anomalie_costruzione (localizzazione, estensione ,profondita, presente,  fk_idIspezioneCostruzione, fk_idTipoAnomalia)
                             VALUES(:localizzazione, :estensione , :profondita, 1, :ispezione, :tipo )');
 
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
 

    public function getAnomaliaByIspezione($id){
        $this->db->query('SELECT anomalie_costruzione.*, anomalia,  ispezioni_costruzione.data AS data FROM anomalie_costruzione  
                            INNER JOIN ispezioni_costruzione ON idIspezioneCostruzione = fk_idIspezioneCostruzione
                            INNER JOIN tipi_anomalie ON idTipoAnomalia = fk_idTipoAnomalia
                            WHERE fk_idIspezioneCostruzione=:id ;');
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }

    public function risolvi($idAnomalia){
        $this->db->query('UPDATE anomalie_costruzione SET presente = 0 WHERE idAnomaliaCostruzione = :id;');
   
        $this->db->bind(':id', $idAnomalia); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    public function getAnomaliaByProgetto($id){
        $this->db->query('SELECT anomalie_costruzione.*, anomalia,  ispezioni_costruzione.data AS data FROM anomalie_costruzione  
                            INNER JOIN ispezioni_costruzione ON idIspezioneCostruzione = fk_idIspezioneCostruzione
                            INNER JOIN tipi_anomalie ON idTipoAnomalia = fk_idTipoAnomalia
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