<?php

use ServiceReparation;
class Reparation{
    public $id_reparation;
    public $id_workshop;
    public $name_workshop;
    public $register_date;
    public $license_plate;

    public function __construct ($id_reparation, $id_workshop, $name_workshop, $register_date, $license_plate){
        $this->id_reparation = $id_reparation;
        $this->id_workshop = $id_workshop;
        $this->name_workshop = $name_workshop;
        $this->register_date = $register_date;
        $this->license_plate = $license_plate;
    }

    public function getId_reparation(){
        return $this->id_reparation;
    }
    public function setId_reparation($id_reparation){
        $this->id_reparation = $id_reparation;
    }
    public function getId_workshop(){
        return $this->id_workshop;
    }
    public function setId_workshop($id_workshop){
        $this->id_workshop = $id_workshop;
    }
    public function getName_workshop(){
        return $this->name_workshop;
    }
    public function setName_workshop($name_workshop){
        $this->name_workshop = $name_workshop;
    }
    public function getRegister_date(){
        return $this->register_date;
    }
    public function setRegister_date($register_date){
        $this->register_date = $register_date;
    }
    public function getLicense_plate(){
        return $this->license_plate;
    }
    public function setLicense_plate($license_plate){
        $this->license_plate = $license_plate;
    }

}
