<?php
session_start();
require_once '../../../conexao.php';
$id_prancha = $_GET["id_prancha"];
$nome = $_GET["nome"];

$query = "DELETE FROM prachas WHERE id_prancha = '$id_prancha'";
$result = mysqli_query($conn, $query);

// Definir Alerta - Operações (EDITAR) 
if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "A prancha <b>" .  $nome . "</b> foi eliminada com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar a prancha <b>" . $nome . "</b>!",
        "type" => "danger",
    );
}
header("location: showprancha.php");
