<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class ServiceReparation{
    public $mysqli;
    public function connect(){
        $db = parse_ini_file("../../cfg/db_config.ini");
        try {
            $this->mysqli = new mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]);
        }catch(mysqli_sql_exception $e){
            echo "gay";
        }
    }

    public function insertReparation($id_workshop, $name_workshop, $register_date, $license_plate):Reparation{
        $this->connect();
        $reparation = new Reparation("sdfa", $id_workshop, $name_workshop, $register_date, $license_plate);
        $sql_sentence = "INSERT INTO workshop(Id_reparation, Id_workshop, Name_workshop, Register_date, License_plate) VALUES ('uuid', '$id_workshop', '$name_workshop', '$register_date', '$license_plate')";
        $this->mysqli->query($sql_sentence);
        return $reparation;
    }

    public function getReparation(){

    }
}




