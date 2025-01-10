<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Car workshop </h1>
    <h2> Select Role</h2>
    <form action = "View/ViewReparation.php" method = "POST">
        <select name = "role">
            <option value = "user"> User </option>
            <option value = "employee"> Employee </option>
        </select>
        <input type = "submit">
    </form>
</body>
</html>

<?php

