<?php
     class Reticolo{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }

          public function inserisci($reticolo) {
               $this->db->query('INSERT INTO reticoli (nome)
                                   VALUES(:reticolo )');
          
               $this->db->bind(':reticolo', $reticolo); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }

          public function getAllReticoli(){
               $this->db->query("SELECT * FROM reticoli");
               $result = $this->db->resultSet();

               return $result;
          }
          
          public function deleteReticoloById($id){
               $this->db->query("DELETE FROM reticoli WHERE idReticolo = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
     }