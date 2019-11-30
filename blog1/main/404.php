<?php

include_once 'app/WriterEntries.inc.php';

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';

header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found", true, 404);
echo 'La página no existe';
?>
No hay nada que ver.
<?php
include_once 'templates/EndPage.inc.php';
?>