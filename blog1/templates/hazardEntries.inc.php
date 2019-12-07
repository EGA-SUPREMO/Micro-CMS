<?php
include_once 'app/WriterEntries.inc.php';
?>

<div class="row">
	<div class="col-md-12">
		<hr>
		<h3>Other interesting entries</h3>
	</div>
	
	<?php
		for ($i = 0; $i < count($hazard_entries); $i++) {
			$nowEntry = $hazard_entries[$i];
		?>
		<div class="col-md-4">
                <div class="card">
                    <div class="card-header">
					<?php echo $nowEntry -> getTitle(); ?>
				</div>
				<div class="card-body">
					<p>
						<?php echo nl2br(WriterEntries::reduceText($nowEntry -> getText())); ?>
					</p>
                    <div class="text-center">
                        <a class="btn btn-primary" href=<?php echo URL_ENTRY . "/" . $nowEntry -> getUrl(); ?> role="button">Continue reading</a>
                    </div>
				</div>
			</div>
		</div>
		<?php
		}
	?>
	<div class="col-md-12">
		<hr>
	</div>
</div>
