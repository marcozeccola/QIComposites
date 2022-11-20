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
        $this->sottoAreaModel = $this->model('SottoArea');
    }

     public function aggiungiArea(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["area"]) && isset($_GET["idProgetto"])){
               $data =[
                    'area'=>$_POST["area"],
                    'idProgetto'=>$_GET["idProgetto"],
               ];
               $this->areaModel->inserisci($data);
               header('location: ' . URLROOT . "/progetti/progetto?id=".$_GET["idProgetto"]."#aree");
          }else{  
               $this->view('aree/aggiungiArea', $data);
          }
     }

     
     public function aggiungiSottoArea(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["sottoAreaInput"]) && isset($_GET["idArea"])){
               $data =[
                    'sottoAreaInput'=>$_POST["sottoAreaInput"],
                    'fk_idAreaRiferimento'=>$_GET["idArea"],
                    'idProgetto'=> $this->areaModel->getIdProgettoByIdArea($_GET["idArea"])->fk_idProgetto,
               ];
               $this->sottoAreaModel->inserisci($data);
              
               header('location: ' . URLROOT . "/aree/singolaMacroArea?idArea=".$data["fk_idAreaRiferimento"]);
          }else{  
               $this->view('aree/aggiungiSottoArea', $data);
          }
     }

     public function modificaSottoArea(){
           if($_SERVER['REQUEST_METHOD'] == 'POST'){

               $data =[
                    'sottoArea'=>$_POST["sottoAreaInput"],
                    'id'=>$_POST["idSottoArea"]
               ];
               $this->sottoAreaModel->modifica($data);
              
               header('location: ' . URLROOT . "/aree/singolaMacroArea?idArea=".$_GET["idMacroArea"]);

          }else{  

               if(isset($_GET["id"])){ 
                    $data =[
                         'sottoArea'=>$this->sottoAreaModel->getSottoAreaById($_GET["id"]),
                    ];
                    
                    $this->view('aree/modificaSottoArea', $data);
               }else{
                    header('location: ' . URLROOT);
               }
               
          }
     }

     public function singolaMacroArea(){
           $data=[];
          if(isset($_GET["idArea"])){  
               $data = [
                    'sottoAree'=>$this->sottoAreaModel->getSottoAreeByArea($_GET["idArea"]),
               ];
               $this->view('aree/singolaMacroArea', $data);
          }else{
               header('location: ' . URLROOT . "/progetti/");
          }
     }
 
}
