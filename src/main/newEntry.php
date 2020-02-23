<?php

include_once 'app/Config.inc.php';
include_once 'app/Conection.inc.php';
include_once 'app/Entry.inc.php';
include_once 'app/EntriesRepo.inc.php';
include_once 'app/VerifierEntry.inc.php';
include_once 'app/VerifierEditedEntry.inc.php';
$verifier = null;

$drawEntry = 0;
if (isset($_POST['draw']) && $_POST['draw']) {
    $drawEntry = 1;
}

$title = $purpose;

if ($purpose == "Create new entry" && isset($_POST['save'])) {
    Conection :: openConection();
    
    $verifier = new VerifierEntry(Conection::getConection(), $_POST['title'], htmlspecialchars($_POST['content']));
    
    if ($verifier -> isValidEntry()) {
        $entry = new Entry('', $_SESSION['userId'], $verifier -> getTitle(), $verifier -> getContent(), '', $drawEntry);
        
        $insertedEntry = EntriesRepo :: insertEntry(Conection :: getConection(), $entry);
        if ($insertedEntry) {
            Redirect::redirectTo(URL_GESTOR_ENTRIES);
        }
        
    }
    Conection :: closeConection();
} else if($purpose == "Edit entry") {
	Conection :: openConection();

    $entry = EntriesRepo :: getEntryById(Conection::getConection(), $_POST['id_edit']);
    
    $verifier = new VerifierEditedEntry(Conection::getConection(), $entry -> getTitle(), $_POST['title'], htmlspecialchars($entry -> getText()), $_POST['content'], $entry -> isActive(), $_POST['draw']);

    if ($verifier -> isValidEntry() && isset($_POST['save'])) {
        $isUpdated = EntriesRepo :: updateEntry(Conection :: getConection(), $_POST['id_edit'], $verifier -> getTitle(), Entry::getTitleAsUrl2($verifier -> getTitle()), $verifier -> getContent(), $drawEntry);
            
        if ($isUpdated) {
            Redirect::redirectTo(URL_GESTOR_ENTRIES);
        }
        
    }
	Conection :: closeConection();

}

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>


<div class="container">
    <div class="jumbotron">
        <h1 class="text-center"><?php echo $title; ?></h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-new-entry" method="post" action="<?php if($purpose == "Create new entry") echo URL_GESTOR_NEW_ENTRY; else echo URL_GESTOR_EDIT_ENTRY; ?>">
                <?php
                include_once 'templates/Form_new_entry.inc.php';
                    
                ?>
            </form> 
        </div>
    </div>
</div>

<?php
include_once 'templates/EndPage.inc.php';
?>