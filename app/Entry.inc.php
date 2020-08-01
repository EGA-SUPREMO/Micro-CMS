<?php
class Entry {
    
    private $id;
    private $title;
    private $idAuthor;
    private $active;
    private $date;
    private $text;
    private $url;
    
    public function __construct($id, $idAuthor, $title, $text, $date, $active) {
        $this -> id = $id;
        $this -> title = $title;
        $this -> idAuthor = $idAuthor;
        $this -> active = $active;
        $this -> date = $date;
        $this -> text = $text;
        $this -> url = self::getTitleAsUrl();
    }
    
    public function getId() {
        return $this -> id;
    }
    public function getUrl() {
        return $this -> url;
    }
    public function getTitleAsUrl() {
        return urlencode($this -> title);
    }
    public static function getTitleAsUrl2($title) {
        return $title;
    }
    public function getTitle() {
        return $this -> title;
    }
    public function getIdAuthor() {
        return $this -> idAuthor;
    }
    public function getDate() {
        return $this -> date;
    }
    public function isActive() {
        return $this -> active;
    }
    public function getText() {
        return $this -> text;
    }
    public function setTitle($name) {
        $this -> title = $name;
        $this -> url = self::getTitleAsUrl();
    }
    public function setIdAuthor($idAuthor) {
        $this -> idAuthor = $idAuthor;
    }
    public function setText($text) {
        $this -> text = $text;
    }
    public function setActive($active) {
        $this -> active = $active;
    }
    
}