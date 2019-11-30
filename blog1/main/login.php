<?php
include_once 'app/VerifierLogin.inc.php';
include_once 'app/Conection.inc.php';
include_once 'app/ControlSession.inc.php';
include_once 'app/Redirect.inc.php';

if(ControlSession::isSessionStarted()) {
    Redirect::redirectTo(URL_SV);
}

if(isset($_POST['submit'])) {
    Conection::openConection();
    
    $verifier = new VerifierLogin($_POST['email'], $_POST['password'], Conection::getConection());

    if($verifier -> getError() === '') {
        ControlSession::startSession($verifier -> getUser() -> getId(), $verifier -> getUser() -> getName());
        Redirect::redirectTo(URL_SV);
    }
    Conection::closeConection();
}
$title = 'Log in';

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    Inicia secion
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo URL_LOGIN?>">
                        <h2>Introduce your information</h2>
                        <br>
                        <label class="sr-only" for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" <?php
                            if(isset($_POST['submit']) && isset($_POST['email']) && empty($_POST['email'])) {
                                echo 'value = "' . $_POST['email'] . '"';
                            }
                        ?> autofocus required>
                        <br>
                        <label class="sr-only" for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <?php
                        if(isset($_POST['submit'])) {
                            $verifier -> showError();
                        }
                        ?>
                        <br>
                        <button type="submit" class="btn btn-default btn-primary" name="submit">Log in</button>
                    </form>
                    <br>
                    <br>
                    <div class="text-center">
                        <a href="<?php echo URL_RECOVER_PASSWORD; ?>">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'templates/EndPage.inc.php';