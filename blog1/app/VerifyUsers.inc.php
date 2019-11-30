<?php

include_once 'UsersRepo.inc.php';

class VerifyUsers {
    
    private $email;
    private $name;
    private $password;


    private $nameError;
    private $emailError;
    private $passwordError;
    private $password2Error;
    
    private $alertBegin;
    private $alertEnd;


    public function __construct($name, $email, $password, $password2, $conection) {
        $this->alertBegin = '<br><div class="alert alert-danger" role="alert">';
        $this->alertEnd = "</div>";
        
        $this -> name = '';
        $this -> email = '';
        $this-> password = '';
        
        $this->nameError = $this-> verifyName($name, $conection);
        $this->emailError = $this-> verifyEmail($email, $conection);
        $this->passwordError = $this-> verifyPassword($password);
        $this->password2Error = $this-> verifyPassword2($password, $password2);
    }
    
    private function isSet($var) {
        if(isset($var) && empty($var)) {
            return false;
        } else {
            return true;
        }
    }
    
    private function verifyName($name, $conection) {
        if($this -> isSet($name)) {
            $this -> name = $name;
        } else {
            return 'Debes escribir un nombre.';
        }
        if(UsersRepo::existUnique($conection , 'name', $name)) {
            return 'El nombre de usuario ya existe, usa otro, pls.';
        }
        
        if(strlen($name)<4) {
            return 'El nombre debe ser mayor a 4 cararteres, pls.';
        }
        if(strlen($name)>24) {
            return 'El nombre debe ser menor a 24 cararteres, pls.';
        }
        
        return '';
    }
    
    private function verifyEmail($email, $conection) {
        if($this -> isSet($email)) {
            $this -> email = $email;
        } else {
            return 'Debes escribir un email.';
        }
        
        if(UsersRepo::existUnique($conection , 'email', $email)) {
            return 'El email ya existe, si olvidaste tu contrasena <a href="#">pulsa aqui<a> sino, usa otro, pls.';
        }
        return '';
    }
    
    private function verifyPassword($password) {
        if($this -> isSet($password)) {
        } else {
            return 'Debes escribir una contrasena.';
        }
        return '';
    }
    
    private function verifyPassword2($password, $password2) {
        if(!$this -> isSet($password2)) {
            return 'Debes repetir tu contrasena, plis';
        } else if($password!==$password2) {
            return 'Las contrasenas deben coincidir.';
        }
        $this->password = $password;
        
        return '';
    }
    
    public function getName() {
        return $this -> name;
    }
    
    public function getEmail() {
        return $this -> email;
    }
    public function getPassword() {
        return $this -> password;
    }
    public function getNameError() {
        return $this -> nameError;
    }
    public function getEmailError() {
        return $this -> emailError;
    }
    public function getPasswordError() {
        return $this -> passwordError;
    }
    public function getPassword2Error() {
        return $this -> password2Error;
    }
    public function showName() {
        if($this->name!=='') {
            echo 'value="' . $this -> name . '"';
        }
    }
    public function showEmail() {
        if($this->email!=='') {
            echo 'value="' . $this -> email . '"';
        }
    }
    public function showNameError() {
        if($this->nameError!=='') {
            echo $this->alertBegin . $this -> nameError . $this->alertEnd;
        }
    }
    public function showEmailError() {
        if($this->emailError!=='') {
            echo $this->alertBegin . $this -> emailError . $this->alertEnd;
        }
    }
    public function showPasswordError() {
        if($this->passwordError!=='') {
            echo $this->alertBegin . $this -> passwordError . $this->alertEnd;
        }
    }
    public function showPassword2Error() {
        if($this->password2Error!=='') {
            echo $this->alertBegin . $this -> password2Error . $this->alertEnd;
        }
    }
    public function isValid() {
        return ($this->nameError==='' && $this->emailError==='' && $this->passwordError===''
                && $this->password2Error==='');
    }
}