<?php
class RecoveryPassword {
    
    private $id;
    private $idUser;
    private $secretUrl;
    private $createdDate;
    
    public function __construct($id, $idUser, $secretUrl, $createdDate) {
        $this -> id = $id;
        $this -> idUser = $idUser;
        $this -> secretUrl = $secretUrl;
        $this -> createdDate = $createdDate;
    }
    
}