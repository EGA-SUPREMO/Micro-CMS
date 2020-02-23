<?php
include_once 'app/Config.inc.php';
include_once 'app/Redirect.inc.php';

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">
                    Registro correcto
                </div>
                <div class="card-body">
                    <p>Gracias por registrarte<b> <?php echo $name?></b>.</p>
                    <br>
                    <p><a href='<?php echo URL_LOGIN?>'>Inicia Secion</a> para poder comenzar a usar tu cuenta</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'templates/EndPage.inc.php';
?>