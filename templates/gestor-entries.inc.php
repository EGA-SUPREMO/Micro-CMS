<?php
Conection::openConection();
$arrayEntries = EntriesRepo::getEntriesByUser(Conection::getConection(), $_SESSION['userId']);

Conection::closeConection();
?>
<div class="row entries-gestor-part">
	<div class="col-md-12">
		<h2>Entries gestor</h2>
		<br>
		<a href="<?php echo URL_GESTOR_NEW_ENTRY; ?>" class="btn btn-lg btn-primary" role="button" id="boton-new-entry">Create new entry</a>
		<br>
		<br>
	</div>
</div>

<div class="row entries-gestor-part">
	<div class="col-md-12">
		<?php
		if (count($arrayEntries)) {
		?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>Title</th>
						<th>Comments</th>
						<th>State</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i = 0; $i < count($arrayEntries); $i++) {
						$nowEntry = $arrayEntries[$i][0];
						$commentNumber = $arrayEntries[$i][1];
					?>
						<tr>
							<td> <?php echo $nowEntry -> getDate(); ?></td>
							<td> <?php echo $nowEntry -> getTitle(); ?></td>
							<td> <?php echo $commentNumber; ?></td>
							<td> <?php echo $nowEntry -> isActive(); ?></td>
							<td>
								<form method="post" action="<?php echo URL_GESTOR_EDIT_ENTRY; ?>">
									<input type="hidden" name="id_edit" value="<?php echo $nowEntry -> getId(); ?>">
									<input type="hidden" name="title" value="<?php echo $nowEntry -> getTitle(); ?>">
									<input type="hidden" name="content" value="<?php echo $nowEntry -> getText(); ?>">
									<input type="hidden" name="draw" value="<?php echo $nowEntry -> isActive(); ?>">
									<button type="submit" class="btn btn-default btn-xs" name="editEntry">Edit</button>
								</form>
							</td>
							<td>
								<form method="post" action="<?php echo URL_GESTOR_DELETE_ENTRY; ?>">
									<input type="hidden" name="id_delete" value="<?php echo $nowEntry -> getId(); ?>">
									<button type="submit" class="btn btn-default btn-xs" name="deleteEntry">Delete</button>
								</form></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		<?php
		} else {
		?>
			<h3 class="text-center">You haven't written any entries yet</h3>
			<br>
			<br>
		<?php
		}
		?>
	</div>
</div>
