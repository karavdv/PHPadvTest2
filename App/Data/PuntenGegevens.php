<?php 
//App/Data/PuntenGegevens.php

declare(strict_types=1);
namespace App\Data;

use PDO;
use PDOException;
use Exception;

class PuntenGegevens extends DatabaseVerbinding {

    public function bestaandeScore(int $studentenId, int $moduleId): int { 

        try {
        $dbh = $this->getDbh(); 
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM punten WHERE studentenId = :studentenId AND moduleId = :moduleId"); 
        $stmt->bindValue(":studentenId", $studentenId); 
        $stmt->bindValue(":moduleId", $moduleId); 
        $stmt->execute(); 
        $rowCount = $stmt->fetchColumn();

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

   
    public function voegPuntToe (int $studentenId, int $moduleId, float $score) {

        try {
        $dbh = $this->getDbh(); 
        $stmt = $dbh->prepare("INSERT INTO punten (moduleId, studentenId, score) VALUES (:moduleId, :studentenId, :score)");
        $stmt->bindValue(":studentenId", $studentenId); 
        $stmt->bindValue(":moduleId", $moduleId); 
        $stmt->bindValue(":score", $score); 
        $stmt->execute();
        $dbh = null; 
        }  catch (PDOException $e) {
            error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');
            throw new Exception();
        }

    }


    public function getScore(int $studentenId, int $moduleId): float|string { 

        try {
        $dbh = $this->getDbh(); 
        $stmt = $dbh->prepare("SELECT score FROM punten WHERE studentenId = :studentenId AND moduleId = :moduleId"); 
        $stmt->bindValue(":studentenId", $studentenId); 
        $stmt->bindValue(":moduleId", $moduleId); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$result) {
            $score = "";
        } else {
            $score = (float) $result[0]["score"];
        }

        $dbh = null; 
        return $score; 
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');
            throw new Exception();
        }
         }  



}
