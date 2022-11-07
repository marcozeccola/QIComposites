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
        $this->sottoAreeModel = $this->model('SottoArea');
        $this->sondeModel = $this->model('Sonda');
        $this->reticoliModel = $this->model('Reticolo');
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
                    'macroAree'=> $this->areeModel->getAreeByProgetto($_GET["idProgetto"]),
                    'sottoAree'=> $this->sottoAreeModel->getSottoAreeByProgetto($_GET["idProgetto"]),
                    'sonde'=>$this->sondeModel->getAllSonde(),
                    'reticoli'=>$this->reticoliModel->getAllReticoli(),
                    'idProgetto'=>$_GET["idProgetto"] 
               ];
          }
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
               $data =[
                    'data'=> trim($_POST["data"]), 
                    'fine'=> trim($_POST["fine"]), 
                    'luogo'=> trim($_POST["luogo"]), 
                    'cliente'=> trim($_POST["cliente"]), 
                    'stato'=> trim($_POST["stato"]),  
                    'operatori'=> trim($_POST["operatori"]), 
                    'sonde'=> trim($_POST["sonde"]),  
                    'reticoli'=> trim($_POST["reticoli"]),  
                    'fk_idAreaRiferimento'=> trim($_POST["macroArea"]),
                    'fk_idSottoArea'=> trim($_POST["sottoArea"]),
                    'nomeArea'=> trim($_POST["nomeArea"]),
                    'progetto'=> trim($_GET["idProgetto"]), 
 

                    'switchAggiungi'=> trim($_POST["aggiungiArea"]),   
                    'sottoAreaInput'=> trim($_POST["sottoAreaInput"]),
               ];

               if(isset($data["switchAggiungi"]) && $data["switchAggiungi"]=="yes" && isset($data["sottoAreaInput"])){
                     
                    $idAreaInserita = $this->sottoAreeModel->inserisci($data);
                    $data["fk_idSottoArea"]= $idAreaInserita; 
               }

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


     public function modificaIspezioneCostruzione(){
        if(isset($_GET["idIspezione"])){
            $data = [
                    "ispezione"=>$this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]),
                    'operatori'=>$this->usersModel->getAll(), 
                    'macroAree'=> $this->areeModel->getAreeByIspezioneCostruzione($_GET["idIspezione"]),
                    'sottoAree'=> $this->sottoAreeModel->getSottoAreeByIspezioneCostruzione($_GET["idIspezione"]),
                    'sonde'=>$this->sondeModel->getAllSonde(),
                    'reticoli'=>$this->reticoliModel->getAllReticoli(),
            ];
            
             $this->view('ispezioni/modificaIspezioneCostruzione', $data);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
 
               $data =[
                    'data'=> trim($_POST["data"]), 
                    'fine'=> trim($_POST["fine"]), 
                    'luogo'=> trim($_POST["luogo"]), 
                    'cliente'=> trim($_POST["cliente"]), 
                    'stato'=> trim($_POST["stato"]),  
                    'operatori'=> trim($_POST["operatori"]), 
                    'sonde'=> trim($_POST["sonde"]),  
                    'reticoli'=> trim($_POST["reticoli"]),  
                    'fk_idAreaRiferimento'=> trim($_POST["macroArea"]),
                    'fk_idSottoArea'=> trim($_POST["sottoArea"]),
                    'nomeArea'=> trim($_POST["nomeArea"]),
                    'idIspezione'=>trim($_POST["idIspezione"]),
 

                    'switchAggiungi'=> trim($_POST["aggiungiArea"]),   
                    'sottoAreaInput'=> trim($_POST["sottoAreaInput"]),
               ];
               var_dump($data);
               if(isset($data["switchAggiungi"]) && $data["switchAggiungi"]=="yes" && isset($data["sottoAreaInput"])){
                     
                    $idAreaInserita = $this->sottoAreeModel->inserisci($data);
                    $data["fk_idSottoArea"]= $idAreaInserita; 
               }
             
                
                 $this->ispezioniCostruzioneModel->modificaIspezione($data);
                    

               header('location: ' . URLROOT . "/anomalie/anomalieIspezioneCostruzione?idIspezione=". $_POST["idIspezione"]);
        }

    }

/*
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
                    'fine'=> trim($_POST["fine"]), 
                    'luogo'=> trim($_POST["luogo"]), 
                    'operatori'=> trim($_POST["operatori"]), 
                    'cliente'=> trim($_POST["cliente"]), 
                    'progetto'=> trim($_GET["idProgetto"]), 
                    'risultato'=>empty($_POST["risultato"]) ? 0 : 1,  
                    'aree'=> trim($_POST["area"]), 
                    'areaInput'=>triM($_POST["areaInput"]), 
                    'dettagli'=> trim($_POST["dettagli"]), 
                    'sonda'=> trim($_POST["sonda"]),  
                    'reticolo'=> trim($_POST["reticolo"]), 
                    'switchAggiungi'=> trim($_POST["aggiungiArea"]),    
               ];
               
               if(isset($data["switchAggiungi"]) && $data["switchAggiungi"]=="yes" && isset($data["areaInput"])){
                    $data["aree"]= $data["areaInput"]; 
               }

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
 
 
     public function modificaIspezioneNavigazione(){
        if(isset($_GET["idIspezione"])){
            $data = [
                    "ispezione"=>$this->ispezioniNavigazioneModel->getIspezioneById($_GET["idIspezione"]),
                    'operatori'=>$this->usersModel->getAll(),
                    'aree'=> $this->areeModel->getAreeByIspezioneNavigazione($_GET["idIspezione"]),
                    'sonde'=>$this->sondeModel->getAllSonde(),
            ];
            
            $this->view('ispezioni/modificaIspezioneNavigazione', $data);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 

            if(isset($_POST["sonda"]) &&  $_POST["sonda"] == "no"  ){   
               $this->ispezioniNavigazioneModel->modificaIspezione($_POST);  
            }else if(isset($_POST["sonda"]) && $_POST["sonda"] != "no"  ){
               $this->ispezioniNavigazioneModel->modificaIspezioneWithSonda($_POST); 
            }  

            header('location: ' . URLROOT . "/anomalie/anomalieIspezioneNavigazione?idIspezione=". $_POST["idIspezione"]);
        }

    }
*/
}
