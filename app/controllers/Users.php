<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {

        if(!isAdmin()){
            header("location:".URLROOT);
        }

        $data = [
            'nome' => '',
            'cognome' => '',
            'email' => '',
            'password' => '', 
            'role' => '',
            'nomeError' => '', 
            'cognomeError' => '', 
            'confirmPassword' => '',
            'emailError' => '',
            'passwordError' => '', 
            'roleError' => '',
            'confirmPasswordError' => ''
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'nome' => trim($_POST['nome']),
                'cognome' => trim($_POST['cognome']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']), 
                'role' => trim($_POST['role']),
                'nomeError' => '', 
                'cognomeError' => '', 
                'emailError' => '',
                'passwordError' => '', 
                'roleError' => '',
                'confirmPasswordError' => ''
            ];
 
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
 
            //validazione nome
            if (empty($data['nome'])) {
                $data['nomeError'] = 'Inserire username.';
            }

            
            //validazione cognome
            if (empty($data['cognome'])) {
                $data['cognomeError'] = 'Inserire cognome.';
            }

 
            //Validazione email
            if (empty($data['email'])) { 
                $data['emailError'] = 'Inserisci email.';
            }elseif($this->userModel->findUserByEmail($data['email'])) { 
                $data['emailError'] = 'Email già in uso.'; 
            }
 
            // validazione password
            if(empty($data['password'])){
              $data['passwordError'] = 'Inserire password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Deve essere di almeno 6 caratteri';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'La password deve contenere almeno un numero.';
            }

            //validazione confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Riinserire password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Le password non sono uguali!';
                }
            }

            // se non ci sono errori registra l'utente
            if (empty($data['nomeError']) 
                && empty($data['cognomeError']) 
                && empty($data['emailError']) 
                && empty($data['passwordError'])
                && empty($data['confirmPasswordError']) 
                && empty($data['roleError'])
                ) {

                // Hash della password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    //Redirect al login 
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Qualcosa è andato storto.');
                }
            }
        } 
            
        if(isLoggedIn()){  
            $this->view('users/register', $data);
        }else{
            header("location:".URLROOT."/users/login");
        }
        
    }

    public function login() {
        $data = [
            'title' => 'Login page',
            'email' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

       
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            //validazione email
            if (empty($data['email'])) {
                $data['emailError'] = 'Inserire email.';
            }

            //validazione password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Inserire password.';
            }
 
            //se non ci sono errori avvia routine di login
            if (empty($data['emailError']) && empty($data['passwordError'])) {
                
                //constrolla se l'utente esiste
                if( $userExists = $this->userModel->findUserByEmail($data['email'])){
 
                    //richiama il metodo di log
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    
                    //se psw e usrn sono giusti crea sessione dell'utente
                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser); 
                    }
                }

                if(!$userExists || !$loggedInUser ){
                    $data['passwordError'] = 'Password o nome utente incorretti. Riprova.';

                    $this->view('users/login', $data);
                }
            }

        } else {
            $data = [
                'email' => '',
                'password' => '',
                'passwordError' => '',
                'emailError' => ''
            ];
        }
        $this->view('users/login', $data);
    }


    public function changePassword(){
        if(!isLoggedIn()){
            header("location:".URLROOT."/users/login");
        }

        $data = [
            'title' => 'Change password page',
            'id' => '',
            'password' => '',
            'confirmPassword' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => trim($_SESSION['user_id']), 
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),  
                'passwordError' => '', 
                'confirmPasswordError' => ''
            ];
 
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
 
 
            // validazione password
            if(empty($data['password'])){
              $data['passwordError'] = 'Inserire password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Deve essere di almeno 6 caratteri';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'La password deve contenere almeno un numero.';
            }

            //validazione confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Riinserire password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Le password non sono uguali!';
                }
            }

            // se non ci sono errori cambia password all'utente
            if (empty($data['passwordError'])
                && empty($data['confirmPasswordError']) 
                ) {

                // Hash della password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->changePassword($data)) {
                    //Redirect all'index
                    header('location: ' . URLROOT);
                } else {
                    die('Qualcosa è andato storto.');
                }
            }
        } 
            

        $this->view('users/change-password', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->idOperatore;
        $_SESSION['username'] = $user->Nome .  " " .$user->Cognome ; 
        $_SESSION['nome'] = $user->Nome  ; 
        $_SESSION['cognome'] = $user->Cognome ; 
        $_SESSION['email'] = $user->email ; 
        $_SESSION['role'] = $user->ruolo; 
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']); 
        header('location:' . URLROOT . '/users/login');
    }
}
