<?php
include_once 'app/Config.inc.php';
include_once 'app/Conection.inc.php';
include_once 'app/ControlSession.inc.php';

?>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="navbar-header">
                <a class="navbar-brand" href='<?php echo URL_SV?>'>La Grandega Ale</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"  aria-label="Toggle navigation">
                    <span class="sr-only">This button display the navigetion area</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="navbar-item active">
                        <a class="nav-link" href='<?php echo URL_SV?>'>Main page</a>
                    </li>
                    <li class="navbar-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Web</a>
                            <a class="dropdown-item" href="#">Apps</a>
                        </div>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="#">Portafolio</a>
                    </li>
                </ul>
                <ul class="navbar-nav auto">
                    <?php
                    if(ControlSession::isSessionStarted()) {
                        ?>
                        <li class="navbar-item my-2 my-lg-0">
                            <a class="nav-link" href='<?php echo URL_PROFILE;?>'>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <?php echo $_SESSION['username']?>
                            </a>
                        </li>
                        <li class="navbar-item my-2 my-lg-0">
                            <a class="nav-link" href=<?php echo URL_GESTOR;?>>
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                Gestor
                            </a>
                        </li>
                        <li class="navbar-item my-2 my-lg-0">
                            <a class="nav-link" href=<?php echo URL_LOGOUT;?>>
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                Log out
                            </a>
                        </li>
                    <?php
                    } else {
                        ?>
                        <li class="navbar-item my-2 my-lg-0">
                            <a class="nav-link" href='<?php echo URL_REGISTER?>'>Register</a>
                        </li>
                        <li class="navbar-item my-2 my-lg-0">
                            <a class="nav-link" href='<?php echo URL_LOGIN?>'>Login</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    <br>