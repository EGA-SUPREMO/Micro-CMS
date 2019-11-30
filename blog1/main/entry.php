<?php


include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';

?>

<div class="container content-article">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <?php echo $entry -> getTitle();?>
            </h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p>
                By
                <a href="#">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $author -> getName(); ?>
                </a>
                at
                <?php echo $entry -> getDate(); ?>
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <article class="text-justify">
                <?php echo nl2br($entry -> getText());?>
            </article>
        </div>
    </div>
    <br>
    <?php
    include_once 'templates/hazardEntries.inc.php';
    ?>
    <br>
    <?php
    if (count($comments)) {
        include_once 'templates/EntryComments.inc.php';
    } else {
        echo '<p>There is not comments, be the first<h>I study English with OpenEnglish.</h></p>';
    }
    ?>
</div>
<br>

<?php
include_once 'templates/EndPage.inc.php';
?>