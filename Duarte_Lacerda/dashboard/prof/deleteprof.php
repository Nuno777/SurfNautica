<?php
session_start();
require_once '../../../conexao.php';
$id_prof = $_GET["id_prof"];
$nome = $_GET["nome"];

$query = "DELETE FROM professor WHERE id_prof = '$id_prof'";
$result = mysqli_query($conn, $query);

// Definir Alerta - Operações (EDITAR) 
if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "O professor <b>" .  $nome . "</b> foi eliminado com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar o professor <b>" . $nome . "</b>!",
        "type" => "danger",
    );
}
header("location: showprof.php");
