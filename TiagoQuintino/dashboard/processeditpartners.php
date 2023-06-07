<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // validar variáveis
    $id = isset($_POST['idParceiroHidden']) ? $_POST['idParceiroHidden'] : "";
    $nome = isset($_POST['name']) ? $_POST['name'] : "";
    $img = $_FILES['inputImg']['name'];
    $tmp_name = $_FILES['inputImg']['tmp_name'];
    $target_file = basename($_FILES["inputImg"]["name"]);
    $desc = isset($_POST['inputdesc']) ? $_POST['inputdesc'] : "";
    if ($nome == "" || $img == "" || $desc == "") {
        echo $nome . " " . $target_file . " " . $desc;

        $msg_erro = "Nome, descrição e imagem não inseridos ou não escolhida!";
    } else {
        echo "sdasdasdasda";
        /* estabelecer ligação à BD */
        require_once '../../conexao.php';
        if ($conn->connect_errno) {
            $code = $conn->connect_errno;
            $message = $conn->connect_error;
            $msg_erro = "Falha na ligação à Base de Dados ($code $message)!";
        } else {
            /* executar query... */
            $query = "UPDATE parcerias SET nome = '" . $nome . "', descricao = '" . $desc . "', img = '" . $img . "' WHERE id_parceria = " . $id . ";";
            echo $query;
            print_r($_POST);
            $sucesso_query = mysqli_query($conn, $query);
            if ($sucesso_query) {
                if ($conn->affected_rows > 0) {
                    $_SESSION["message"] = array(
                        "content" => "O parceiro <b>" .  $nome . "</b> foi criado com sucesso!",
                        "type" => "success",
                    );
                } else {
                    $_SESSION["message"] = array(
                        "content" => "Ocorreu um erro ao criar o parceiro <b>" . $nome . "</b>!",
                        "type" => "danger",
                    );
                }
                header("Location: showpartners.php");
                exit(0);
            } else {
                $code = $conn->errno; // error code of the most recent operation
                $message = $conn->error; // error message of the most recent op.
                $msg_erro = "Falha na query! ($code $message)";
            }
        }
    }
}
