<?php
session_start();

error_reporting(E_ERROR | E_PARSE);

include_once 'app/Config.inc.php';
include_once 'app/Conection.inc.php';

include_once 'app/User.inc.php';
include_once 'app/Entry.inc.php';
include_once 'app/Comment.inc.php';

include_once 'app/UsersRepo.inc.php';
include_once 'app/EntriesRepo.inc.php';
include_once 'app/CommentsRepo.inc.php';
include_once 'app/PasswordRecoveryRepo.inc.php';

include_once 'app/ControlSession.inc.php';
include_once 'app/Redirect.inc.php';

$componentes_url = parse_url($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);

$path = $componentes_url['path'];

$pathParts = explode('/', $path);
$pathParts = array_filter($pathParts);
$pathParts = array_slice($pathParts, 0);

$pathElected = 'main/404.php';
$title = 'Blog';

if ($pathParts[0] == 'testtoshowskills.000webhostapp.com') {
	if (count($pathParts) == 1) {
        $pathElected = 'main/home.php';
    } else if(count($pathParts)==2) {
    	switch ($pathParts[1]) {
    		case 'login':
                if (ControlSession :: isSessionStarted()) {
                    Redirect::redirectTo(URL_SV);
                } else {
                    $pathElected = 'main/login.php';
                }
    			break;
            case 'register':
                if (ControlSession :: isSessionStarted()) {
                    Redirect::redirectTo(URL_SV);
                } else {
                    $pathElected = 'main/register.php';
                }
                break;
            case 'logout':
                $pathElected = 'scripts/logout.php';
                break;
            case 'generate-url':
                $pathElected = 'scripts/generateSecretUrl.php';
                break;
            case 'recover-password':
                $pathElected = 'main/recoverPassword.php';
                break;
            case 'gestor':
                if (ControlSession :: isSessionStarted()) {
                    $pathElected = 'main/gestor.php';
                    $nowgestor = '';
                } else {
                    Redirect::redirectTo(URL_LOGIN);
                }
                break;
            case 'search':
                $pathElected = 'main/search.php';
                break;
            case 'profile':
                if (ControlSession :: isSessionStarted()) {
                    $pathElected = 'main/profile.php';
                } else {
                    Redirect::redirectTo(URL_LOGIN);
                }
                break;
    		default:
    			break;
    	}
    } else if(count($pathParts)==3) {
    	switch ($pathParts[1]) {
    		case 'registerCorrect':
                if (ControlSession :: isSessionStarted()) {
        			$name = $pathParts[2];
                    $pathElected = 'main/registerCorrect.php';
                } else {
                    Redirect::redirectTo(URL_SV);
                }
                break;
            case 'entry':
            	$pathElected = 'main/entry.php';

            	Conection::openConection();
            	$entry = EntriesRepo::getEntriesByUrl(Conection::getConection(), $pathParts[2]);
            	
            	if($entry != null) {
            		$author = UsersRepo::getUserByString(Conection::getConection(), 'id', $entry -> getIdAuthor());
            		$hazard_entries = EntriesRepo::getEntriesByHazard(Conection::getConection(), 3);
					$comments = CommentsRepo::getCommentsByIdEntry(Conection::getConection(), $entry -> getId());
				}
            	Conection::closeConection();
            	break;

            case 'gestor':
                if (ControlSession :: isSessionStarted()) {
                    $nowgestor = $pathParts[2];
                    switch ($nowgestor) {
                        case 'new_entry':
                            $purpose = 'Create new entry';
                            $pathElected = 'main/newEntry.php';
                            break;
                        case 'edit_entry':
                            $purpose = 'Edit entry';
                            $pathElected = 'main/newEntry.php';
                            break;
                        case 'delete_entry':
                            $pathElected = 'scripts/DeleteEntry.php';
                            break;
                    
                        default:
                            $pathElected = 'main/gestor.php';
                            break;
                    }
                } else {
                    Redirect::redirectTo(URL_LOGIN);
                }

                break;

            case 'password-recovery':
                $personalUrl = $pathParts[2];

                Conection::openConection();
                $userId = PasswordRecoveryRepo::getIdUserBySecretUrl(Conection::getConection(), $personalUrl);
                Conection::closeConection();

                if (isset($userId)) {
                    $pathElected = 'main/passwordRecovery.php';
                }
                break;
    	}
    }
}

include_once $pathElected;