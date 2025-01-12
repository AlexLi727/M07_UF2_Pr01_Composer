<?php 
namespace Workshop\View;

use Workshop\Model\Reparation;

require_once "../../vendor/autoload.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        session_start();
        if(isset($_POST["role"])){
            $_SESSION["role"] = $_POST["role"];
        }
        class ViewReparation{
            public Reparation $reparation;

            public function render ($reparation){
                if($reparation->id_reparation === ""){
                    echo "
                        UUID not found in data base
                    ";

                    
                }else{ ?>
                    <ul>
                        <li> UUID: <?php echo $reparation->id_reparation ?></li>
                        <li> ID Workshop: <?php echo $reparation->id_workshop ?></li>
                        <li> Name: <?php echo $reparation->name_workshop ?></li>
                        <li> Register Date: <?php echo $reparation->register_date ?></li>
                        <li> License Plate: <?php echo $reparation->license_plate ?></li>
                    </ul>
                    <img src = "data:image/*;base64,<?php echo $reparation->image;?>" alt = "SI">
                   
                <?php
                }
            }
        }
    ?>
    <h1> Car Workshop Reparation Menu </h1>
    <h2> Search car reparation </h2>
    <form action = "../Controller/ControllerReparation.php" method = "GET">
        id reparation number:
        <input type = "text" name = "id_reparation" minlength = "36" maxlength = "36"> <br>
        <input type = "submit" value = "search" name = "getReparation">
    </form>

    <?php
        if($_SESSION["role"] == "employee"){
    ?>

    <h2> Create car reparation </h2>
    <form action = "../Controller/ControllerReparation.php" method = "POST" enctype = "multipart/form-data">
        Workshop ID (4 digits): <input type = "text" name = "id_workshop" maxlength = "4" required> <br>
        Workshop Name (up to 12 characters): <input type = "text" name = "name_workshop" maxlength = "12" required> <br>
        Register Date (yyyy-mm-dd): <input type = "text" name = "register_date" pattern = "\d{4}-\d{2}-\d{2}" required> <br>
        License Plate (9999-XXX): <input type = "text" name = "license_plate" pattern = "\d{4}-[A-Za-z]{3}" required> <br>
        Photo of Damaged Vehicle: <input type = "file" name = "image"><br>
        <input type = "submit" value = "create" name = "insertReparation" accept = "image/*">
    </form>
    <?php } ?>
</body>
</html>