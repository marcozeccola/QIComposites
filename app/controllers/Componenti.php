<?php
class Componenti extends Controller {
    public function __construct() { 

        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->projectModel = $this->model('Progetto');
        $this->anomalieCostruzioneModel = $this->model('AnomaliaCostruzione');
        $this->anomalieNavigazioneModel = $this->model('AnomaliaNavigazione');
        $this->tipiAnomalieModel = $this->model('TipoAnomalia');
        $this->componenteModel = $this->model('Componente');
    }

     public function aggiungiComponente(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["componente"]) && isset($_GET["idProgetto"])){
               $data =[
                    'nome'=>$_POST["componente"],
                    'idProgetto'=>$_GET["idProgetto"],
               ];
               $this->componenteModel->inserisci($data);
               header('location: ' . URLROOT . "/progetti/progetto?id=".$_GET["idProgetto"]);
          }else{  
               $this->view('componenti/aggiungiComponente', $data);
          }
     }
 
}
