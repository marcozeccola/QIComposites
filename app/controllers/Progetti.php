<?php
class Progetti extends Controller {
    public function __construct() { 

        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 

        $this->projectModel = $this->model('Progetto');
        $this->sondaModel = $this->model('Sonda'); 
        $this->tipiAnomalieModel = $this->model('TipoAnomalia'); 
        $this->areaModel = $this->model('Area');
        $this->reticoloModel = $this->model('Reticolo');
    }

    //mostra tutti i progetti
    public function index() {
        $data = [
            'title' => 'Progetti',
            'progetti'=>$this->projectModel->getAllProgetti(), 
        ];
        
        $this->view('progetti/index', $data);
    }
    
    public function compressImage($source, $destination, $quality) { 
        
        $imgInfo = getimagesize($source); 
        $mime = $imgInfo['mime']; 
         
        switch($mime){ 
            case 'image/jpeg': 
                $image = imagecreatefromjpeg($source); 
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($source); 
                break; 
            case 'image/gif': 
                $image = imagecreatefromgif($source); 
                break; 
            default: 
                $image = imagecreatefromjpeg($source); 
        } 
        
        // Save image 
        imagejpeg($image, $destination, $quality); 
        
        // Return compressed image 
        return $destination; 
    }


    //form e gestione inserimento progetto
    public function nuovoProgetto(){ 
        $data = [
            'title' => 'Form progetti',
            'progetti'=>$this->projectModel->getAllProgetti(), 
            'errorNome'=>'',
            'errorInizio'=>'',
            'errorProgettista'=>'',
        ]; 
          
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data =[
                'nome'=>trim($_POST["nome"]),
                'inizio'=>trim($_POST["inizio"]),
                'progettista'=>trim($_POST["progettista"]), 
                'errorNome'=>'',
                'errorInizio'=>'',
                'errorProgettista'=>'',
            ];
 
                if ($id = $this->projectModel->inserisci($data)) {
                    
 
                    if(file_exists($_FILES['copertina']['tmp_name']) || is_uploaded_file($_FILES['copertina']['tmp_name'])) {
                        $dirCopertina =  str_replace(' ', '',  PUBLICROOT. "/progetti-docs/copertine/ ".$id."/ ");
                        mkdir(  $dirCopertina, 0777, true);
                        $caricamentoCopertina = $this->compressImage($_FILES["copertina"]["tmp_name"], $dirCopertina.$_FILES["copertina"]["name"], 70); 
                       
                    }else{
                        $caricamentoCopertina = true;
                    }

                    if(file_exists($_FILES['disegni']['tmp_name']) || is_uploaded_file($_FILES['disegni']['tmp_name'])) {
                        $dirDisegno = str_replace(' ', '',PUBLICROOT. "/progetti-docs/disegni/ ".$id."/ " );
                        mkdir(  $dirDisegno, 0777, true);
                        $caricamentoDisegno = move_uploaded_file($_FILES["disegni"]["tmp_name"],  $dirDisegno.$_FILES["disegni"]["name"] );
                    }else{
                        $caricamentoDisegno = true;
                    } 

                    if(file_exists($_FILES['ndt']['tmp_name']) || is_uploaded_file($_FILES['ndt']['tmp_name'])) {
                        $dirProcedura =  str_replace( ' ', '',PUBLICROOT. "/progetti-docs/procedures/ ". $id . "/ ");
                        mkdir(  $dirProcedura, 0777, true);
                        $caricamentoProcedure = move_uploaded_file($_FILES["ndt"]["tmp_name"], $dirProcedura.$_FILES["ndt"]["name"] );   
                    }else{
                         $caricamentoProcedure = true;
                    }
                    
                    if( $caricamentoCopertina && $caricamentoDisegno &&  $caricamentoProcedure ){ 
                        //Redirect alla pagina di progetti 
                        header('location: ' . URLROOT . "/progetti/progetto?id=$id");
                    }
 
                } else {
                    die('Qualcosa è andato storto.');
                }
            
        }else{ 
            $this->view('progetti/nuovoProgetto', $data);
        }


    }

    public function aggiungiNdt(){
        
        $data = [
            'title' => 'Form NDT Procedure',
            'progetti'=>$this->projectModel->getAllProgetti(),  
        ]; 
          
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Sanitize POST data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $id = $_GET["idProgetto"]; 

            if(file_exists($_FILES['ndt']['tmp_name']) || is_uploaded_file($_FILES['ndt']['tmp_name'])) {
                $dirProcedura =  str_replace( ' ', '',PUBLICROOT. "/progetti-docs/procedures/ ". $id . "/ ");
                mkdir(  $dirProcedura, 0777, true);
                $caricamentoProcedure = move_uploaded_file($_FILES["ndt"]["tmp_name"], $dirProcedura.$_FILES["ndt"]["name"] );   
            }else{
                    $caricamentoProcedure = true;
            }
            
            if( $caricamentoProcedure ){ 
                //Redirect alla pagina del progetto
                header('location: ' . URLROOT . "/progetti/progetto?id=".$id);
            }
            
        }else{ 
            $this->view('progetti/aggiungiNdt', $data);
        }
    }


    public function aggiungiDisegno(){
        
        $data = [
            'title' => 'Form Disegni',
            'progetti'=>$this->projectModel->getAllProgetti(),  
        ]; 
          
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Sanitize POST data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $id = $_GET["idProgetto"];

            if(file_exists($_FILES['disegni']['tmp_name']) || is_uploaded_file($_FILES['disegni']['tmp_name'])) {
                $dirDisegno = str_replace(' ', '',PUBLICROOT. "/progetti-docs/disegni/ ".$id."/ " );
                mkdir(  $dirDisegno, 0777, true);
                $caricamentoDisegno = move_uploaded_file($_FILES["disegni"]["tmp_name"],  $dirDisegno.$_FILES["disegni"]["name"] );
            }else{
                $caricamentoDisegno = true;
            } 
 
            
            if(  $caricamentoDisegno ){ 
                //Redirect alla pagina del progetto
                header('location: ' . URLROOT . "/progetti/progetto?id=".$id);
            }
            
        }else{ 
            $this->view('progetti/aggiungiDisegno', $data);
        }
    }
    //pagina singolo progetto
    public function progetto(){
        if( isset($_GET["id"])){

            $progetto = $this->projectModel->getProgettoById($_GET["id"]);
            $sonde = $this->sondaModel->getAllSonde();
            $tipiAnomalie = $this->tipiAnomalieModel->getAllTipiAnomalie();
            $reticoli = $this->reticoloModel->getAllReticoli();
            $aree = $this->areaModel->getAreeByProgetto($_GET["id"]);

            $data = [
                'progetto'=>$progetto,
                'tipiAnomalie'=>$tipiAnomalie,
                'aree' => $aree,
                'sonde' => $sonde,
                'reticoli' => $reticoli,
            ]; 
            $this->view('progetti/singoloProgetto', $data);
        }else{ 
           // header('location: ' . URLROOT . "/progetti/index");
        }
    }
 
}
