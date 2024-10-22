<?php
//entities/Module.php

declare(strict_types=1);

namespace App\Entities;

class Module {

    private int $moduleId;
    private string $naam;
    private float $prijs;

    public function __construct(int $moduleId, string $naam, float $prijs) { 
        $this->moduleId = $moduleId;
        $this->naam = $naam; 
        $this->prijs = $prijs; 
    } 
 
    public function getModuleId(): int { 
        return $this->moduleId; 
    } 
 
    public function getNaam(): string {
        return $this->naam; 
    } 

    public function getPrijs(): float {
        return $this->prijs; 
    } 

    public function setModuleId(int $moduleId) {
        $this->moduleId = $moduleId; 
    }

    public function setNaam(string $naam) {
        $this->naam = $naam; 
    } 

    public function setPrijs(float $prijs) {
        $this->prijs = $prijs; 
    } 

}
