<?php
class Pdf extends Controller {
    public function __construct() {
        $this->projectModel = $this->model('Progetto');
        $this->ispezioniCostruzioneModel = $this->model('IspezioneCostruzione'); 
        $this->anomaliaCostruzioneModel = $this->model('AnomaliaCostruzione'); 
        $this->userModel = $this->model('User');
    }

    public function index() {

          if(isset($_GET["idProgetto"])){
               $idProgetto = $_GET["idProgetto"];

               $data = [
                    'progetto'=>$this->projectModel->getProgettoById($idProgetto),
                    'ispezioniCostruzione'=>$this->ispezioniCostruzioneModel->getIspezioniByProgetto($idProgetto), 
                    'anomalieCostruzione'=>$this->anomaliaCostruzioneModel->getAnomaliaByProgetto($idProgetto), 
               ];
               $this->view('pdf/index', $data);
          }else{ 
               header("location:".URLROOT."/progetti");
          } 
    }

    public function quick() {

          if(isset($_GET["idIspezione"])){
               $idIspezione = $_GET["idIspezione"];
               $ispezione= $this->ispezioniCostruzioneModel->getIspezioneById($idIspezione);
               $primoOperatore=explode(",", $ispezione->operatori)[0];
              
               $data = [
                    'progetto'=>$this->projectModel->getProgettoByIspezione($idIspezione),
                    'idOperatorePrincipale'=>$this->userModel->findIdByUsername($primoOperatore),
                    'ispezione'=>$ispezione, 
                    'anomalie'=>$this->anomaliaCostruzioneModel->getAnomaliaByIspezione($idIspezione), 
               ];
                 $this->view('pdf/quick', $data);
          }else{ 
               header("location:".URLROOT."/progetti");
          } 
    }

    
    public function report() {

          if(isset($_GET["idIspezione"])){
               $idIspezione = $_GET["idIspezione"];
               $ispezione= $this->ispezioniCostruzioneModel->getIspezioneById($idIspezione);
               $primoOperatore=explode(",", $ispezione->operatori)[0];
              
               $data = [
                    'progetto'=>$this->projectModel->getProgettoByIspezione($idIspezione),
                    'idOperatorePrincipale'=>$this->userModel->findIdByUsername($primoOperatore),
                    'ispezione'=>$ispezione, 
                    'anomalie'=>$this->anomaliaCostruzioneModel->getAnomaliaByIspezione($idIspezione), 
               ];
                 $this->view('pdf/complete', $data);
          }else{ 
               header("location:".URLROOT."/progetti");
          } 
    }
 
}
