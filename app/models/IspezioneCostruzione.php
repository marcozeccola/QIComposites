<?php
class IspezioneCostruzione {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function inserisci($data) {
        $this->db->query('INSERT INTO ispezioni_costruzione (
                            data, 
                            idCustom,
                            luogo, 
                            cliente,
                            fk_idProgetto, 
                            operatori,  
                            fk_idAreaRiferimento, 
                            fk_idSottoArea, 
                            nomeArea,
                            sonde, 
                            reticoli,
                            stato,
                            obiettivo )
                        VALUES(
                            :data,  
                            :idCustom, 
                            :luogo, 
                            :cliente,  
                            :progetto, 
                            :operatori, 
                            :fk_idAreaRiferimento, 
                            :fk_idSottoArea, 
                            :nomeArea,
                            :sonde, 
                            :reticoli,
                            :stato,
                            :obiettivo )
                ');
 
        $this->db->bind(':data', $data['data']); 
        $this->db->bind(":idCustom", $data["idCustom"]); 
        $this->db->bind(':luogo', $data['luogo']);
        $this->db->bind(':progetto', $data['progetto']);   
        $this->db->bind(':cliente', $data['cliente']); 
        $this->db->bind(':operatori', $data['operatori']); 
        $this->db->bind(':fk_idAreaRiferimento', $data['fk_idAreaRiferimento']);  
        $this->db->bind(':fk_idSottoArea', $data['fk_idSottoArea']);
        $this->db->bind(':nomeArea', $data['nomeArea']);
        $this->db->bind(':sonde', $data['sonde']); 
        $this->db->bind(':reticoli', $data['reticoli']); 
        $this->db->bind(':obiettivo', $data['obiettivo']); 
        $this->db->bind(':stato', $data['stato']); 
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }
 

    public function getIspezioniByProgetto($id){
        $this->db->query("SELECT ispezioni_costruzione.*,  
                              progetti.nome AS nomeProgetto,
                              aree_riferimento.area AS macroArea, 
                              sotto_aree.nome AS sottoArea
                         FROM ispezioni_costruzione  
                         INNER JOIN progetti ON ispezioni_costruzione.fk_idProgetto = idProgetto
                         INNER JOIN aree_riferimento ON aree_riferimento.idAreaRiferimento = fk_idAreaRiferimento
                         INNER JOIN sotto_aree ON sotto_aree.idSottoArea = fk_idSottoArea
                         WHERE ispezioni_costruzione.fk_idProgetto = :id
                         ORDER BY data DESC;");
   
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }
    

    public function getIspezioniBySonda($sonda){
        $this->db->query("SELECT count(*) as num
                         FROM ispezioni_costruzione  
                         WHERE INSTR(sonde, :sonda)>0 ;");
    
        $this->db->bind(':sonda', $sonda); 

        $result = $this->db->resultSet();
 
        if( $result) {
            return $result;
        } else {
            return false;
        } 
    }

    public function getIspezioniByOperatore($operatore, $oggi){
        $this->db->query("SELECT ispezioni_costruzione.*,  
                              progetti.nome AS nomeProgetto,
                              aree_riferimento.area AS macroArea, 
                              sotto_aree.nome AS sottoArea
                         FROM ispezioni_costruzione  
                         INNER JOIN progetti ON ispezioni_costruzione.fk_idProgetto = idProgetto
                         INNER JOIN aree_riferimento ON aree_riferimento.idAreaRiferimento = fk_idAreaRiferimento
                         INNER JOIN sotto_aree ON sotto_aree.idSottoArea = fk_idSottoArea
                         WHERE INSTR(operatori, :operatore)>0
                         AND inizio = :oggi ;");
    
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
                        SET data = :data, 
                            idCustom = :idCustom,
                            luogo = :luogo, 
                            cliente = :cliente, 
                            operatori = :operatori, 
                            reticoli = :reticoli, 
                            sonde = :sonde,
                            fk_idAreaRiferimento = :fk_idAreaRiferimento,
                            fk_idSottoArea = :fk_idSottoArea,
                            nomeArea = :nomeArea,
                            stato = :stato,
                            obiettivo = :obiettivo
                        WHERE idIspezioneCostruzione = :id");

        $this->db->bind(":data", $ispezione["data"]); 
        $this->db->bind(":idCustom", $ispezione["idCustom"]); 
        $this->db->bind(":luogo", $ispezione["luogo"]);
        $this->db->bind(":cliente", $ispezione["cliente"]);
        $this->db->bind(":obiettivo", $ispezione["obiettivo"]);
        $this->db->bind(":operatori", $ispezione["operatori"]);
        $this->db->bind(":sonde", $ispezione["sonde"]);
        $this->db->bind(":reticoli", $ispezione["reticoli"]);
        $this->db->bind(":fk_idAreaRiferimento", $ispezione["fk_idAreaRiferimento"]);
        $this->db->bind(":fk_idSottoArea", $ispezione["fk_idSottoArea"]);
        $this->db->bind(":nomeArea", $ispezione["nomeArea"]);
        $this->db->bind(":stato", $ispezione["stato"]);
        $this->db->bind(":id", $ispezione["idIspezione"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    } 

    public function getIspezioneById($id){
        $this->db->query('SELECT ispezioni_costruzione.*,  
                              progetti.nome AS nomeProgetto,
                              aree_riferimento.area AS macroArea, 
                              sotto_aree.nome AS sottoArea
                         FROM ispezioni_costruzione  
                         INNER JOIN aree_riferimento ON aree_riferimento.idAreaRiferimento = fk_idAreaRiferimento
                         INNER JOIN sotto_aree ON sotto_aree.idSottoArea = fk_idSottoArea
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