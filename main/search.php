<?php
include_once 'app/WriterEntries.inc.php';


$search = "";
$results = null;

$titleSearch = true;
$contentSearch = true;
$tagsSearch = true;
$authorSearch = false;
$order = "DESC";

if (isset($_GET['q'])) {

	$search = trim($_GET['q']);
	if($search!="") {
		$search = stripslashes($_GET['q']);
		$search = htmlspecialchars($search);
	}
}

if (!empty($search)) {

	$title = "Search - $search";

	if(isset($_GET['submit'])) {
		Conection::openConection();
		$results = EntriesRepo::searchEntry(Conection::getConection(), $search);
		Conection::closeConection();

	} elseif (isset($_GET['avancedSearch']) && isset($_GET['camps'])) {

		if (in_array("title", $_GET['camps'])) {
			$titleSearch = true;
		}

		if (in_array("content", $_GET['camps'])) {
			$contentSearch = true;
		}

		if (in_array("tags", $_GET['camps'])) {
			$tagsSearch = true;
		}

		if (in_array("author", $_GET['camps'])) {
			$authorSearch = true;
		}

		if ($_GET['date'] == "earlier") {
			$order = "DESC";
		} else {
			$order = "ASC";
		}

		Conection::openConection();

		if ($titleSearch) {
			$entriesByTitle = EntriesRepo::searchEntryByString(Conection::getConection(), 'title', $search, $order);
		}

		if ($contentSearch) {
			$entriesByContent = EntriesRepo::searchEntryByString(Conection::getConection(), 'content', $search, $order);
		}

		if ($tagsSearch) {
			//añadir tags cuando existan
		}

		if ($authorSearch) {
			$entriesByAuthor = EntriesRepo::searchEntryByAuthor(Conection::getConection(), $search, $order);
		}
		
		Conection::closeConection();
	}
} else {
	$title = "Search";
}

include_once 'templates/BeginPage.inc.php';
include_once 'templates/Navbar.inc.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Search</h1>
        <br>
    	<div class="row">
    		<div class="col-md-2">
    		</div>
    		<div class="col-md-8">
    			<form role="form" method="get" action="<?php echo URL_SEARCH; ?>">
			        <div class="form-group">
			            <input type="search" class="form-control" name="q"
			            <?php if(isset($search)) echo "value='".$search."'" ?>
			            placeholder="What are you searching?">
			        </div>
			        <button type="submit" name="submit" class="form-control btn btn-outline-success btn-search">
			        	Search
			        </button>
			    </form>
    		</div>
    	</div>
    </div>
</div>
<div class="container">
	  <div class="card-group">
	    <div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<a data-toggle="collapse" href="#collapse1">Avanced search</a>
				</h4>
			</div>
			<div id="collapse1" class="card-collapse collapse">
				<div class="card-body">
					<form role="form" method="get" action="<?php echo URL_SEARCH; ?>">
			        <div class="form-group">
			            <input type="search" class="form-control" name="q"
			            <?php if(isset($search)) echo "value='".$search."'" ?>
			            placeholder="What are you searching?">
			        </div>
						<p>Search in the following camps</p>
						<label class="checkbox-inline">
					    	<input type="checkbox" name="camps[]" value="title"
								<?php
								if ($titleSearch) {
									echo "checked";
								}
								?>
								>Title
					    </label>
					    <label class="checkbox-inline">
					    	<input type="checkbox" name="camps[]" value="content"
								<?php
								if ($contentSearch) {
									echo "checked";
								}
								?>
								>Content
					    </label>
					    <label class="checkbox-inline">
					    	<input type="checkbox" name="camps[]" value="tags"
								<?php
								if ($tagsSearch) {
									echo "checked";
								}
								?>
								>Tags
					    </label>
					    <label class="checkbox-inline">
					    	<input type="checkbox" name="camps[]" value="author"
								<?php
								if ($authorSearch) {
									echo "checked";
								}
								?>
								>Author
					    </label>
					    <hr>
					    <p>Order by:</p>
					    <label class="radio-inline">
					    	<input type="radio" name="date" value="earlier"
								<?php
								if($order == 'DESC') {
									echo "checked";
								}
								?>
								>Earlier entries
					    </label>
					    <label class="radio-inline">
					    	<input type="radio" name="date" value="older"
								<?php
								if ($order == 'ASC') {
									echo "checked";
								}
								?>
								>Older entries
					    </label>
					    <hr>
					    <button type="submit" name="avancedSearch" class="btn btn-primary btn-search">
				        	Avanced search
				        </button>
					</form>
				</div>
			</div>
	    </div>
	</div>
</div>
<br>
<div class="container">
	<div id="results">
		<div class="row">
			<div class="col-md-12">
				<div class="card-header">
					<h1>
						Result(s)
						<?php
						if (isset($_GET['submit'])) {
							?>
							<small><?php echo " ".count($results); ?></small>
							<?php
						}
						?>
					</h1>
				</div>
			</div>
		</div>
		<br>
	<?php
			if (isset($_GET['submit'])) {
				if(count($results)) {
					WriterEntries::writeSearchEntries($results);
				} else {
					?>
						<h3>There is no entries</h3>
						<br>
					<?php
				}
			} elseif (isset($_GET['avancedSearch'])) {
				if (count($entriesByTitle) || count($entriesByContent) || count($entriesByAuthor)) {
					$parameters = count($_GET['camps']);
					$columnsWidth = 12 / $parameters;
					?>
					<div class="row">
						<?php
						for ($i = 0; $i < $parameters; $i++) {
						?>
							<div class="<?php echo 'col-md-'.$columnsWidth;?> text-center">
								<h4><?php echo 'Results in '.$_GET['camps'][$i];?></h4>
								<br>
								<?php
								switch($_GET['camps'][$i]) {
									case "title":
										WriterEntries::writeAdvancedSearchEntries($entriesByTitle);
										break;
									case "content":
										WriterEntries::writeAdvancedSearchEntries($entriesByContent);
										break;
									case "tags":
										break;
									case "author":
										WriterEntries::writeAdvancedSearchEntries($entriesByAuthor);
										break;
								}
								?>
							</div>
							<?php
						}
						?>
					</div>
					<?php
				}
			}
			?>
	</div>
</div>
<?php
include_once 'templates/EndPage.inc.php';
?>