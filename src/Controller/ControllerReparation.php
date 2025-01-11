<?php
namespace Workshop\Controller;

use Workshop\View\ViewReparation;
use Workshop\Service\ServiceReparation;

require_once "../Service/ServiceReparation.php";
require_once "../View/ViewReparation.php";

$controller = new ControllerReparation;
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(isset($_GET["getReparation"])){
    $controller->getReparation();
}

if(isset($_POST["create"])){
    $controller->insertReparation();
}
class ControllerReparation{

    public function insertReparation(){
        $id_workshop = $_POST["id_workshop"];
        $name_workshop = $_POST["name_workshop"];
        $register_date = $_POST["register_date"];
        $license_plate = $_POST["license_plate"];

        $service = new ServiceReparation();
        $reparation = $service->insertReparation($id_workshop, $name_workshop, $register_date, $license_plate);

        $view = new ViewReparation();
        $view->render($reparation);

    }

    public function getReparation(){
        $id_reparation = $_GET["id_reparation"];

        $service = new ServiceReparation();
        $reparation = $service->getReparation($id_reparation);

        $view = new ViewReparation();
        $view->render($reparation);
    }
}
