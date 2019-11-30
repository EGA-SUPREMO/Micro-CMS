<div class="form-group">
	<label for="title">Title</label>
	<input type="text" class="form-control" id="title" name="title" placeholder="Write a title"
	<?php
	try {
		$verifier -> showTitle();
		echo ">";
		$verifier -> showTitleError(); 
	} catch(Throwable $ignored) {
		echo ">";
	}
	?>
</div>
<div class="form-group">
	<label for="content">Content</label>
	<textarea class="form-control" rows="5" id="content" name="content" placeholder="Write a text for the entry."><?php
	try {
		$verifier -> showContent();
		echo '</textarea>';
		
		$verifier -> showContentError(); 
	} catch(Throwable $ignored) {
	} finally {
		echo '</textarea>';
	}
	?>

</div>
<div class="checkbox">
	<label>
		<input type="checkbox" name="draw" value="1" <?php if($drawEntry) echo 'checked'; ?> > Draw?
	</label>
</div>
<input type="hidden" name="id_edit" value="<?php echo $_POST['id_edit']; ?>">
<br>
<button type="submit" class="btn btn-primary" name="save">Save entry</button>