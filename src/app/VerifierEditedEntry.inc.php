<?php
include_once 'EntriesRepo.inc.php';
include_once 'Verifier.inc.php';

class VerifierEditedEntry extends Verifier {
	
	private $edited;

	public function __construct($conection, $title, $oldTitle, $content, $oldContent, $active, $oldActive) {
		$this -> alertBegin = "<br><div class='alert alert-danger' role='alert'>";
		$this -> alertEnd = "</div><br>";
		
		$this -> title = $oldTitle;
		$this -> content = $oldContent;
		$this -> edited = false;

		if($title != $oldTitle) {
			$this -> titleError = $this -> verifyTitle($conection, $oldTitle);
			$this -> edited = true;
		}
		if($content != $oldContent) {
			$this -> contentError = $this -> verifyContent($conection, $oldContent);
			$this -> edited = true;
		}
		if($active != $oldActive) {
			$this -> edited = true;
		}
	}

	public function getEdited() {
		return $this -> edited;
	}
}