<?php

class PasswordRecoveryRepo {

	public static function generatePetition($connection, $id_user, $secret_url) {
		$generatedPetition = false;

		if (isset($connection)) {
			try {

				$sql = "INSERT INTO password_recovery(id_user, secret_url, created_date) VALUES (:id_user, :secret_url, NOW())" ;

				$comand = $connection -> prepare($sql);

				$comand -> bindParam(':id_user', $id_user, PDO :: PARAM_STR);
				$comand -> bindParam(':secret_url', $secret_url, PDO :: PARAM_STR);

				$generatedPetition = $comand -> execute();
			} catch(PDOException $ex) {
				print 'ERROR' . $ex -> getMessage();
			}
		}
		return $generatedPetition;
	}

	public static function getIdUserBySecretUrl($connection, $secret_url) {
		$idUser = null;
        
        if (isset($connection)) {
            try {
            	include_once 'RecoveryPassword.inc.php';

                $sql = "SELECT * FROM password_recovery WHERE secret_url = :secret_url";
                
                $comand = $connection -> prepare($sql);
                
                $comand -> bindParam(':secret_url', $secret_url, PDO::PARAM_STR);
                
                $comand -> execute();
                
                $result = $comand -> fetch();
                
                if(!empty($result)) {
                	$idUser = $result['id_user'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $idUser;
	}
}