<?php
// business/Tabellen.php
declare(strict_types=1);

namespace App\Business;

use App\Data\ModuleGegevens;
use App\Data\PuntenGegevens;
use App\Data\StudentenGegevens;
use App\Entities\Score;
use Exception;

class Tabellen {

    public function getOverzichtstabel (): array|string {

        $student = new StudentenGegevens();
        $module = new ModuleGegevens();
        $punt = new PuntenGegevens();

        try {

            $studentenLijst = $student->getStudentenLijst();
            $moduleLijst = $module->getModuleLijst();

            $hoofdTabel = [];
            foreach ($studentenLijst as $student) {
                $modules = [];
    
                foreach($moduleLijst as $module) {
                    $score = $punt->getScore($student->getStudentenId(),$module->getModuleId());
                    $modules[] = [
                        "module" => $module,
                        "score" => $score
                    ];
                }            
                
                $scoreObject = new Score ($student, $modules);
                array_push($hoofdTabel, $scoreObject); 
            }
        } catch (Exception $e) {
            return 'Er is een onverwachte fout opgetreden. Probeer het later opnieuw.';
            error_log($e->getMessage(), 3, __DIR__ . '/log/errors.log');
        }

        return $hoofdTabel;
    }



    public function getStudentTabel (int $studentId): Score{

        $hoofdTabel= unserialize($_SESSION["hoofdTabel"]);
        $gezochteStudent = [];

        foreach ($hoofdTabel as $scoreObject) {
            if ($scoreObject->getStudent()->getStudentenId() === $studentId) {
                $gezochteStudent = $scoreObject;
                break;
            }
        }

        return $gezochteStudent;
    }



    public function getModuleTabel(int $moduleId) {

        $hoofdTabel = unserialize($_SESSION["hoofdTabel"]);
        $gezochteModule = [];
        $studenten = [];
    
        foreach ($hoofdTabel as $scoreObject) {
            foreach ($scoreObject->getModules() as $moduleData) {
                if ($moduleData['module']->getModuleId() === $moduleId) {
                    $module = $moduleData['module'];

                    if(!empty($moduleData['score'])){
    
                        $studenten[] = [
                            "student" => $scoreObject->getStudent(),
                            "score"   => $moduleData['score']
                        ];
                    }
                }
            }
        }
    
        $gezochteModule = [
            'module' => $module,        
            'studenten' => $studenten
        ];
    
        return $gezochteModule;
    }
    


}