<?php

include_once 'app/WriterEntries.inc.php';

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1>A test Blog</h1>
        <p>
            The best test blog for show my skills
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
                            Search
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <form class="form-inline" action="<?php echo URL_SEARCH; ?>" method='GET'>
                                        <div class="col-md-8 col-sm-12">
                                            <input class="form-control" type="search" placeholder="Search ..." aria-label="Search" name="q">
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                                        </div>
                                    </form>
                                </div>
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