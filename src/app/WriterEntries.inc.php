<?php
include_once 'Entry.inc.php';
include_once 'EntriesRepo.inc.php';
include_once 'Conection.inc.php';

class WriterEntries {

	public static function writeEntry() {
		$entries = EntriesRepo::getAll(conection::getConection());

		if(count($entries)) {
			foreach ($entries as $entry) {
				self::writeEntries($entry);
			}
		}
	}

    public static function writeEntries($entry) {
        if(!isset($entry)) {
            return;
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>
                        <?php
                        echo $entry -> getTitle();
                        ?>
                        </strong>
                    </div>
                    <div class="card-body text-justify">
                        <?php
                        echo "<small>".$entry -> getDate() . "</small><br>";
                        echo nl2br(self::reduceText($entry -> getText()));
                        ?>
                        <br>
                        <div class="text-center">
                            <a class="btn btn-primary" href=<?php echo URL_ENTRY . "/" . $entry -> getUrl(); ?> role="button">Continue reading</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
    }
    public static function showSearchEntries($entry) {
        if(!isset($entry)) {
            return;
        }
        ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>
                    <?php
                    echo $entry -> getTitle();
                    ?>
                    </strong>
                </div>
                <div class="card-body text-justify">
                    <?php
                    echo "<small>".$entry -> getDate() . "</small><br>";
                    echo nl2br(self::reduceText($entry -> getText()));
                    ?>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary" href=<?php echo URL_ENTRY . "/" . $entry -> getUrl(); ?> role="button">Continue reading</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public static function showAdvancedSearchEntries($entry) {
        if(!isset($entry)) {
            return;
        }
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>
                    <?php
                    echo $entry -> getTitle();
                    ?>
                    </strong>
                </div>
                <div class="card-body text-justify">
                    <?php
                    echo $entry -> getDate();
                    echo nl2br(self::reduceText($entry -> getText()));
                    ?>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary" href=<?php echo URL_ENTRY . "/" . $entry -> getUrl(); ?> role="button">Continue reading</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function writeSearchEntries($entries) {
        for ($i = 1; $i <= count($entries); $i++) {
            if($i % 3 == 1) {
                ?>
                <div class="row">
                <?php
            }

            self::showSearchEntries($entries[$i - 1]);

            if($i % 3 == 0) {
                ?>
                </div>
                <br>
                <?php
            }
        }
    }
   public static function writeAdvancedSearchEntries($entries) {
        for ($i = 0; $i < count($entries); $i++) {
            ?>
            <div class="row">
            <?php

            self::showAdvancedSearchEntries($entries[$i]);

            ?>
            </div>
            <br>
            <?php
        }
    }

	public static function reduceText($text) {
		$max_length = 400;

        $result = '';

        if (strlen($text) >= $max_length) {

            $result = substr($text, 0, $max_length);

            $result .= '...';
        } else {
            $result = $text;
        }

        return $result;
	}
}