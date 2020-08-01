<?php
include_once 'app/WriterEntries.inc.php';
?>

<div class="row">
	<div class="col-md-12">
		<button class="btn btn-primary form-control" data-toggle="collapse" data-target="#comments">
			<?php echo "See comments (" . count($comments) . ")" ?>
		</button>
		<br>
		<br>
		<div id="comments" class="collapse">
			<?php
				for ($i = 0; $i < count($comments); $i++) {
					$comment = $comments[$i];
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4><?php echo $comment -> getTitle(); ?></h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-2 sidebar text-center">
											<?php
											if(file_exists(DIR_ROOT."/uploaded/".$comment->getIdAuthor())) {
											?>
												<img src="<?php echo URL_SV.'/uploaded/'.$comment->getIdAuthor(); ?>" class="img-fluid">
											<?php
											} else {
											?>
												<img src="img/user.svg" class="img-fluid">
											<?php
											}

            								Conection::openConection();
            								$user = UsersRepo::getUserByString(Conection::getConection(), 'id', $comment->getIdAuthor());
            								echo "<h4>" . $user -> getName()."</h4>";
            								Conection::closeConection();
											?>

										</div>
										<div class="col-md-10 main">
											<p>
												<small><?php echo $comment -> getDate(); ?></small>
											</p>
											<p id="comment<?php echo $i ?>">
												<?php
												if(strlen($comment -> getText()) > 400) {
													echo nl2br(WriterEntries::ReduceText($comment -> getText()));
												?>
												<br>
												<div class="text-center">
													<button id="seeMore<?php echo $i ?>" class="btn btn-primary" role="button" onclick="showMore(<?php echo $i?>, `<?php echo nl2br($comment -> getText());?>`)">Show more</button>
												</div>
												<?php
												} else {
													echo nl2br($comment -> getText());
												}
												?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<?php
				}
			?>
		</div>
	</div>
</div>
