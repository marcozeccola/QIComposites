<?php
class Pages extends Controller {
    public function __construct() {
        
        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->projectModel = $this->model('Progetto');
        $this->anomalieCostruzioneModel = $this->model('AnomaliaCostruzione');
        $this->anomalieNavigazioneModel = $this->model('AnomaliaNavigazione');
        $this->ispezioniCostruzioneModel = $this->model('IspezioneCostruzione');
        $this->ispezioniNavigazioneModel = $this->model('IspezioneNavigazione');
        $this->tipiAnomalieModel = $this->model('TipoAnomalia'); 
        $this->usersModel = $this->model('User');
        $this->areeModel = $this->model('Area');
        $this->sondeModel = $this->model('Sonda');

    }

    public function index() {

        $ispezioniCostruzione = $this->ispezioniCostruzioneModel->getIspezioniByOperatore($_SESSION["username"], date("Y-m-d")) ;
        $ispezioniNavigazione = $this->ispezioniNavigazioneModel->getIspezioniByOperatore($_SESSION["username"], date("Y-m-d")) ;
        $ispezioni = false;
        if($ispezioniCostruzione != false && $ispezioniNavigazione != false){
            $ispezioni = array_merge($ispezioniCostruzione, $ispezioniNavigazione);
        }else if($ispezioniCostruzione != false){
             $ispezioni = $ispezioniCostruzione;
        }else if($ispezioniNavigazione != false){
             $ispezioni = $ispezioniNavigazione;
        }else{
            $ispezioni = false;
        }
 
        $data = [
            'title' => 'Home page',
            'ispezioni' => $ispezioni ,
            'progetti' => $this->projectModel->getAllProgetti(),
        ];
        
        if(isLoggedIn()){ 
            $this->view('/index', $data);
        }else{
            header("location:".URLROOT."/users/login");
        }
    }
 
}
