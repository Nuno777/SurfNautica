<?php
session_start();
require_once '../../conexao.php';
$id_equipa = $_GET["id_equipa"];
$nome = $_GET["nome"];
$query = "DELETE FROM equipamentos WHERE id_equipa = '$id_equipa'";
$result = mysqli_query($conn, $query);
// Definir Alerta - Operações (EDITAR) 
if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "O equipamento <b>" .  $nome . "</b> foi eliminado com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar o equipamento <b>" . $nome . "</b>!",
        "type" => "danger",
    );
}
header("location: showequip.php");
