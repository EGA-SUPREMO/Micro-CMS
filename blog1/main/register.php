<?php
include_once 'app/VerifyUsers.inc.php';
include_once 'app/Conection.inc.php';
include_once 'app/UsersRepo.inc.php';
include_once 'app/Redirect.inc.php';
include_once 'app/User.inc.php';

if(isset($_POST['submit'])) {
    Conection::openConection();
    
    $verifier = new VerifyUsers($_POST['name'], $_POST['email'], $_POST['password'],
            $_POST['password2'], Conection::getConection());
    
    if($verifier -> isValid()) {
        $user = new User('', $verifier -> getName(), $verifier -> getEmail(), '', '',  password_hash($verifier -> getPassword(), PASSWORD_DEFAULT));
        
        if(UsersRepo::insertUser(Conection::getConection(), $user)) {
            Redirect::redirectTo(URL_REGISTER_CORRECT . '/' . $user -> getName());
        }
    }
    
    Conection::closeConection();
}

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Formulario de registro</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Intrucciones
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        Para unirte debes poner tu nombre de usuario, email, contrasena, esta ultima es recomendado tener al menos un numero.
                    </p>
                    <br>
                    <a href="<?php echo URL_LOGIN; ?>">Ya tienes cuenta?</a>
                    <br>
                    <br>
                    <a href="<?php echo URL_RECOVER_PASSWORD; ?>">Olvidaste tu contrasena?</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Intruduces tus datos
                    </h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo URL_REGISTER?>">
                        <?php
                        if(isset($_POST['submit'])) {
                            include_once 'templates/VerifiedRegister.inc.php';
                        } else {
                            include_once 'templates/RegisterEmpty.inc.php';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'templates/EndPage.inc.php';
?>