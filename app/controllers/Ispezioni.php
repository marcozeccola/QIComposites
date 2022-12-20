<?php
class Ispezioni extends Controller {
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
        $this->sottoAreeModel = $this->model('SottoArea');
        $this->sondeModel = $this->model('Sonda');
        $this->reticoliModel = $this->model('Reticolo');
        $this->strumentiModel = $this->model('Strumento');
    }

     /* Mostra tutte le ispezioni di un progetto  */
     public function index(){ 
           $data=[];
           if(isset($_GET["idProgetto"])){

               $ispezioniCostruzione = $this->ispezioniCostruzioneModel->getIspezioniByProgetto($_GET["idProgetto"]);
               $nomeProgetto = $this->projectModel->getProgettoById($_GET["idProgetto"])->nome;
               $data = [
                    'ispezioniCostruzione'=>$ispezioniCostruzione,
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
                    'strumenti'=>$this->strumentiModel->getAllStrumenti(),
                    'idProgetto'=>$_GET["idProgetto"] 
               ];
          }
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
               $data =[
                    'data'=> trim($_POST["data"]),  
                    'idCustom'=> trim($_POST["idCustom"]), 
                    'luogo'=> trim($_POST["luogo"]), 
                    'cliente'=> trim($_POST["cliente"]), 
                    'stato'=> trim($_POST["stato"]),  
                    'operatori'=> trim($_POST["operatori"]), 
                    'sonde'=> trim($_POST["sonde"]),  
                    'reticoli'=> trim($_POST["reticoli"]),  
                    'strumenti'=> trim($_POST["strumenti"]),  
                    'fk_idAreaRiferimento'=> trim($_POST["macroArea"]),
                    'fk_idSottoArea'=> trim($_POST["sottoArea"]),
                    'nomeArea'=> trim($_POST["nomeArea"]),
                    'obiettivo'=> trim($_POST["obiettivo"]),
                    'revisionato'=> trim($_POST["revisionato"]) == "true" ? 1 : 0,
                    'progetto'=> trim($_GET["idProgetto"]), 
 

                    'switchAggiungi'=> trim($_POST["aggiungiArea"]),   
                    'sottoAreaInput'=> trim($_POST["sottoAreaInput"]),
               ];

               if(isset($data["switchAggiungi"]) && $data["switchAggiungi"]=="yes" && isset($data["sottoAreaInput"])){
                     
                    $idAreaInserita = $this->sottoAreeModel->inserisci($data);
                    $data["fk_idSottoArea"]= $idAreaInserita; 
               }

               $inserito =  $this->ispezioniCostruzioneModel->inserisci($data);

               if($inserito>0){

                    $files = array_filter($_FILES['immagini']['name']);                         
                    $total_count = count($_FILES['immagini']['name']);

                    $cartella = str_replace(' ', '',  PUBLICROOT. "/ispezioni/costruzione/ ".$inserito."/ ");
                    
                    mkdir( $cartella, 0777, true);

                    for( $i=0 ; $i < $total_count ; $i++ ) {  
                              $tmpFilePath = $_FILES['immagini']['tmp_name'][$i];
                              $newFilePath = $cartella. $_FILES['immagini']['name'][$i]; 
                              move_uploaded_file($tmpFilePath, $newFilePath);
                    } 

                }

               if($inserito){ 
                    header("Location:".URLROOT. "/anomalie/anomalieIspezioneCostruzione?idIspezione=$inserito");
               } 
           }
               $this->view('ispezioni/aggiungiIspezioneCostruzione', $data);
           
     }

     public function modificaIspezioneCostruzione(){
        if(isset($_GET["idIspezione"])){
          
               if( $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]) != false){ 
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneById($_GET["idIspezione"]); 
                     
               }elseif( $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]) != false){
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaSottoArea($_GET["idIspezione"]);
               }else{
                    $ispezione = $this->ispezioniCostruzioneModel->getIspezioneByIdSenzaArea($_GET["idIspezione"]);
               }
            $data = [
                    "ispezione"=>$ispezione,
                    'operatori'=>$this->usersModel->getAll(), 
                    'macroAree'=> $this->areeModel->getAreeByIspezioneCostruzione($_GET["idIspezione"]),
                    'sottoAree'=> $this->sottoAreeModel->getSottoAreeByIspezioneCostruzione($_GET["idIspezione"]),
                    'sonde'=>$this->sondeModel->getAllSonde(),
                    'strumenti'=>$this->strumentiModel->getAllStrumenti(),
                    'reticoli'=>$this->reticoliModel->getAllReticoli(), 
            ];
            
             $this->view('ispezioni/modificaIspezioneCostruzione', $data);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
 
               $data =[
                    'data'=> trim($_POST["data"]),  
                    'idCustom'=> trim($_POST["idCustom"]), 
                    'luogo'=> trim($_POST["luogo"]), 
                    'cliente'=> trim($_POST["cliente"]), 
                    'stato'=> trim($_POST["stato"]),  
                    'operatori'=> trim($_POST["operatori"]), 
                    'sonde'=> trim($_POST["sonde"]),  
                    'reticoli'=> trim($_POST["reticoli"]),  
                    'strumenti'=> trim($_POST["strumenti"]),    
                    'nomeArea'=> trim($_POST["nomeArea"]),
                    'idIspezione'=>trim($_POST["idIspezione"]),
                    'obiettivo'=>trim($_POST["obiettivo"]), 
 
                    'sottoAreaInput'=> trim($_POST["sottoAreaInput"]),
               ];
               
               /* Se non viene inserita una macro area rimane quella precedente nel database */
               if(isset($_POST["macroArea"])){
                    $data["fk_idAreaRiferimento"]=$_POST["macroArea"];
                     
                    if(isset($_POST["aggiungiArea"]) && $_POST["aggiungiArea"]=="yes" && isset($data["sottoAreaInput"])){
                         
                         $idAreaInserita = $this->sottoAreeModel->inserisci($data);
                         $data["fk_idSottoArea"]= $idAreaInserita; 
                    } 
               }else{
                    $data["fk_idAreaRiferimento"]=$this->ispezioniCostruzioneModel->getIspezioneById($data["idIspezione"])->fk_idAreaRiferimento;
               }

               /* Se non viene inserita il revisionato  rimane quello precedente nel database */
               if(isset($_POST["revisionato"])){
                    $data["revisionato"]== "true" ? 1 : 0;
               }else{
                    $data["revisionato"]=$this->ispezioniCostruzioneModel->getIspezioneById($data["idIspezione"])->revisionato;
               }

               
               /* Se viene cambiata sottoarea si ricontrolla la macroarea di riferimetno e si imposta quella associata alla sottoarea */
               if(isset($_POST["sottoArea"])){
                    $data["fk_idAreaRiferimento"]=$this->areeModel->getAreaBySottoArea(trim($_POST["sottoArea"]))->idAreaRiferimento;
                    $data["fk_idSottoArea"]=$_POST["sottoArea"];
               }
             
                
               $inserita = $this->ispezioniCostruzioneModel->modificaIspezione($data); 
               if($inserita){
                    if ( $_FILES["immagini"]["tmp_name"]!="" ){
                         $files = array_filter($_FILES['immagini']['name']);                         
                         $total_count = count($_FILES['immagini']['name']);

                         $cartella = str_replace(' ', '',  PUBLICROOT. "/ispezioni/costruzione/ ".$_POST["idIspezione"]."/ ");
                    
                         if(!is_dir($cartella)){
                              mkdir( $cartella, 0777, true);
                         }

                         for( $i=0 ; $i < $total_count ; $i++ ) {  
                              $tmpFilePath = $_FILES['immagini']['tmp_name'][$i];
                              $newFilePath = $cartella. $_FILES['immagini']['name'][$i]; 
                              move_uploaded_file($tmpFilePath, $newFilePath);
                         } 
                    }
               }
                    

               header('location: ' . URLROOT . "/anomalie/anomalieIspezioneCostruzione?idIspezione=". $_POST["idIspezione"]);
        }

    }
 
}
