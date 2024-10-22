<?php
//entities/Student.php

declare(strict_types=1);

namespace App\Entities;

use DateTime;

class Student {

    private int $studentenId;
    private string $voornaam;
    private string $achternaam;
    private string $geboorteDatum;
    private string $geslacht;

    public function __construct(int $studentenId, string $voornaam, string $achternaam, string $geboorteDatum, string $geslacht) { 
        $this->studentenId = $studentenId;
        $this->voornaam = $voornaam; 
        $this->achternaam = $achternaam; 
        $this->geboorteDatum = $geboorteDatum;
        $this->geslacht = $geslacht;
    } 
 
    public function getStudentenId(): int { 
        return $this->studentenId; 
    } 
 
    public function getVoornaam(): string {
        return $this->voornaam; 
    } 

    public function getAchternaam(): string {
        return $this->achternaam; 
    }

    public function getVolledigeNaam(): string {
        return $this->voornaam . " " . $this->achternaam; 
    } 

    public function getGeboorteDatum(): string {
        return $this->geboorteDatum; 
    }

    public function getGeslacht(): string {
        return $this->geslacht; 
    }

    public function setStudentenId(int $studentenId) {
        $this->studentenId = $studentenId; 
    }

    public function setVoornaam(string $voornaam) {
        $this->voornaam = $voornaam; 
    } 

    public function setGeboorteDatum(string $geboorteDatum) {
        $this->geboorteDatum = $geboorteDatum; 
    }

    public function setGeslacht(string $geslacht) {
        $this->geslacht = $geslacht; 
    }

    public function setAchternaam(string $achternaam) {
        $this->achternaam = $achternaam; 
    }

}
