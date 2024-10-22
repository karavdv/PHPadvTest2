<?php
// business/ControllerValidatie.php
declare(strict_types=1);

namespace App\Business;

use App\Business\Foutverwerking;

class ControllerValidatie {

    public function verwerkError (string $error) {
        $_SESSION["error"]= $error;
        header('location: ingavePuntenController.php');
        exit;
    }

    public function ingaveFormulierCheck (int $studentenId, int $moduleId, float $score): bool {

        $check = new Foutverwerking();

        $check1= $check->legeVeldenCheck($studentenId,$moduleId,$score);
            if(!empty($check1)) {
                $this->verwerkError($check1);
            } else {
                $check2 = $check->ingavePuntenCheck($score);
                    if(!empty($check2)) {
                        $this->verwerkError($check2);
                    } else {
                        $check3 = $check->inputIdCheck($studentenId, $moduleId);
                            if(!empty($check3)) {
                                $this->verwerkError($check3);
                            } else {
                                $opslaanScore= $check->opslaanScoreCheck($studentenId, $moduleId, $score);
                                    if(!empty($opslaanScore)) {
                                        $this->verwerkError($opslaanScore);
                                    } else {
                                        return true;
                                    }
                            }
                    }
                }
        }
                            

   


}