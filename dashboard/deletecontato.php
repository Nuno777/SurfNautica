<?php
session_start();
require_once '../conexao.php';
$id_cont = $_GET["id_cont"];
$email = $_GET["email"];
$query = "DELETE FROM contacto WHERE id_cont='$id_cont'";
$result = mysqli_query($conn, $query);
 // Definir Alerta - Operações (EDITAR) 
 if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "O contacto do email <b>" .  $email . "</b> foi eliminado com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar o contacto do email <b>" . $email . "</b>!",
        "type" => "danger",
    );
}
header("location: dashboardContacto.php");
?>