<?php
     //carica il core-controller e formatta URL
     class Core{
          protected $currentController = 'Pages';
          protected $currentMethod = 'index';
          protected $params = [];

          public function __construct(){
               $url = $this->getUrl();

               //se c'è un controller con il primo valore dell url
               if($url!=null){ 
                if(file_exists('../app/controllers/'. ucwords($url[0]). '.php')){
                      //imposta nuovo controller
                      $this->currentController = ucwords($url[0]);
                      unset($url[0]);
                }
               }

               require_once '../app/controllers/'. $this->currentController . '.php';
               $this->currentController = new $this->currentController;
                

               //viene impostato il secondo parametro url come currentMethod
               if(isset($url[1])){
                    if(method_exists($this->currentController, $url[1])){
                         $this->currentMethod = $url[1];
                         unset($url[1]);
                    }
               }
          
               //se ci sono ulteriori parametri vengono inseriti nell'array
               $this->params = $url ? array_values($url) :  [];

               call_user_func_array([$this->currentController, $this->currentMethod],$this->params);
          }

          //ritorna array delle singole parole dell'url 
          public function getUrl (){
               if(isset($_GET['url'])){

                    $url = rtrim($_GET['url'], '/');

                    //Controllo correttezza URL
                    $url = filter_var($url, FILTER_SANITIZE_URL);

                    //vengono divise le sottosringhe dell'url separate da / in un array 
                    $url = explode('/', $url);

                    return $url;
               }
          }
     }
?>