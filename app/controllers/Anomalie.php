<?php
class Anomalie extends Controller {
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
    }

     /* L'index mostra TUTTE le anomalie di un progetto */
    public function index() { 

        if( isset($_GET["idProgetto"])){

            $anomalieCostruzione = $this->anomalieCostruzioneModel->getAnomaliaByProgetto($_GET["idProgetto"]);
            $anomalieNavigazione = $this->anomalieNavigazioneModel->getAnomaliaByProgetto($_GET["idProgetto"]);

            $nomeProgetto = $this->projectModel->getProgettoById($_GET["idProgetto"])->nome;

               $data = [
                    'anomalieCostruzione'=> $anomalieCostruzione,
                    'anomalieNavigazione'=> $anomalieNavigazione,
                    'nomeProgetto'=>$nomeProgetto,
                    'idProgetto'=>$_GET["idProgetto"],
               ];
            $this->view('anomalie/index', $data);
        }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }
    }
 
    /* Pagina con le anomalie di costruzione di una determinata ispezione passsando per GET l'id  */
    public function anomalieIspezioneCostruzione(){

        if( isset($_GET["idIspezione"])){

                $anomalieCostruzione = $this->anomalieCostruzioneModel->getAnomaliaByIspezione($_GET["idIspezione"]); 
                $ispezione = $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]); 

                $data = [
                    'anomalieCostruzione'=> $anomalieCostruzione, 
                    'ispezione'=>$ispezione,
                ];
            $this->view('anomalie/anomalieIspezioneCostruzione', $data);
        }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }

    }

    /* Pagina con le anomalie di navigazione di una determinata ispezione passsando per GET l'id  */
    public function anomalieIspezioneNavigazione(){

        if( isset($_GET["idIspezione"])){
 
            $anomalieNavigazione = $this->anomalieNavigazioneModel->getAnomaliaByIspezione($_GET["idIspezione"]);
            $ispezione = $this->ispezioniNavigazioneModel->getIspezioneById($_GET["idIspezione"]); 

               $data = [ 
                    'anomalieNavigazione'=> $anomalieNavigazione, 
                    'ispezione'=>$ispezione,
                    
               ];
            $this->view('anomalie/anomalieIspezioneNavigazione', $data);
        }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }

    }

    //Imposta a false la presenza dell'anomalia
     public function risoltoCostruzione(){
          if( isset($_GET["idAnomalia"])  && isset($_GET["idProgetto"]) ){
               $this->anomalieCostruzioneModel->risolvi($_GET["idAnomalia"]);
               if(isset($_GET["idIspezione"]) && $_GET["idIspezione"]>0){ 
                    header('location: ' . URLROOT . "/anomalie/anomalieIspezioneCostruzione?idIspezione=". $_GET["idIspezione"]);
               }else{ 
                    header('location: ' . URLROOT . "/anomalie/index?idProgetto=". $_GET["idProgetto"]);
               }
          }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }
     }
 
    //Imposta a false la presenza dell'anomalia  
     public function risoltoNavigazione(){
          if( isset($_GET["idAnomalia"])  && isset($_GET["idProgetto"]) ){
               $this->anomalieNavigazioneModel->risolvi($_GET["idAnomalia"]);
               
               if(isset($_GET["idIspezione"]) && $_GET["idIspezione"]>0){ 
                    header('location: ' . URLROOT . "/anomalie/anomalieIspezioneNavigazione?idIspezione=". $_GET["idIspezione"]);
               }else{ 
                    header('location: ' . URLROOT . "/anomalie/index?idProgetto=". $_GET["idProgetto"]);
               }
          }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }
     }

    //aggiunge tipo di anomalia 
     public function aggiungiTipoAnomalia(){
        $data=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->tipiAnomalieModel->inserisci($_POST["anomalia"]);
            header('location: ' . URLROOT . "/progetti/progetto?id=".$_GET["idProgetto"]);
        }else{  
            $this->view('anomalie/aggiungiTipoAnomalia', $data);
        }
     }

    public function aggiungiAnomaliaCostruzione(){
          $data = [];
          if(isset($_GET["idIspezione"])){
               $data= [
                    'idIspezione'=>$_GET["idIspezione"],
                    'tipiAnomalie'=>$this->tipiAnomalieModel->getAllTipiAnomalie()
               ];
          }
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
               $data =[
                    'localizzazione'=> trim($_POST["localizzazione"]), 
                    'estensione'=> trim($_POST["estensione"]), 
                    'profondita'=> trim($_POST["profondita"]), 
                    'ispezione'=> trim($_GET["idIspezione"]),  
                    'tipo'=> trim($_POST["tipo"]),    
               ];

               $inserito =  $this->anomalieCostruzioneModel->inserisci($data);
               if($inserito>0){
                     

                        $files = array_filter($_FILES['immagini']['name']);                         
                        $total_count = count($_FILES['immagini']['name']);

                        $cartella = str_replace(' ', '',  PUBLICROOT. "/anomalie/costruzione/ ".$inserito."/ ");
                        
                        mkdir( $cartella, 0777, true);

                        for( $i=0 ; $i < $total_count ; $i++ ) {  
                                $tmpFilePath = $_FILES['immagini']['tmp_name'][$i];
                                $newFilePath = $cartella. $_FILES['immagini']['name'][$i]; 
                                move_uploaded_file($tmpFilePath, $newFilePath);
                        }

                        

                }
                if(isset($_POST["continua"])){ 
                    header("Location:".URLROOT. "/anomalie/aggiungiAnomaliaCostruzione?idIspezione=".$_GET["idIspezione"]);
                }else{
                    header("Location:".URLROOT. "/anomalie/anomalieIspezioneCostruzione?idIspezione=".$_GET["idIspezione"]);
                }
            } 
            $this->view('anomalie/aggiungiAnomaliaCostruzione', $data);
    }

    public function aggiungiAnomaliaNavigazione(){
          $data = [];
          if(isset($_GET["idIspezione"])){
          
               $data= [
                    'idIspezione'=>$_GET["idIspezione"],
                    'tipiAnomalie'=>$this->tipiAnomalieModel->getAllTipiAnomalie()
               ];
          }
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
               $data =[
                    'localizzazione'=> trim($_POST["localizzazione"]), 
                    'estensione'=> trim($_POST["estensione"]), 
                    'profondita'=> trim($_POST["profondita"]), 
                    'ispezione'=> trim($_GET["idIspezione"]),  
                    'tipo'=> trim($_POST["tipo"]),    
                    'causa'=> trim($_POST["causa"]), 
               ];

               $inserito =  $this->anomalieNavigazioneModel->inserisci($data);
               if($inserito>0){
                     

                        $files = array_filter($_FILES['immagini']['name']);                         
                        $total_count = count($_FILES['immagini']['name']);

                        $cartella = str_replace(' ', '',  PUBLICROOT. "/anomalie/navigazione/ ".$inserito."/ ");
                        mkdir(  $cartella, 0777, true);

                        for( $i=0 ; $i < $total_count ; $i++ ) {  
                                $tmpFilePath = $_FILES['immagini']['tmp_name'][$i];
                                $newFilePath = $cartella. $_FILES['immagini']['name'][$i]; 
                                move_uploaded_file($tmpFilePath, $newFilePath);
                        } 

                }
                if(isset($_POST["continua"])){ 
                    header("Location:".URLROOT. "/anomalie/aggiungiAnomaliaNavigazione?idIspezione=".$_GET["idIspezione"]);
                }else{
                    header("Location:".URLROOT. "/anomalie/anomalieIspezioneNavigazione?idIspezione=".$_GET["idIspezione"]);
                }
            } 
            $this->view('anomalie/aggiungiAnomaliaNavigazione', $data);
    }
           
}
  