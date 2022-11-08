<?php
class Aree extends Controller {
    public function __construct() { 

        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->projectModel = $this->model('Progetto');
        $this->anomalieCostruzioneModel = $this->model('AnomaliaCostruzione');
        $this->tipiAnomalieModel = $this->model('TipoAnomalia');
        $this->areaModel = $this->model('Area');
    }

     public function aggiungiArea(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["area"]) && isset($_GET["idProgetto"])){
               $data =[
                    'area'=>$_POST["area"],
                    'idProgetto'=>$_GET["idProgetto"],
               ];
               $this->areaModel->inserisci($data);
               header('location: ' . URLROOT . "/progetti/progetto?id=".$_GET["idProgetto"]);
          }else{  
               $this->view('aree/aggiungiArea', $data);
          }
     }
 
}
