<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$database = "surfnautica";

$conn = mysqli_connect($serverName, $userName, $password, $database);

/* if (!$connection) {
    die("Erro na Ligação: " . mysqli_connect_error());
} else {
    echo ("Ligação bem sucedida");
}
 */