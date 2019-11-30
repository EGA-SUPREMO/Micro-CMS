<?php

Conection::openConection();
$user = UsersRepo :: getUserByString(Conection::getConection(), 'id', $_SESSION['userId']);
Conection::closeConection();

if(isset($_POST['saveImage']) && !empty($_FILES['uploadedFile']['tmp_name'])) {
	$dir = DIR_ROOT."\uploaded\\";
	$targetDir = $dir.basename($_FILES['uploadedFile']['name']);
	$hasErrors = 1;
	$imageType = pathinfo($targetDir, PATHINFO_EXTENSION);
	
	if ($_FILES['uploadedFile']['size'] > 500000) {
		echo "The image cannot be more than 500kb";
		$hasErrors = 0;
	}
	
	if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
		echo "Only formants JPG, JPEG, PNG y GIF";
		$hasErrors = 0;
	}
	
	if ($hasErrors == 0) {
		echo "Your image cannot be uploaded";
	} else {
		if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'],
		DIR_ROOT."\uploaded\\".$user->getId())) {
			echo "The image ".basename($_FILES['uploadedFile']['name'])." was uploaded succefully.";
		} else {
			echo "There is an error.";
		}
	}
}

$title = "Profile";

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container profile">
	<div class="row">
		<div class="col-md-3">
			<?php
				if(file_exists(DIR_ROOT."/uploaded/".$user->getId())) {
					?>
						<img src="<?php echo URL_SV.'/uploaded/'.$user->getId(); ?>" class="img-fluid">
					<?php
				} else {
					?>
						<img src="img/user.svg" class="img-fluid">
					<?php
				}
			?>
			
			<br>
			<form class="text-center" action="<?php echo URL_PROFILE; ?>" method="post"
			enctype="multipart/form-data">
				<label for="uploadedFile" id="labelFile">Upload an image</label>
				<input type="file" name="uploadedFile" id="uploadedFile" class="btn-upload">
				<br>
				<br>
				<input type="submit" value="Save" name="saveImage" class="form-control">
			</form>
		</div>
		<div class="col-md-9">
			<h4><small>Username</small></h4>
			<h4><?php echo $user -> getName(); ?></h4>
			<br>
			<h4><small>Email</small></h4>
			<h4><?php echo $user -> getEmail(); ?></h4>
			<br>
			<h4><small>Created from</small></h4>
			<h4><?php echo $user -> getDate(); ?></h4>
		</div>
	</div>
</div>
<?php
include_once 'templates/EndPage.inc.php';
