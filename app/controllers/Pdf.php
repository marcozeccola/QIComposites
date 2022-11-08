<?php
class Pdf extends Controller {
    public function __construct() {
        $this->projectModel = $this->model('Progetto');
        $this->ispezioniCostruzioneModel = $this->model('IspezioneCostruzione'); 
        $this->anomaliaCostruzioneModel = $this->model('AnomaliaCostruzione'); 
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
 
}
