<?php
session_start();
require_once '../../conexao.php';
$id_diaAberto = $_GET["id_diaAberto"];
$titulo = $_GET["titulo"];
$query = "DELETE FROM diaaberto WHERE id_diaAberto = '$id_diaAberto'";
$result = mysqli_query($conn, $query);
// Definir Alerta - Operações (EDITAR) 
if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "O equipamento <b>" .  $titulo . "</b> foi eliminado com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar o equipamento <b>" . $titulo . "</b>!",
        "type" => "danger",
    );
}
header("location: showaula.php");
