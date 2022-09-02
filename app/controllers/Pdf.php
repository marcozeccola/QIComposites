<?php
class Pdf extends Controller {
    public function __construct() {
        $this->projectModel = $this->model('Progetto');
        $this->ispezioniCostruzioneModel = $this->model('IspezioneCostruzione');
        $this->ispezioniNavigazioneModel = $this->model('IspezioneNavigazione');
        $this->anomaliaCostruzioneModel = $this->model('AnomaliaCostruzione');
        $this->anomaliaNavigazioneModel = $this->model('AnomaliaNavigazione');
    }

    public function index() {

          if(isset($_GET["idProgetto"])){
               $idProgetto = $_GET["idProgetto"];

               $data = [
                    'progetto'=>$this->projectModel->getProgettoById($idProgetto),
                    'ispezioniCostruzione'=>$this->ispezioniCostruzioneModel->getIspezioniByProgetto($idProgetto),
                    'ispezioniNavigazione'=>$this->ispezioniNavigazioneModel->getIspezioniByProgetto($idProgetto),
                    'anomalieCostruzione'=>$this->anomaliaCostruzioneModel->getAnomaliaByProgetto($idProgetto),
                    'anomalieNavigazione'=>$this->anomaliaNavigazioneModel->getAnomaliaByProgetto($idProgetto),
               ];
               $this->view('pdf/index', $data);
          }else{ 
               header("location:".URLROOT."/progetti");
          } 
    }
 
}
