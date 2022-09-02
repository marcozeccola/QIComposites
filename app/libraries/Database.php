<?php
     class Database{
          private $dbHost = DB_HOST;
          private $dbUser = DB_USER;
          private $dbPass = DB_PASS;
          private $dbName = DB_NAME;

          private $statement;
          private $dbHandler;
          private $error;

          //connesione al database
          public function __construct() {
               $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
               $options = array(
                    //meorizza connesione al db nella cache e viene riutilizzata
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
               );

               try {
                    $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
               } catch (PDOException $e) {
                    $this->error = $e->getMessage();
                    echo $this->error;
               }
          }

          //crea prepared statement
          public function query($sql){
               $this->statement = $this->dbHandler->prepare($sql);
          }

          //fa la bind nel prepared statement
          public function bind($param, $value, $type = null) {
               switch (is_null($type)) {
                   case is_int($value):
                       $type = PDO::PARAM_INT;
                       break;
                   case is_bool($value):
                       $type = PDO::PARAM_BOOL;
                       break;
                   case is_null($value):
                       $type = PDO::PARAM_NULL;
                       break;
                   default:
                       $type = PDO::PARAM_STR;
               }
               $this->statement->bindValue($param, $value, $type);
          }

          //esegue query
          public function execute() {
               return $this->statement->execute();
          }
          
          //ritorna array dei risultati ultima query
          public function resultSet() {
               $this->execute();
               return $this->statement->fetchAll(PDO::FETCH_OBJ);
          }
    
          //rintorna singola riga ultima query
          public function single() {
               $this->execute();
               return $this->statement->fetch(PDO::FETCH_OBJ);
          }
    
          //ritorna n. righe ultima query NO SELECT
          public function rowCount() {
               return $this->statement->rowCount();
          }
 
          public function fetchColumn(){
               return $this->statement->fetchColumn();
          }

          //ritorna ultimo id Della insert
          public function lastinsertid(){
               return $this->dbHandler->lastInsertId();
          }
     }
?>