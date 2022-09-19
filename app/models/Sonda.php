<?php
     class Sonda{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }

          public function inserisci($data) {
               $this->db->query('INSERT INTO sonde (sonda)
                                   VALUES(:sonda )');
          
               $this->db->bind(':sonda', $data['sonda']); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }

          public function getAllSonde(){
               $this->db->query("SELECT * FROM sonde");
               $result = $this->db->resultSet();

               return $result;
          }
     }