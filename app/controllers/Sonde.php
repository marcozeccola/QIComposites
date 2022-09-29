<?php
class Sonde extends Controller {
    public function __construct() { 

        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->sondaModel = $this->model('Sonda'); 
    }

     public function aggiungiSonda(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["sonda"]) && isset($_GET["idProgetto"])){
               $data =[
                    'sonda'=>$_POST["sonda"],
                    'idProgetto'=>$_GET["idProgetto"],
               ];
               $this->sondaModel->inserisci($data);
               header('location: ' . URLROOT . "/progetti/progetto?id=".$_GET["idProgetto"]);
          }else{  
               $this->view('sonde/aggiungiSonda', $data);
          }
     }
 
}
