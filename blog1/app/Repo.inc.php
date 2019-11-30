<?php

    public static function getNumber($conection, $type) {
        $total = null;

        if (isset($conection)) {
            try {

                $sql = "SELECT COUNT(*) AS total FROM $table";

                $comand = $conection->prepare($sql);

                $comand->bindParam(':table', $type, PDO::PARAM_STR);

                $comand-> execute();
                $result = $comand->fetch();

                $total = $result['total'];
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }
            return $total;
        }
    }