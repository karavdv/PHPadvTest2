<?php
//App/Data/ModuleGegevens.php

declare(strict_types=1);
namespace App\Data;

use App\Entities\Module;
use PDO;
use PDOException;
use Exception;

class ModuleGegevens extends DatabaseVerbinding { 

    public function getModuleLijst(): array { 
        try {
        $dbh = $this->getDbh();
        $stmt = $dbh->prepare("SELECT id, naam, prijs FROM modules");
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $moduleObject = new Module ((int) $rij["id"], (string) $rij["naam"], (float) $rij["prijs"]); 
           array_push($lijst, $moduleObject); 
        }

        $dbh = null;
        return $lijst;
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');
        throw new Exception();
    }
}

public function bestaandeModule(int $moduleId): int { 

    try {
    $dbh = $this->getDbh(); 
    $stmt = $dbh->prepare("SELECT COUNT(*) FROM modules WHERE id = :moduleId"); 
    $stmt->bindValue(":moduleId", $moduleId); 
    $stmt->execute(); 
    $rowCount = $stmt->fetch();

    if(!$rowCount) {
        $rowCount = 0;
    } else {
        $rowCount = 1;
    }

    $dbh = null; 
    return $rowCount; 
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');
        throw new Exception();
    }
     }  

}