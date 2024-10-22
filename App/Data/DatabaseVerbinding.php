<?php
//App/Data/DatabaseVerbinding.php

declare(strict_types=1);
namespace App\Data;

use PDO;
use PDOException;
use Exception;

class DatabaseVerbinding {

    protected function getDbh(): PDO {
            try {
                $dbh = new PDO("mysql:host=localhost;dbname=phpherkansing;charset=utf8", "root", "Savethebrain159/");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $dbh;
            } catch (PDOException $e) {
                error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');
                throw new Exception();
            }
        }

}

?>