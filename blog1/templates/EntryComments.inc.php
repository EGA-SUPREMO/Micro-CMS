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
					<script type="text/javascript">var nunText = comment -> getText();</script>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<?php echo $comment -> getTitle(); ?>
								</div>
								<div class="card-body">
									<div class="col-md-2 sidebar">
										<?php echo $comment -> getIdAuthor(); ?>
									</div>
									<div class="col-md-10 main">
										<p>
											ENCHUENTRa UNa SOLUCION a ESTO!!!1.
											<?php echo $comment -> getDate(); ?>
										</p>
										<p id="comment<?php echo $i ?>">
											<?php
											if(strlen($comment -> getText()) > 400) {
												echo nl2br(WriterEntries::ReduceText($comment -> getText()));
											?>
											<br>
											<div class="text-center">
												<button id="seeMore<?php echo $i ?>" class="btn btn-primary" role="button" onclick="
													document.getElementById('seeMore<?php echo $i?>').value = 'Hide'
													document.getElementById('seeMore<?php echo $i?>').style.display='none'
													document.getElementById('comment<?php echo $i?>').innerHTML = '<?php echo nl2br("UIO") ?>'
												">See more</button>
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
					
					<?php
				}
			?>
		</div>
	</div>
</div>
