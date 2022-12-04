<?php
class Pages extends Controller {
    public function __construct() {
        
        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->projectModel = $this->model('Progetto');
        $this->anomalieCostruzioneModel = $this->model('AnomaliaCostruzione');
        $this->ispezioniCostruzioneModel = $this->model('IspezioneCostruzione');
        $this->tipiAnomalieModel = $this->model('TipoAnomalia'); 
        $this->usersModel = $this->model('User');
        $this->areeModel = $this->model('Area');
        $this->sondeModel = $this->model('Sonda');
        $this->reticoliModel = $this->model('Reticolo');

    }

    public function index() {
        $prova = true;
        $ispezioniCostruzione = $this->ispezioniCostruzioneModel->getIspezioniByOperatore($_SESSION["username"], date("Y-m-d")) ;

 
        $data = [
            'title' => 'Home page',
            'ispezioni' => $ispezioniCostruzione ,
            'progetti' => $this->projectModel->getAllProgetti(),
        ];
        
        if(isLoggedIn()){ 
            $this->view('/index', $data);
        }else{
            header("location:".URLROOT."/users/login");
        }
    }

    public function gestore(){
        $data = [
            'title'=>'Gestione dati',
            'tipiAnomalie'=>$this->tipiAnomalieModel->getAllTipiAnomalie(),
            'sonde'=>$this->sondeModel->getAllSonde(),
            'reticoli'=>$this->reticoliModel->getAllReticoli()
        ];
        
        $this->view('/gestore', $data);
    }
 
}
