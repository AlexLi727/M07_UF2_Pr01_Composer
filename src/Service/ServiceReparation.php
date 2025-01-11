<?php
namespace Workshop\Service;

use Workshop\Model\Reparation;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Ramsey\Uuid\Uuid;
use mysqli;
use mysqli_sql_exception;
use Throwable;

require_once "../Model/Reparation.php";

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
        $xd = Uuid::uuid4()->toString();
        $reparation = new Reparation("sdfa", $id_workshop, $name_workshop, $register_date, $license_plate);
        $sql_query = "INSERT INTO workshop(Id_reparation, Id_workshop, Name_workshop, Register_date, License_plate) VALUES ('uuid', '$id_workshop', '$name_workshop', '$register_date', '$license_plate')";
        $this->mysqli->query($sql_query);
        return $reparation;
    }

    public function getReparation($id_reparation){
        $this->connect();
        $sql_query = $this->mysqli->prepare("SELECT * FROM workshop WHERE Id_reparation = ?");
        $sql_query->bind_param('s', $id_reparation);
        $sql_query->execute();

        $result = $sql_query->get_result()->fetch_assoc();

        try{
            if($result){
                $reparation = new Reparation($result["Id_reparation"], $result["Id_workshop"], $result["Name_workshop"], $result["Register_date"], $result["License_plate"]);
            }else{
                $reparation = new Reparation("", "", "", "", "");
            }
            
        }catch(Throwable $th){
            echo "gay";
        }
        
        return $reparation;
        
    }
}




