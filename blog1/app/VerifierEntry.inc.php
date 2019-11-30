<?php
include_once 'EntriesRepo.inc.php';
include_once 'Verifier.inc.php';

class VerifierEntry extends Verifier {
	
	public function __construct($conection, $title, $content) {
		$this -> alertBegin = "<br><div class='alert alert-danger' role='alert'>";
		$this -> alertEnd = "</div><br>";
		
		$this -> title = "";
		$this -> content = "";
		
		$this -> titleError = $this -> verifyTitle($conection, $title);
		$this -> contentError = $this -> verifyContent($conection, $content);
	}
}