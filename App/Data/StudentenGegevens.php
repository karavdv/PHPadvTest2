<?php
//App/Data/StudentenGegevens.php

declare(strict_types=1);
namespace App\Data;

use App\Entities\Student;
use PDO;
use PDOException;
use Exception;

class StudentenGegevens extends DatabaseVerbinding { 

    public function getStudentenLijst(): array { 
        try {
        $dbh = $this->getDbh();
        $stmt = $dbh->prepare("SELECT id, voornaam, achternaam, geboorteDatum, geslacht FROM studenten");
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $studentObject = new Student ((int) $rij["id"], (string) $rij["voornaam"], (string) $rij["achternaam"], (string) $rij["geboorteDatum"] , (string) $rij["geslacht"]); 
           array_push($lijst, $studentObject); 
        }

        $dbh = null;
        return $lijst;
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');
        throw new Exception();
    }
    }


    public function bestaandeStudent(int $studentenId): int { 

        try {
        $dbh = $this->getDbh(); 
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM studenten WHERE id = :studentenId"); 
        $stmt->bindValue(":studentenId", $studentenId); 
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