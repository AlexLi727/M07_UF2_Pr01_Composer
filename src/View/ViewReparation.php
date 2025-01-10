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
                echo $reparation->id_reparation;
                echo $reparation->id_workshop;
                echo $reparation->name_workshop;
                echo $reparation->register_date;
                echo $reparation->license_plate;
            }
        }
    ?>
    <h1> Car Workshop Reparation Menu </h1>
    <h2> Search car reparation </h2>
    <form>
        id reparation number:
        <input type = "text"> <br>
        <input type = "submit" value = "search">
    </form>

    <?php
        if($_SESSION["role"] == "employee"){
    ?>

    <h2> Create car reparation </h2>
    <form>
        Workshop ID (4 digits): <input type = "text" name = "id_workshop" maxlength = "4" required> <br>
        Workshop Name (up to 12 characters): <input type = "text" name = "name_workshop" maxlength = "12" required> <br>
        Register Date (yyyy-mm-dd): <input type = "text" name = "register_date" pattern = "\d{4}-\d{2}-\d{2}" required> <br>
        License Plate (9999-XXX): <input type = "text" name = "license_plate" pattern = "\d{4}-[A-Za-z]{3}" required> <br>
        Photo of Damaged Vehicle: <br>
        <input type = "submit" value = "create">
    </form>
    <?php } ?>
</body>
</html>