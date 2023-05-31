<?php
session_start();
require_once '../../conexao.php';
$id_parceria = $_GET["id_parceria"];
$nome = $_GET["nome"];
$query = "DELETE FROM parcerias WHERE id_parceria = '$id_parceria'";
$result = mysqli_query($conn, $query);
// Definir Alerta - Operações (EDITAR) 
if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "O Parceiro <b>" .  $nome . "</b> foi eliminado com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar o Parceiro <b>" . $nome . "</b>!",
        "type" => "danger",
    );
}
header("location: showpartners.php");
