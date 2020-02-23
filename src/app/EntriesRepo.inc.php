<?php

class EntriesRepo {

	public static function getAll($conection) {
        $allEntries = [];
        if (isset($conection)) {
            try {
                include_once 'Entry.inc.php';

                $sql = "SELECT * FROM entries ORDER BY created_date DESC LIMIT 5";

                $comand = $conection->prepare($sql);
                $comand->execute();

                $result = $comand->fetchAll();

                if (count($result)) {
                    
                    foreach ($result as $row) {
                        $allEntries[] = new Entry($row['id'], $row['id_author'], $row['title'], $row['content'],
                                $row['created_date'], $row['active']);
                    }


                } else {
                    echo "There is not entries";
                }
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }
            return $allEntries;
        }
    }
    public static function getEntriesByUrl($conection, $url) {
        $entry = null;

        if (isset($conection)) {
            try {
                include_once 'Entry.inc.php';
                
                $sql = "SELECT * FROM entries WHERE url=:url";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':url', $url, PDO::PARAM_STR);

                $comand->execute();

                $result = $comand->fetch();
                
                if (!empty($result)) {
                    $entry = new Entry($result['id'], $result['id_author'], $result['title'], $result['content'],
                                $result['created_date'], $result['active']);
                } else {
                    echo "The entry does not exist.";
                }
            } catch (PDOException $ex) {
                echo 'ERROR ' . $ex->getMessage();
            }
        }
        return $entry;
    }
    public static function getEntryById($conection, $id) {
        $entry = null;

        if (isset($conection)) {
            try {
                include_once 'Entry.inc.php';
                
                $sql = "SELECT * FROM entries WHERE id=:id";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':id', $id, PDO::PARAM_STR);

                $comand->execute();

                $result = $comand->fetch();

                if (!empty($result)) {
                    $entry = new Entry($result['id'], $result['id_author'], $result['title'], $result['content'],
                                $result['created_date'], $result['active']);
                } else {
                    echo "The entry does not exist.";
                }
            } catch (PDOException $ex) {
                echo 'ERROR ' . $ex->getMessage();
            }
        }
        return $entry;
    }
    public static function existEntryByTitle($conection, $title) {
        $entry = 0;

        if (isset($conection)) {
            try {
                include_once 'Entry.inc.php';
                
                $sql = "SELECT * FROM entries WHERE title=:title";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':title', $title, PDO::PARAM_STR);

                $comand->execute();

                $result = $comand->fetchAll();

                $entry = count($result);
            } catch (PDOException $ex) {
                echo 'ERROR ' . $ex->getMessage();
            }
        }
        return $entry;
    }
    public static function getEntriesByHazard($conection, $limit) {
        $entry = [];

        if (isset($conection)) {
            try {
                include_once 'Entry.inc.php';
                
                $sql = "SELECT * FROM entries ORDER BY RAND() LIMIT $limit";

                $comand = $conection->prepare($sql);

                $comand->execute();

                $result = $comand->fetchAll();
                
                if (count($result)) {
                	foreach ($result as $row) {
                    	$entry[] = new Entry($row['id'], $row['id_author'], $row['title'], $row['content'],
                                $row['created_date'], $row['active']);
                	}
                } else {
                    echo "Error.";
                }
            } catch (PDOException $ex) {
                echo 'ERROR ' . $ex->getMessage();
            }
        }
        return $entry;
    }
    public static function getNumberEntriesByUser($conection, $userId, $active) {
        $total = null;

        if (isset($conection)) {
            try {
                $sql = "SELECT COUNT(*) AS total FROM entries WHERE id_author = :userId AND active = :active";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':userId', $userId, PDO::PARAM_STR);
                $comand->bindParam(':active', $active, PDO::PARAM_STR);

                $comand-> execute();
                $result = $comand->fetch();

                $total = $result['total'];
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }
            return $total;
        }
    }
    public static function getEntriesByUser($conection, $idUser) {
        $entries = [];

        if (isset($conection)) {
            try {
                $sql = "SELECT a.id, a.id_author, a.title, a.url, a.content, a.created_date, a.active, COUNT(b.id) AS amountComments FROM entries a LEFT JOIN comments b ON a.id = b.id_entry WHERE a.id_author = :idAuthor GROUP BY a.id ORDER BY a.created_date DESC";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':idAuthor', $idUser, PDO::PARAM_STR);
                
                $comand-> execute();
                $result = $comand->fetchAll();

                if (count($result)) {
                    foreach ($result as $row) {
                        $entries[] = array(
                            new Entry(
                                $row['id'], $row['id_author'], $row['title'], $row['content'], $row['created_date'], $row['active']
                            ),
                            $row['amountComments']
                        );
                    }
                }
            } catch(PDOException $ex) {
                print 'ERROR';
            }
        }
        return $entries;
    }

    public static function updateEntry($connection, $id, $title, $url, $content, $active) {
        $isUpdated = false;

        if (isset($connection)) {
            try {
                $sql = "UPDATE entries SET title = :title, url = :url, content = :content, active = :active WHERE id = :id";

                $comand = $connection -> prepare($sql);

                $comand -> bindParam(':title', $title, PDO::PARAM_STR);
                $comand -> bindParam(':url', $url, PDO::PARAM_STR);
                $comand -> bindParam(':content', $content, PDO::PARAM_STR);
                $comand -> bindParam(':active', $active, PDO::PARAM_STR);
                $comand -> bindParam(':id', $id, PDO::PARAM_STR);

                $comand -> execute();

                $result = $comand -> rowCount();

                if (count($result)) {
                    $isUpdated = true;
                }
            } catch(PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage();
            }
        }

        return $isUpdated;
    }
    public static function deleteCommentsAndEntry($conection, $idEntry) {
        if (isset($conection)) {
            try {
                $conection -> beginTransaction();

                $sql1 = "DELETE FROM comments WHERE id_entry=:idEntry";
                $comand1 = $conection -> prepare($sql1);
                $comand1 -> bindParam(':idEntry', $idEntry, PDO::PARAM_STR);
                $comand1 -> execute();

                $sql2 = "DELETE FROM entries WHERE id=:idEntry";
                $comand2 = $conection -> prepare($sql2);
                $comand2 -> bindParam(':idEntry', $idEntry, PDO::PARAM_STR);
                $comand2 -> execute();

                $conection -> commit();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
                $conection -> rollBack();
            }
        }
    }
    public static function insertEntry($conection, $entry) {
        $isInserted = false;

        if (isset($conection)) {
            try {
                $sql = "INSERT INTO entries(id_author, title, url, content, created_date, active) VALUES(:id_author, :title, :url, :content, NOW(), :active)";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':id_author', $entry->getIdAuthor(), PDO::PARAM_STR);
                $comand->bindParam(':title', $entry->getTitle(), PDO::PARAM_STR);
                $comand->bindParam(':url', $entry->getUrl(), PDO::PARAM_STR);
                $comand->bindParam(':content', $entry->getText(), PDO::PARAM_STR);
                $comand->bindParam(':active', $entry->isActive(), PDO::PARAM_STR);

                $isInserted = $comand->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $isInserted;
    }

    public static function searchEntry($connection, $searchTerm) {
        $entries = [];

        $searchTerm = '%' . $searchTerm . '%';

        if (isset($connection)) {
            try {

                $sql = "SELECT * FROM entries WHERE title LIKE :searchTerm OR content LIKE :searchTerm ORDER BY created_date DESC LIMIT 25";

                $comand = $connection -> prepare($sql);

                $comand -> bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
                $comand -> execute();
                $result = $comand -> fetchAll();

                if (count($result)) {
                	foreach ($result as $row) {
                    	$entries[] = new Entry($row['id'], $row['id_author'], $row['title'], $row['content'],
                                $row['created_date'], $row['active']);
                	}
                }

            } catch(PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage();
            }
        }

        return $entries;
    }
    public static function searchEntryByString($connection, $type, $searchTerm, $order) {
        $entries = [];

        $searchTerm = '%' . $searchTerm . '%';

        if (isset($connection)) {
            try {

                $sql = "SELECT * FROM entries WHERE $type LIKE :searchTerm ORDER BY created_date $order LIMIT 25";

                $comand = $connection -> prepare($sql);

                $comand -> bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
                $comand -> execute();
                $result = $comand -> fetchAll();

                if (count($result)) {
                	foreach ($result as $row) {
                    	$entries[] = new Entry($row['id'], $row['id_author'], $row['title'], $row['content'],
                                $row['created_date'], $row['active']);
                	}
                }

            } catch(PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage();
            }
        }

        return $entries;
    }
    public static function searchEntryByAuthor($connection, $searchTerm, $order) {
        $entries = [];

        $searchTerm = '%' . $searchTerm . '%';

        if (isset($connection)) {
            try {

                $sql = "SELECT e.id, e.id_author, e.title, e.content, e.created_date, e.active FROM entries e JOIN users u ON u.id = e.id_author WHERE u.name LIKE :searchTerm ORDER BY created_date $order LIMIT 25";

                $comand = $connection -> prepare($sql);

                $comand -> bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
                $comand -> execute();
                $result = $comand -> fetchAll();

                if (count($result)) {
                	foreach ($result as $row) {
                    	$entries[] = new Entry($row['id'], $row['id_author'], $row['title'], $row['content'],
                                $row['created_date'], $row['active']);
                	}
                }

            } catch(PDOException $ex) {
                print 'ERROR ' . $ex -> getMessage();
            }
        }

        return $entries;
    }

}