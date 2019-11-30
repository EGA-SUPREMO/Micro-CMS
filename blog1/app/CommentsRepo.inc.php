<?php

class CommentsRepo {

    public static function insertComment($conection, $comment) {
        $isInserted = false;

        if (isset($conection)) {
            try {
                $sql = "INSERT INTO comments(id_author, id_entry, title, content, register_date, active) VALUES(:id_author, :id_entry, :title, :content, NOW(), 0)";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':id_author', $comment->getIdAuthor(), PDO::PARAM_STR);
                $comand->bindParam(':id_entry', $comment->getIdEntry(), PDO::PARAM_STR);
                $comand->bindParam(':title', $comment->getTitle(), PDO::PARAM_STR);
                $comand->bindParam(':content', $comment->getText(), PDO::PARAM_STR);

                $isInserted = $comand->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $isInserted;
    }

    public static function getCommentsByIdEntry($conection, $idEntry) {
        $comments = [];

        if (isset($conection)) {
            try {
                include_once 'Comment.inc.php';
                
                $sql = "SELECT * FROM comments WHERE id_entry = :idEntry";
                
                $comand = $conection -> prepare($sql);
                $comand -> bindParam(':idEntry', $idEntry, PDO::PARAM_STR);
                $comand -> execute();
                
                $result = $comand -> fetchAll();
                
                if (count($result)) {
                    foreach ($result as $row) {
                        $comments[] = new Comment($row['id'], $row['id_author'], $row['id_entry'], $row['title'], $row['content'],
                        $row['register_date'], $row['active']);
                    }
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            }
        }
        
        return $comments;

    }

    public static function getNumberCommentsByUser($conection, $userId, $active) {
        $total = null;

        if (isset($conection)) {
            try {

                $sql = "SELECT COUNT(*) AS total FROM comments WHERE id_author = :userId AND active = :active";
                
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
}