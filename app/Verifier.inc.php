<?php
class Verifier {

	protected $alertBegin;
	protected $alertEnd;	
	
	protected $title;
	protected $content;
	
	protected $titleError;
	protected $contentError;

	function __construct() {		
	}

    protected function isSet($var) {
        if (isset($var) && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }
	protected function verifyTitle($conection, $title) {
		if ($this -> isSet($title)) {
			$this -> title = $title;
		} else {
			return "You must write a title";
		}
		
		if (strlen($title) > 255) {
			return "The title has to be less than 255 charaters long.";
		}
		
		if (EntriesRepo :: existEntryByTitle($conection, $title)) {
			return "The title is already used, please choose another.";
		}
	}
	
	protected function verifyContent($conection, $content) {
		if ($this -> isSet($content)) {
			$this -> content = $content;
		} else {
			return "The content cannot be empty!";
		}
	}
	
	public function getTitle() {
		return $this -> title;
	}
	 
	public function getContent() {
		return $this -> content;
	}
	
	public function showTitle() {
		if ($this -> title != "") {
			echo 'value = "' . $this -> title . '"';
		}
	}

	public function showContent() {
		if ($this -> content != "" && strlen(trim($this -> content)) > 0) {
			echo $this -> content;
		}
	}
	
	public function showTitleError() {
		if ($this -> titleError != "") {
			echo $this -> alertBegin . $this -> titleError . $this -> alertEnd;
		}
	}
	
	public function showContentError() {
		if ($this -> contentError != "") {
			echo $this -> alertBegin . $this -> contentError . $this -> alertEnd;
		}
	}
	
	public function isValidEntry() {
		if ($this -> titleError == "" && $this -> contentError == "") {
			return true;
		} else {
			return false;
		}
	}
}