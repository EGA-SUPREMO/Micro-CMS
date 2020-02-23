<?php
class Comment {
    
    private $id;
    private $title;
    private $idAuthor;
    private $idEntry;
    private $active;
    private $date;
    private $text;
    
    public function __construct($id, $idAuthor, $idEntry, $title, $text, $date, $active) {
        $this -> id = $id;
        $this -> title = $title;
        $this -> idAuthor = $idAuthor;
        $this -> idEntry = $idEntry;
        $this -> active = $active;
        $this -> date = $date;
        $this -> text = $text;
        
    }
    
    public function getId() {
        return $this -> id;
    }
    public function getTitle() {
        return $this -> title;
    }
    public function getIdAuthor() {
        return $this -> idAuthor;
    }
    public function getIdEntry() {
        return $this -> idEntry;
    }
    public function getDate() {
        return $this -> date;
    }
    public function IsActive() {
        return $this -> active;
    }
    public function getText() {
        return $this -> text;
    }
    public function setTitle($name) {
        $this -> title = $name;
    }
    public function setIdAuthor($idAuthor) {
        $this -> idAuthor = $idAuthor;
    }
    public function setIdEntry($idEntry) {
        $this -> idEntry = $idEntry;
    }
    public function setText($text) {
        $this -> text = $text;
    }
    public function setActive($active) {
        $this -> active = $active;
    }
    
}