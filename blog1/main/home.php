<?php

include_once 'app/WriterEntries.inc.php';

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1>Pagina EXTRA OFICIAL DE EGA</h1>
        <p>
            La mejor pagina jamas creada por el mejor programador html de la historia
        </p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Busqueda
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form class="form-inline" action="<?php echo URL_SEARCH; ?>" method='GET'>
                                    <input class="form-control mr-sm-2" type="search" placeholder="Que buscas" aria-label="Search" name="q">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <?php
            Conection::openConection();
            WriterEntries::writeEntry();
            Conection::closeConection();
            ?>
        </div>
    </div>
</div>
<?php
include_once 'templates/EndPage.inc.php';
?>