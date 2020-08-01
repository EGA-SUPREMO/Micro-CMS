<?php
Conection::openConection();
$activeEntriesAmount = EntriesRepo :: getNumberEntriesByUser(Conection::getConection(), $_SESSION['userId'], 0);
$inactiveEntriesAmount = EntriesRepo :: getNumberEntriesByUser(Conection::getConection(), $_SESSION['userId'], 1);

$commentsAmount = CommentsRepo :: getNumberCommentsByUser(Conection::getConection(), $_SESSION['userId'], 0);

Conection::closeConection();
?>

<div class="row text-center">
	<div class="col-md-4 gg-element" id="gg-entries">
		<h2><i class="fa fa-newspaper-o" aria-hidden="true"></i></h2>
		<h3>Entries</h3>
		<hr>
		<h4><?php echo $activeEntriesAmount; ?></h4>
		<h5>Posted entries</h5>
		<br>
		<h4><?php echo $inactiveEntriesAmount; ?></h4>
		<h5>Draws</h5>
	</div>
	<div class="col-md-4 gg-element" id="gg-comments">
		<h2><i class="fa fa-comments" aria-hidden="true"></i></h2>
		<h3>Comments</h3>
		<hr>
		<h4><?php echo $commentsAmount; ?></h4>
		<h5>Written comments</h5>
	</div>
	<div class="col-md-4 gg-element" id="gg-favorites">
		<h2><i class="fa fa-star" aria-hidden="true"></i></h2>
		<h3>Favorites</h3>
		<hr>
		<h4>-</h4>
		<h5>Favorites entries</h5>
		<br>
		<h4>-</h4>
		<h5>Favorites authors</h5>
	</div>
</div>
