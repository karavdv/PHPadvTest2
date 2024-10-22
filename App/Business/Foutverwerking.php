<?php
// business/Foutverwerking.php
declare(strict_types=1);

namespace App\Business;

use App\Data\ModuleGegevens;
use App\Data\PuntenGegevens;
use App\Data\StudentenGegevens;
use Exception;

class Foutverwerking {

    private function logError(Exception $e) {
        error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');

    }    

    public function legeVeldenCheck (int $studentenId, int $moduleId, float $score): string {

        if ($studentenId < 0 || $moduleId < 0 || $score < 0) {
            return "Alle velden moeten ingevuld worden" ; 
        } else {
            return "";
        }
            
    } 

    public function ingavePuntenCheck (float $score): string {

        if($score < 0.00 || $score > 100.00){
            return "U kan enkel een score tussen 0 en 100 geven" ;
        } else {
            return "";
        }

    }

    public function inputIdCheck (int $studentenId, int $moduleId): string {

        $student = new StudentenGegevens();
        $module = new ModuleGegevens();
        $score = new PuntenGegevens();

        try{

            if($student->bestaandeStudent($studentenId) === 0 || $module->bestaandeModule($moduleId) === 0) {
                return "er is iets fout gegaan bij het selecteren van de module of student. Probeer opnieuw." ;
            } elseif($score->bestaandeScore($studentenId,$moduleId) === 1) {
                return "U heeft de score van deze student voor deze module reeds ingegeven." ;
            } else {
                return "";
            }

        } catch (Exception $e) {
            return 'Er is een onverwachte fout opgetreden. Probeer het later opnieuw.';
            $this->logError($e);
        }
    }

    public function opslaanScoreCheck (int $studentenId, int $moduleId, float $score): string {

        $scoreOpslaan = new PuntenGegevens();

        try{

            $scoreOpslaan->voegPuntToe($studentenId, $moduleId, $score);
            return "";

        } catch (Exception $e) {
            return 'Er is een onverwachte fout opgetreden. Probeer het later opnieuw.';
            $this->logError($e);
        }


    }


    }