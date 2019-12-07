<?php
$title = "Recover Password";

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    Recover Password
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo URL_GENERATE_SECRET_URL?>">
                        <h2>Introduce your email</h2>
                        <br>
                        <p>Introduce your email and we will send you an email which you will be able to reset your password</p>
                        <label class="sr-only" for="email">Email</label>
                        <input type="email" placeholder="Email" class="form-control" name="email" <?php
                            if(isset($_POST['submit']) && isset($_POST['email']) && empty($_POST['email'])) {
                                echo 'value = "' . $_POST['email'] . '"';
                            }
                        ?> autofocus required>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-default btn-primary" name="sendRecovery">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'templates/EndPage.inc.php';