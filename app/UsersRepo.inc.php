<?php

class UsersRepo {

    public static function getAll($conection) {
        $allUsers = [];

        if (isset($conection)) {
            try {
                include_once 'User.inc.php';

                $sql = "SELECT * FROM users";

                $comand = $conection->prepare($sql);
                $comand->execute();
                $result = $comand->fetchAll();

                if (count($result)) {
                    foreach ($result as $row) {
                        $allUsers[] = new User($row['id'], $row['name'], $row['email'],
                                $row['active'], $row['register_date'], $row['password']);
                    }
                } else {
                    print 'No hay usuarios';
                }
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }

            return $allUsers;
        }
    }

    public static function insertUser($conection, $user) {
        $isInserted = false;

        if (isset($conection)) {
            try {
                $sql = "INSERT INTO users(name, email, password, register_date, active) VALUES(:name, :email, :password, NOW(), 0)";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':name', $user->getName(), PDO::PARAM_STR);
                $comand->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
                $comand->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
                
                $isInserted = $comand->execute();
            } catch (Exception $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $isInserted;
    }

    public static function getUserByString($conection, $type, $var) {
        $user = null;

        if (isset($conection)) {
            try {
                include_once 'User.inc.php';
                
                $sql = "SELECT * FROM users WHERE $type = :var";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':var', $var, PDO::PARAM_STR);

                $comand->execute();

                $result = $comand->fetch();
                
                if (!empty($result)) {
                    $user = new User($result['id'], $result['name'], $result['email'],
                            $result['active'], $result['register_date'], $result['password']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $user;
    }

    public static function existUnique($conection, $type, $var) {
        $exist = false;

        if (isset($conection)) {
            try {
                $sql = "SELECT * FROM users WHERE $type =:var";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':var', $var, PDO::PARAM_STR);
                $comand->execute();

                if (count($comand->fetchAll())) {
                    $exist = true;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $exist;
    }

    public static function updateVar($conection, $type, $id, $var) {
        $updated = false;

        if (isset($conection)) {
            try {
                $sql = "UPDATE users SET $type =:var WHERE id=:id";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':var', $var, PDO::PARAM_STR);
                $comand->bindParam(':id', $id, PDO::PARAM_STR);
                $comand->execute();

                if (count($comand->rowCount())) {
                    $updated = true;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $updated;
    }

}
