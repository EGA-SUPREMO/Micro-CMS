<?php

include_once 'app/Config.inc.php';
include_once 'app/Conection.inc.php';

include_once 'app/User.inc.php';

include_once 'app/UsersRepo.inc.php';
include_once 'app/PasswordRecoveryRepo.inc.php';

include_once 'app/Redirect.inc.php';

function getHazardString($long) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $hazardString = '';
    
    for ($i = 0; $i < $long; $i++) {
        $hazardString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $hazardString;
}

if (isset($_POST['sendRecovery'])) {
	Conection::openConection();

	$user = UsersRepo:: getUserByString(Conection::getConection(), "email", $_POST['email']);

	if (!isset($user)) {
		Redirect :: redirectTo(URL_SV);
		return;
	}

	$secretUrl = hash('sha256', getHazardString(10) . $user -> getName());
	
	$generatedPetition = PasswordRecoveryRepo :: generatePetition(Conection :: getConection(), $user -> getId(), $secretUrl);

	Conection :: closeConection();
//Notificar al usuario plis de intruciones
	Redirect :: redirectTo(URL_SV);
}
Redirect :: redirectTo(URL_SV);