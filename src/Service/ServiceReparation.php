<?php
namespace Workshop\Service;

use Exception;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\ImageManager;
use Workshop\Model\Reparation;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Ramsey\Uuid\Uuid;
use mysqli;
use mysqli_sql_exception;
use Intervention\Image\Drivers\Gd\Driver;


require_once "../Model/Reparation.php";
require "../../vendor/autoload.php";

class ServiceReparation{
    public $mysqli;
    public function connect(){
        $db = parse_ini_file("../../cfg/db_config.ini");
        $log = new Logger("ServiceReparation");

        try {
            $this->mysqli = new mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]);
            $log->pushHandler(new StreamHandler('../../logs/app_workshop.log', Logger::INFO));
            $log->info("Connection with database succesful");
        }catch(mysqli_sql_exception $e){
            $log->pushHandler(new StreamHandler('../../logs/app_workshop.log', Logger::ERROR));
            $log->error("Error with database connection -> ". $e);
        }
    }

    public function insertReparation($id_workshop, $name_workshop, $register_date, $license_plate, $image):Reparation{
        $this->connect();
        $log = new Logger("ServiceReparation");
        $uuid = Uuid::uuid4()->toString();

        $carImage = ImageManager::gd()->read(base64_decode($image));
                $carImage->resize(800, 600);
                $carImage->text("$uuid". "$license_plate", 400, 100, function($font){
                    $font->file("../../resources/fonts/Coolvetica Rg It.otf");
                    $font->size(32);
                    $font->color('#00FF00');
                    $font->align('center');
                    $font->valign('top');
                });
        $img = base64_encode($carImage->toPng());

        $reparation = new Reparation($uuid, $id_workshop, $name_workshop, $register_date, $license_plate, $img);

        try{
            $sql_query = "INSERT INTO workshop(Id_reparation, Id_workshop, Name_workshop, Register_date, License_plate, Car_image) VALUES ('$uuid', '$id_workshop', '$name_workshop', '$register_date', '$license_plate', '$img')";
            $this->mysqli->query($sql_query);
            $log->pushHandler(new StreamHandler('../../logs/app_workshop.log', Logger::INFO));
            $log->info("Reparation inserted succesfully -> ". $uuid);
        }catch(Exception $e){
            $log->pushHandler(new StreamHandler('../../logs/app_workshop.log', Logger::ERROR));
            $log->error("Error with reparation insert -> ". $e);
        }
        return $reparation;
    }

    public function getReparation($id_reparation, $role){
        $this->connect();
        $log = new Logger("ServiceReparation");

        try{
            $sql_query = $this->mysqli->prepare("SELECT * FROM workshop WHERE Id_reparation = ?");
            $sql_query->bind_param('s', $id_reparation);
            $sql_query->execute();
            $result = $sql_query->get_result()->fetch_assoc();

            if($result){
                $reparation = new Reparation($result["Id_reparation"], $result["Id_workshop"], $result["Name_workshop"], $result["Register_date"], $result["License_plate"], $result["Car_image"]);
                
                file_put_contents("../../resources/image.jpg", base64_decode($result["Car_image"]));
                $carImage = ImageManager::gd()->read(base64_decode($result["Car_image"]));

                if($role === "user"){
                    $carImage->pixelate(20);
                }

                $img = base64_encode($carImage->encode());

                $reparation->image = $img;

                $log->pushHandler(new StreamHandler('../../logs/app_workshop.log', Logger::INFO));
                $log->info("Data obtained succesfully: ". count($result). " results obtained");
            }else{
                $reparation = new Reparation("", "", "", "", "", "");
                $log->pushHandler(new StreamHandler('../../logs/app_workshop.log', Logger::WARNING));
                $log->warning("UUID Not found");
            }
        }catch(Exception $e){
            $log->pushHandler(new StreamHandler('../../logs/app_workshop.log', Logger::ERROR));
            $log->error("Error with data obtention -> ". $e);
        }
        
        return $reparation;
    }
}




