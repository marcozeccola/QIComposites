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
            
            $data =[
                'nome'=>trim($_POST["nome"]),
                'inizio'=>trim($_POST["inizio"]),
                'progettista'=>trim($_POST["progettista"]), 
                'errorNome'=>'',
                'errorInizio'=>'',
                'errorProgettista'=>'',
            ];

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if(empty($data["nome"])){
                $data["errorNome"]="Inserire il nome del progetto";
            }

            if(empty($data["inizio"])){
                $data["errorInizio"]="Inserire data inizio del progetto"; 
            }

            if(empty($data["progettista"])){
                $data["errorProgettista"]="Inserire il nome del progettista"; 
            }

            if(empty($data["errorNome"])&&
                empty($data["errorInizio"])&&
                empty($data["errorProgettista"])
            ){
                if ($id = $this->projectModel->inserisci($data)) {
                    

                    if(file_exists($_FILES['copertina']['tmp_name']) || is_uploaded_file($_FILES['copertina']['tmp_name'])) {
                        $dirCopertina =  str_replace(' ', '',  PUBLICROOT. "\progetti-docs\copertine\ ".$id."\ ");
                        mkdir(  $dirCopertina, 0777, true);
                        $caricamentoCopertina = move_uploaded_file($_FILES["copertina"]["tmp_name"],    $dirCopertina.$_FILES["copertina"]["name"]);
                    }else{
                        $caricamentoCopertina = true;
                    }

                    if(file_exists($_FILES['disegni']['tmp_name']) || is_uploaded_file($_FILES['disegni']['tmp_name'])) {
                        $dirDisegno = str_replace(' ', '',PUBLICROOT. "\progetti-docs\disegni\ ".$id."\ " );
                        mkdir(  $dirDisegno, 0777, true);
                        $caricamentoDisegno = move_uploaded_file($_FILES["disegni"]["tmp_name"],  $dirDisegno.$_FILES["disegni"]["name"] );
                    }else{
                        $caricamentoDisegno = true;
                    } 

                    if(file_exists($_FILES['ndt']['tmp_name']) || is_uploaded_file($_FILES['ndt']['tmp_name'])) {
                        $dirProcedura =  str_replace( ' ', '',PUBLICROOT. "\progetti-docs\procedures\ ". $id . "\ ");
                        mkdir(  $dirProcedura, 0777, true);
                        $caricamentoProcedure = move_uploaded_file($_FILES["ndt"]["tmp_name"], $dirProcedura.$_FILES["ndt"]["name"] );   
                    }else{
                         $caricamentoProcedure = true;
                    }
                    
                    if( $caricamentoCopertina && $caricamentoDisegno &&  $caricamentoProcedure ){ 
                        //Redirect alla pagina di progetti 
                        header('location: ' . URLROOT . "/progetti/index");
                    }
 
                } else {
                    die('Qualcosa è andato storto.');
                }
            }
        }else{ 
            $this->view('progetti/nuovoProgetto', $data);
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
