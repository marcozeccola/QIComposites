<?php
class Anomalie extends Controller {
    public function __construct() { 

        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->projectModel = $this->model('Progetto');
        $this->anomalieCostruzioneModel = $this->model('AnomaliaCostruzione');
        $this->ispezioniCostruzioneModel = $this->model('IspezioneCostruzione');
        $this->tipiAnomalieModel = $this->model('TipoAnomalia'); 
        $this->areaModel = $this->model('Area'); 
        $this->sottoAreaModel = $this->model('SottoArea'); 
        $this->strumentiModel = $this->model('Strumento');
    }

     /* L'index mostra TUTTE le anomalie di un progetto */
    public function index() { 

        if( isset($_GET["idProgetto"])){

            $anomalieCostruzione = $this->anomalieCostruzioneModel->getAnomaliaByProgetto($_GET["idProgetto"]);

            $nomeProgetto = $this->projectModel->getProgettoById($_GET["idProgetto"])->nome;

               $data = [
                    'anomalieCostruzione'=> $anomalieCostruzione,
                    'nomeProgetto'=>$nomeProgetto,
                    'idProgetto'=>$_GET["idProgetto"],
               ];
            $this->view('anomalie/index', $data);
        }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }
    }   
 
    public function singolaAnomaliaCostruzione(){
        
        if( isset($_GET["idAnomalia"])){
            $data=[
                'anomalia'=>$this->anomalieCostruzioneModel->getAnomaliaById($_GET["idAnomalia"])
            ];

            $this->view('anomalie/singolaAnomaliaCostruzione', $data);
        }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }
    }

    public function modificaAnomaliaCostruzione(){
        if(isset($_GET["idAnomalia"])){
            $data = [
                "anomalia"=>$this->anomalieCostruzioneModel->getAnomaliaById($_GET["idAnomalia"]),
                'tipiAnomalie'=>$this->tipiAnomalieModel->getAllTipiAnomalie()
            ];
            
            $this->view('anomalie/modificaAnomaliaCostruzione', $data);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
            $data = [
                'localizzazione'=>trim($_POST["localizzazione"]),
                'estensione'=>trim($_POST["estensione"]),
                'profondita'=>trim($_POST["profondita"]),
                'idAnomalia'=>trim($_POST["idAnomalia"]), 
                'commenti'=> trim($_POST["commenti"]),  
                'riparazione'=>isset($_POST["riparazione"]) ? trim($_POST["riparazione"]) : "no",
            ];   

            if(isset($_POST["tipo"]) &&  $_POST["tipo"] == "no" &&  !isset($_POST["aggiungiTipo"])){  
                $this->anomalieCostruzioneModel->modificaAnomalia($data);  
            }else if(isset($_POST["tipo"]) && $_POST["tipo"] != "no" &&  !isset($_POST["aggiungiTipo"])){
                $this->anomalieCostruzioneModel->modificaAnomaliaWithTipo($data); 
            }else if(  isset($_POST["aggiungiTipo"]) && $_POST["aggiungiTipo"]=="yes" && isset($_POST["tipoAnomalieInput"])){
 
                $data = [
                    'localizzazione'=>trim($_POST["localizzazione"]),
                    'estensione'=>trim($_POST["estensione"]),
                    'profondita'=>trim($_POST["profondita"]),
                    'idAnomalia'=>trim($_POST["idAnomalia"]), 
                    'commenti'=> trim($_POST["commenti"]), 
                    'tipo'=>trim($_POST["tipoAnomalieInput"]),
                    'riparazione'=>isset($_POST["riparazione"]) ? trim($_POST["riparazione"]) : "no",
                ];
                $this->anomalieCostruzioneModel->modificaAnomaliaWithTipo($data);    
            }
 
            if ( $_FILES["immagini"]["tmp_name"]!="" ){
                $files = array_filter($_FILES['immagini']['name']);                         
                $total_count = count($_FILES['immagini']['name']);

                $cartella = str_replace(' ', '',  PUBLICROOT. "/anomalie/costruzione/ ".$_POST["idAnomalia"]."/ ");
                
                if(!is_dir($cartella)){
                    mkdir( $cartella, 0777, true);
                }

                for( $i=0 ; $i < $total_count ; $i++ ) {  
                        $tmpFilePath = $_FILES['immagini']['tmp_name'][$i];
                        $newFilePath = $cartella. $_FILES['immagini']['name'][$i]; 
                        move_uploaded_file($tmpFilePath, $newFilePath);
                } 
            }
            header('location: ' . URLROOT . "/anomalie/singolaAnomaliaCostruzione?idAnomalia=". $_POST["idAnomalia"]);
        }

    } 

      public function aggiungiImmagineAnomaliaCostruzione(){
        
        $data = [
            'title' => 'Form Aggiungi anomalia'
        ]; 
          
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 

            if ( $_FILES["immagini"]["tmp_name"]!="" ){
                $files = array_filter($_FILES['immagini']['name']);                         
                $total_count = count($_FILES['immagini']['name']);

                $cartella = str_replace(' ', '',  PUBLICROOT. "/anomalie/costruzione/ ".$_POST["idAnomalia"]."/ ");
                
                if(!is_dir($cartella)){
                    mkdir( $cartella, 0777, true);
                }

                for( $i=0 ; $i < $total_count ; $i++ ) {  
                        $tmpFilePath = $_FILES['immagini']['tmp_name'][$i];
                        $newFilePath = $cartella. $_FILES['immagini']['name'][$i]; 
                        move_uploaded_file($tmpFilePath, $newFilePath);
                } 
            } 

            header("location: " . URLROOT."/anomalie/singolaAnomaliaCostruzione?idAnomalia=". $_POST["idAnomalia"] );
 

            
        }else if(isset($_GET["idAnomalia"])){
            $data = [
                "anomalia"=>$this->anomalieCostruzioneModel->getAnomaliaById($_GET["idAnomalia"]),
                'tipiAnomalie'=>$this->tipiAnomalieModel->getAllTipiAnomalie()
            ]; 
            $this->view('anomalie/aggiungiImmagineAnomaliaCostruzione', $data);
             
        } else{ 
            header('location: ' . URLROOT . "/progetti/");
        }

        
    }

    
    /* Pagina con le anomalie di costruzione di una determinata ispezione passsando per GET l'id  */
    public function anomalieIspezioneCostruzione(){

        if( isset($_GET["idIspezione"])){

                $anomalieCostruzione = $this->anomalieCostruzioneModel->getAnomaliaByIspezione($_GET["idIspezione"]); 
                
                if( $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]) != false){ 
                        $ispezione = $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]); 
                        
                }elseif( $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]) != false){
                        $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]);
                }else{
                        $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaArea($_GET["idIspezione"]);
                }
 
               
                $data = [
                    'anomalieCostruzione'=> $anomalieCostruzione,  
                    'ispezione'=>$ispezione,
                    'macroArea'=>$this->areaModel->getAreaById($ispezione->fk_idAreaRiferimento),
                    'sottoArea'=>$this->sottoAreaModel->getSottoAreaById($ispezione->fk_idSottoArea),
                ];
            $this->view('anomalie/anomalieIspezioneCostruzione', $data);
        }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }

    }

    //Imposta a false la presenza dell'anomalia
    public function risoltoCostruzione(){
        if( isset($_POST["idAnomalia"]) ){
            $this->anomalieCostruzioneModel->risolvi($_POST["idAnomalia"], $_POST["commento"]);

            if(isset($_GET["idIspezione"]) && $_GET["idIspezione"]>0){ 
                header('location: ' . URLROOT . "/anomalie/anomalieIspezioneCostruzione?idIspezione=". $_GET["idIspezione"]);
            }elseif(!isset($_GET["idProgetto"])){
                header('location: ' . URLROOT . "/anomalie/singolaAnomaliaCostruzione?idAnomalia=". $_GET["idAnomalia"]);
            }elseif(isset($_GET["idProgetto"])){  
                header('location: ' . URLROOT . "/anomalie/index?idProgetto=". $_GET["idProgetto"]);
            }

        }else if(isset($_GET["idAnomalia"])){ 
            $data = [];
            $this->view('anomalie/risolviAnomalia', $data);
        }else{ 
            header('location: ' . URLROOT . "/progetti/index");
        }
    }

    //aggiunge tipo di anomalia 
    public function aggiungiTipoAnomalia(){
        $data=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->tipiAnomalieModel->inserisci($_POST["anomalia"]);
            header('location: ' . URLROOT . "/pages/gestore#tipi");
        }else{  
            $this->view('anomalie/aggiungiTipoAnomalia', $data);
        }
    }

    public function eliminaTipoAnomalia(){
        if(isset($_GET["id"])){ 
            $anomalie = $this->anomalieCostruzioneModel->getAnomalieByTipo($_GET["id"])->num;
            if($anomalie > 0){
                header('location: ' . URLROOT . "/pages/gestore?errore=tipi");
            }else{
                 $this->tipiAnomalieModel->deleteTipoAnomaliaById($_GET["id"]);
                 header('location: ' . URLROOT . "/pages/gestore#tipi");
            }
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
                    'commenti'=> trim($_POST["commenti"]), 
                    'ispezione'=> trim($_GET["idIspezione"]),  
                    'tipo'=> trim($_POST["tipo"]),    
                    'switchAggiungi'=>trim($_POST["aggiungiTipo"]),
                    'tipoNuovo'=>trim($_POST["tipoAnomalieInput"]), 
               ];

                if(isset($data["switchAggiungi"]) && $data["switchAggiungi"]=="yes" && isset($data["tipoNuovo"])){
                    $data["tipo"]= $data["tipoNuovo"]; 
                }
                
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
 
           
}
  