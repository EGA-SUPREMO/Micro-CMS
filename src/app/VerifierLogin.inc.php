<?php

include_once 'app/UsersRepo.inc.php';

class VerifierLogin {

    private $user;
    private $error;
    private $alertBegin;
    private $alertEnd;

    public function __construct($email, $password, $conection) {
        $this -> error = "";

        if (!$this->isSet($email) || !$this->isSet($password)) {
            $this -> user = null;
            $this -> error = 'Must write your email and password';
        } else {
            $this -> user = UsersRepo::getUserByString($conection, 'email', $email);
            if(is_null($this -> user) || !password_verify($password, $this -> user -> getPassword())) {
                $this->error = 'Wrong password or email';
            }
        }
    }

    private function isSet($var) {
        if (isset($var) && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser() {
        return $this->user;
    }

    public function getError() {
        return $this->error;
    }

    public function showError() {
        if ($this->error !== '') {
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this -> error;
            echo "</div>";
        }
    }

}
