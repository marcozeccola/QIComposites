<?php
class Pdf extends Controller {
    public function __construct() {
        $this->projectModel = $this->model('Progetto');
        $this->ispezioniCostruzioneModel = $this->model('IspezioneCostruzione'); 
        $this->anomaliaCostruzioneModel = $this->model('AnomaliaCostruzione'); 
        $this->userModel = $this->model('User');
    }

    public function index() {
 
               $idProgetto = $_GET["idProgetto"];

               $data = [
               ];
               $this->view('pdf/index', $data);
    }

    public function quick() {

          if(isset($_GET["idIspezione"])){
               $idIspezione = $_GET["idIspezione"];
               
               if( $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]) != false){ 
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]); 
                     
               }elseif( $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]) != false){
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]);
               }else{
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaArea($_GET["idIspezione"]);
               }
               
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
               
               if( $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]) != false){ 
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]); 
                     
               }elseif( $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]) != false){
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]);
               }else{
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaArea($_GET["idIspezione"]);
               }
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
