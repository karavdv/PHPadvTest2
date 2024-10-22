<?php
//entities/Score.php

declare(strict_types=1);

namespace App\Entities;

class Score {

    private Student $student;
    private array $modules;


    public function __construct(Student $student, array $modules) { 
        $this->student = $student; // bevat studentObject
        $this->modules = $modules; // bevat moduleobject, score 
    } 

    public function getStudent(): Student { 
        return $this->student; 
    } 

    public function getModules(): array {
        return $this->modules;
    }

    public function getModule(): Module {
        return $this->modules["module"];
    }

    public function getScore(): float {
        return $this->modules["score"];
    }

    public function setStudent(Student $student) {
        $this->student = $student; 
    }

    public function setModules(array $modules) {
        $this->modules = $modules;
    }


}
