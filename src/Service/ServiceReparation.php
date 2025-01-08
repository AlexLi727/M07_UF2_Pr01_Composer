<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class ServiceReparation{
    
    public function connect(){
        $db = parse_ini_file("../../cfg/db_config.ini");
        try {
            $mysqli = new mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]);
            return $mysqli;
        }catch(mysqli_sql_exception $e){
            echo "gay";
        }
    }

    public function insertReparation(){

    }

    public function getReparation(){

    }
}




