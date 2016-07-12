<?php
class Conexao {

    public static function getCon() {
        try {
            $db = new PDO("pgsql:host=104.236.88.179 dbname=dev_sac user=dev_sac password=1234");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $db;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}
