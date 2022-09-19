<?php
class Ispezioni extends Controller {
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

     /* Mostra tutte le ispezioni di un progetto  */
     public function index(){
           $data=[];
           if(isset($_GET["idProgetto"])){

               $ispezioniCostruzione = $this->ispezioniCostruzioneModel->getIspezioniByProgetto($_GET["idProgetto"]);
               $ispezioniNavigazione = $this->ispezioniNavigazioneModel->getIspezioniByProgetto($_GET["idProgetto"]);
               $nomeProgetto = $this->projectModel->getProgettoById($_GET["idProgetto"])->nome;
               $data = [
                    'ispezioniCostruzione'=>$ispezioniCostruzione,
                    'ispezioniNavigazione'=>$ispezioniNavigazione,
                    'nomeProgetto'=>$nomeProgetto,
               ];
               $this->view('ispezioni/index', $data);
          }else{  
               header('location: ' . URLROOT . "/progetti/index");
          }
     }

     public function aggiungiIspezioneCostruzione(){
          $data = [];
          if(isset($_GET["idProgetto"])){
               $data= [
                    'operatori'=>$this->usersModel->getAll(),
                    'aree'=> $this->areeModel->getAreeByProgetto($_GET["idProgetto"]),
                    'sonde'=>$this->sondeModel->getAllSonde(),
                    'idProgetto'=>$_GET["idProgetto"] 
               ];
          }
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
               $data =[
                    'data'=> trim($_POST["data"]), 
                    'luogo'=> trim($_POST["luogo"]), 
                    'operatori'=> trim($_POST["operatori"]), 
                    'cliente'=> trim($_POST["cliente"]), 
                    'progetto'=> trim($_GET["idProgetto"]), 
                    'risultato'=>empty($_POST["risultato"]) ? 0 : 1,  
                    'aree'=> trim($_POST["aree"]),   
                    'sonda'=> trim($_POST["sonda"]),  
                    'reticolo'=> trim($_POST["reticolo"]),    
               ];

               $inserito =  $this->ispezioniCostruzioneModel->inserisci($data);
               if($inserito){
                    if($data["risultato"]==1){ 
                         header("Location:".URLROOT. "/anomalie/aggiungiAnomaliaCostruzione?idIspezione=$inserito");
                    }
                    header("Location:".URLROOT. "/anomalie/anomalieIspezioneCostruzione?idIspezione=$inserito");
               } 
           }
               $this->view('ispezioni/aggiungiIspezioneCostruzione', $data);
           
     }

     public function aggiungiIspezioneNavigazione(){
          $data = [];
          if(isset($_GET["idProgetto"])){
               $data= [
                    'operatori'=>$this->usersModel->getAll(),
                    'aree'=> $this->areeModel->getAreeByProgetto($_GET["idProgetto"]),
                    'sonde'=>$this->sondeModel->getAllSonde(),
                    'idProgetto'=>$_GET["idProgetto"] 
               ];
          }
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
               $data =[
                    'data'=> trim($_POST["data"]), 
                    'luogo'=> trim($_POST["luogo"]), 
                    'operatori'=> trim($_POST["operatori"]), 
                    'cliente'=> trim($_POST["cliente"]), 
                    'progetto'=> trim($_GET["idProgetto"]), 
                    'risultato'=>empty($_POST["risultato"]) ? 0 : 1,  
                    'aree'=> trim($_POST["aree"]),   
                    'dettagli'=> trim($_POST["dettagli"]), 
                    'sonda'=> trim($_POST["sonda"]),  
                    'reticolo'=> trim($_POST["reticolo"]),     
               ];

               $inserito =  $this->ispezioniNavigazioneModel->inserisci($data);
               if($inserito){
                    if($data["risultato"]==1){ 
                         header("Location:".URLROOT. "/anomalie/aggiungiAnomaliaNavigazione?idIspezione=$inserito");
                    }
                    header("Location:".URLROOT. "/anomalie/anomalieIspezioneNavigazione?idIspezione=$inserito");
               } 
           }
               $this->view('ispezioni/aggiungiIspezioneNavigazione', $data);
           
     }
 
}
