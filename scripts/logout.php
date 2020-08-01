<?php

include_once 'app/ControlSession.inc.php';
include_once 'app/Redirect.inc.php';
include_once 'app/Config.inc.php';

ControlSession :: closeSession();
Redirect :: redirectTo(URL_SV);
