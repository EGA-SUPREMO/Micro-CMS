<?php
include_once 'app/Redirect.inc.php';

if (isset($_POST['savePassword'])) {
    //validar clave 1
    //comprobar si la clave 2 coincide

    //convertir en transaccion
    $encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    Conection::openConection();
    $isUpdated = UsersRepo::updateVar(Conection::getConection(), "password", $userId, $encryptedPassword);
    //eliminar solicitud de recuperación de contraseña
    Conection::closeConection();
    
    //redirigir a notificacion de actualizacion correcta y ofrecer link a login
    if ($isUpdated) {
        Redirect::redirectTo(URL_LOGIN);
    } else {
        //informar del error
        echo 'ERROR';
    }
}


$title = "Password recovery";

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Create a new password</h4>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo URL_PASSWORD_RECOVERY."/".$personalUrl; ?>">
                        <br>
                        <div class="form-group">
                            <label for="password">New password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Least 6 characters" required>
                        </div>

                        <div class="form-group">
                            <label for="password2">Write again the password</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Must be the same" required>
                        </div>
                        <button type="submit" name="savePassword" class="btn btn-lg btn-primary btn-block">
                            Save password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'templates/EndPage.inc.php';