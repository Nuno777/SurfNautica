<?php
session_start();
require_once '../conexao.php';
$id = $_GET["id"];
$email = $_GET["email"];
$query = "DELETE FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
 // Definir Alerta - Operações (DELETE) 
 if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "O cliente do email <b>" .  $email . "</b> foi eliminado com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar o cliente do email  <b>" . $email . "</b>!",
        "type" => "danger",
    );
}
header("location: dashboard.php");
?>