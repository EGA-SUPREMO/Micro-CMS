<?php
class User {
    
    private $id;
    private $name;
    private $email;
    private $active;
    private $date;
    private $password;
    
    public function __construct($id, $name, $email, $active, $date, $password) {
        $this -> id = $id;
        $this -> name = $name;
        $this -> email = $email;
        $this -> active = $active;
        $this -> date = $date;
        $this -> password = $password;
        
    }
    
    public function getId() {
        return $this -> id;
    }
    public function getName() {
        return $this -> name;
    }
    public function getEmail() {
        return $this -> email;
    }
    public function getDate() {
        return $this -> date;
    }
    public function IsActive() {
        return $this -> active;
    }
    public function getPassword() {
        return $this -> password;
    }
    public function setName($name) {
        $this -> name = $name;
    }
    public function setEmail($email) {
        $this -> email = $email;
    }
    public function setPassword($password) {
        $this -> password = $password;
    }
    public function setActive($active) {
        $this -> active = $active;
    }
    
}