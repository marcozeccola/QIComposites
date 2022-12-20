<?php
     class Strumento{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }

          public function inserisci($strumento) {
               $this->db->query('INSERT INTO strumenti (strumento)
                                   VALUES(:strumento )');
          
               $this->db->bind(':strumento', $strumento); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }

          public function getAllStrumenti(){
               $this->db->query("SELECT * FROM strumenti");
               $result = $this->db->resultSet();

               return $result;
          }
          
          public function deleteStrumentoById($id){
               $this->db->query("DELETE FROM strumenti WHERE idStrumento = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
     }