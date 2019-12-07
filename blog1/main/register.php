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
        <h1 class="text-center">Registration form</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Instructions
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        To join you must enter your username, email, password, the password is recommended to have at least one number or symbol.
                    </p>
                    <br>
                    <a href="<?php echo URL_LOGIN; ?>">Already have an account? Log in</a>
                    <br>
                    <br>
                    <a href="<?php echo URL_RECOVER_PASSWORD; ?>">Forgot your password?</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Enter your information
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