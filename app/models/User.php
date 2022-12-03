<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO operatori (nome, cognome ,email, password, ruolo)
                             VALUES(:nome, :cognome , :email, :password , :role)');
 
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':cognome', $data['cognome']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']); 
        $this->db->bind(':role', $data['role']);
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($data) {
        $this->db->query('UPDATE operatori
                            SET password = :password
                            WHERE idOperatore = :id ');
 
        $this->db->bind(':id', $data['id']); 
        $this->db->bind(':password', $data['password']); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM operatori WHERE email = :email');
 
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    } 
  
    public function getAll(){
        $this->db->query('SELECT * FROM operatori;');
  
        
        $row = $this->db->resultSet();
 
        if( $row ) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) { 
        $this->db->query('SELECT idOperatore FROM operatori WHERE email = :email');
 
        $this->db->bind(':email', $email); 
        
        $row = $this->db->single();
 
        if( $row && $row->idOperatore > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findIdByUsername($username) { 
        $this->db->query("SELECT idOperatore 
                            FROM   operatori
                            WHERE CONCAT(Nome, ' ', Cognome) = :username");
 
        $this->db->bind(':username', $username); 
        
        $row = $this->db->single();
 
        if( $row && $row->idOperatore > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserById($id) { 
        $this->db->query('SELECT * FROM operatori WHERE idOperatore = :id');
 
        $this->db->bind(':id', $id); 
        
        $row = $this->db->single();
 
        if( $row && $row->idOperatore > 0) {
            return true;
        } else {
            return false;
        }
    }

  
}
