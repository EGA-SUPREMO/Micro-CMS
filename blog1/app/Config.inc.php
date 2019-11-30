<?php

define('SVNAME', 'localhost');
define('DBNAME', 'blog');
define('PASSWORD', '');
define('USERNAME', 'root');


define('URL_SV', 'http://localhost/blog/');
define('URL_REGISTER', URL_SV . 'register');
define('URL_REGISTER_CORRECT', URL_SV . 'registerCorrect');
define('URL_LOGIN', URL_SV . 'login');
define('URL_LOGOUT', URL_SV . 'logout');
define('URL_ENTRY', URL_SV . 'entry');


define('URL_GESTOR', URL_SV . 'gestor/');
define('URL_GESTOR_ENTRIES', URL_GESTOR . 'entries');
define('URL_GESTOR_COMMENTS', URL_GESTOR . 'comments');
define('URL_GESTOR_FAVORITES', URL_GESTOR . 'favorites');

define('URL_GESTOR_NEW_ENTRY', URL_GESTOR . 'new_entry');
define('URL_GESTOR_DELETE_ENTRY', URL_GESTOR . 'delete_entry');
define('URL_GESTOR_EDIT_ENTRY', URL_GESTOR . 'edit_entry');


define('URL_RECOVER_PASSWORD', URL_SV . 'recover-password');
define('URL_PASSWORD_RECOVERY', URL_SV . 'password-recovery');
define('URL_GENERATE_SECRET_URL', URL_SV . 'generate-url');


define('URL_SEARCH', URL_SV . 'search');
define('URL_PROFILE', URL_SV . 'profile');


define("DIR_CSS", URL_SV . "/css/");
define("DIR_JS", URL_SV . "/js/");
define("DIR_ROOT", realpath(__DIR__."/.."));