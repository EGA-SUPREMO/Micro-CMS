<?php
include_once 'app/Config.inc.php';
include_once 'app/Conection.inc.php';
include_once 'app/EntriesRepo.inc.php';
include_once 'app/Redirect.inc.php';

if(isset($_POST['deleteEntry'])) {

	Conection :: openConection();

	EntriesRepo :: deleteCommentsAndEntry(Conection :: getConection(), $_POST['id_delete']);

	Conection :: closeConection();

	Redirect :: redirectTo(URL_GESTOR_ENTRIES);
}