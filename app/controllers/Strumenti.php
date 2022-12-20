<?php
class Strumenti extends Controller {
    public function __construct() { 

        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->strumentoModel = $this->model('Strumento'); 
    }

     public function aggiungiStrumento(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["strumento"]) ){
               $data =[
                    'strumento'=>$_POST["strumento"]
               ];
               $this->strumentoModel->inserisci($data["strumento"]);
               header('location: ' . URLROOT . "/pages/gestore#strumenti");
          }else{   
               $this->view('strumenti/aggiungiStrumento', $data);
          }
     }

     
 
     public function eliminaStrumento(){
        if(isset($_GET["id"])){  
               $this->strumentoModel->deleteStrumentoById($_GET["id"]);
               header('location: ' . URLROOT . "/pages/gestore#strumenti"); 
        }
     }
 
}
