<?php
session_start();
require_once '../../conexao.php';
$id_not = $_GET["id_not"];
$titulo = $_GET["titulo"];
$query = "DELETE FROM noticia WHERE id_not = '$id_not'";
$result = mysqli_query($conn, $query);
// Definir Alerta - Operações (EDITAR) 
if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
        "content" => "A notícia <b>" .  $nome . "</b> foi eliminada com sucesso!",
        "type" => "success",
    );
} else {
    $_SESSION["message"] = array(
        "content" => "Ocorreu um erro ao eliminar a notícia <b>" . $nome . "</b>!",
        "type" => "danger",
    );
}
header("location: shownews.php");
