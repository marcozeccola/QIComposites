<?php
class Reticoli extends Controller {
    public function __construct() { 

        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->reticoloModel = $this->model('Reticolo'); 
    }

     public function aggiungiReticolo(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["reticolo"]) && isset($_GET["idProgetto"])){
               $data =[
                    'reticolo'=>$_POST["reticolo"],
                    'idProgetto'=>$_GET["idProgetto"],
               ];
               $this->reticoloModel->inserisci($data["reticolo"]);
               header('location: ' . URLROOT . "/pages/gestore#reticoli");
          }else{   
               $this->view('reticoli/aggiungiReticolo', $data);
          }
     }

     
 
     public function eliminaReticolo(){
        if(isset($_GET["id"])){  
               $this->reticoloModel->deleteReticoloById($_GET["id"]);
               header('location: ' . URLROOT . "/pages/gestore#reticoli"); 
        }
     }
 
}
