<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: ". gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$title = "Profile";

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';

Conection::openConection();
$user = UsersRepo :: getUserByString(Conection::getConection(), 'id', $_SESSION['userId']);
Conection::closeConection();

if(isset($_POST['saveImage']) && !empty($_FILES['uploadedFile']['tmp_name'])) {
	$dir = DIR_ROOT."/uploaded/";
	$targetDir = $dir.basename($_FILES['uploadedFile']['name']);
	$hasErrors = 1;
	$imageType = pathinfo($targetDir, PATHINFO_EXTENSION);
	
	if ($_FILES['uploadedFile']['size'] > 1000000) {
		echo "<div class=\"alert alert-warning\" role=\"alert\">The image cannot be more than 1Mb</div>";
		$hasErrors = 0;
	}
	
	if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
		echo "<div class=\"alert alert-warning\" role=\"alert\">Only formants JPG, JPEG, PNG or GIF</div>";
		$hasErrors = 0;
	}
	
	if ($hasErrors == 0) {
		echo "<div class=\"alert alert-warning\" role=\"alert\">Your image cannot be uploaded</div>";
	} else {
		if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'],
		DIR_ROOT."/uploaded/".$user->getId())) {
			echo "<div class=\"alert alert-success\" role=\"alert\">The image ".basename($_FILES['uploadedFile']['name'])." was uploaded successfully.</div>";
		} else {
			echo "<div class=\"alert alert-danger\" role=\"alert\">There is an error.</div>";
		}
	}
}

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
			<br>
			<form class="text-center" action="<?php echo URL_PROFILE; ?>" method="post"
			enctype="multipart/form-data">
				<label for="uploadedFile" id="labelFile">Upload an image</label>
				<input type="file" name="uploadedFile" id="uploadedFile" class="btn-upload">
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
