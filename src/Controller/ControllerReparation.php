<?php

use ServiceReparation;
use ViewReparation;

class ControllerReparation{

    public function insertReparation(){
        $id_workshop = $_POST["id_workshop"];
        $name_workshop = $_POST["name_workshop"];
        $register_date = $_POST["register_date"];
        $license_plate = $_POST["license_plate"];

        $service = new ServiceReparation;
        $reparation = $service->insertReparation($id_workshop, $name_workshop, $register_date, $license_plate);

        $view = new ViewReparation();
        $view->render($reparation);

    }

    public function getReparation(){
        
    }
}