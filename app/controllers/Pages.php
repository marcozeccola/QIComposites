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

    }

    public function index() {
        $prova = true;
        $ispezioniCostruzione = $this->ispezioniCostruzioneModel->getIspezioniByOperatore($_SESSION["username"], date("Y-m-d")) ;
        $ispezioni = false;
        if($ispezioniCostruzione != false){
            $ispezioni = array_merge($ispezioniCostruzione);
        }else if($ispezioniCostruzione != false){
             $ispezioni = $ispezioniCostruzione;
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

    public function gestore(){
        $data = [
            'title'=>'Gestione dati',
        ];
        $this->view('/gestore', $data);
    }
 
}
