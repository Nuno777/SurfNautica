<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../login.php');
    exit(0);
}
require_once '../conexao.php';
if (isset($_POST["editcontato"])) {
    $id_cont = $_POST["id_cont"];
    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $tel = $_POST["tel"];
    $assunto = $_POST["assunto"];
    $mensagem = $_POST["mensagem"];
    $query = "UPDATE contatos SET email='$email',nome='$nome',telefone='$tel',assunto='$assunto',mensagem='$mensagem' WHERE id_cont='$id_cont'";
    $result = mysqli_query($conn, $query);

    // Definir Alerta - Operações (EDITAR) 
    if ($conn->affected_rows > 0) {
        $_SESSION["message"] = array(
            "content" => "O contacto do email <b>" . $email . "</b> foi atualizado com sucesso!",
            "type" => "success",
        );
    } else {
        $_SESSION["message"] = array(
            "content" => "Ocorreu um erro ao atualizar o contacto do email <b>" . $email . "</b>!",
            "type" => "danger",
        );
    }

    header('Location: dashboardContato.php');
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
    require_once 'dashboardHead.php';
    ?>
</head>

<body class="body-bg">
    <div class="horizontal-main-wrapper">
        <?php
        require_once 'dashboardNavbar.php';
        ?>
        <div class="main-content-inner">
            <?php
            $id_cont = $_GET["id_cont"];
            $query = "SELECT * FROM contatos WHERE id_cont='$id_cont'";
            $result = mysqli_query($conn, $query);
            if ($result && $result->num_rows) {
                $row = $result->fetch_object();
                $id_cont = $row->id_cont;
                $email = $row->email;
                $nome = $row->nome;
                $tel = $row->telefone;
                $assunto = $row->assunto;
                $mensagem = $row->mensagem;
            ?>
                <div class="container">
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Editar Contacto</h4>
                                <div class="single-table">
                                    <form id="editcontato" action="editcontato.php" method="POST" class="form" enctype="multipart/form-data">

                                        <input type="text" class="form-control" id="id_cont" name="id_cont" value="<?= $id_cont ?>" required hidden>

                                        <div class="row mb-2">
                                            <div class="col-md-12" id="email-container">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                                                <div id="validarfeed" class="invalid-feedback invalid-email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-6" id="name-container">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nome" value="<?= $nome ?>" minlength="3" maxlength="25" required>
                                                <div id="validarfeed" class="invalid-feedback invalid-name">
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="tel-container">
                                                <label for="tel" class="form-label">Telemovel <span class="span-contat">(opcional)</span></label>
                                                <input type="tel" maxlength="9" class="form-control" id="tel" name="tel" value="<?= $tel ?>" pattern="^9[1236][0-9]{7}$|^2[3-9][1-9][0-9]{6}$|^2[12][0-9]{7}$">
                                                <div id="validarfeed" class="valid-feedback invalid-telefone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-12" id="assunto-container">
                                                <label for="assunto" class="form-label">Assunto</label>
                                                <input type="text" class="form-control" id="assunto" name="assunto" value="<?= $assunto ?>" minlength="3" maxlength="40" required>
                                                <div id="validarfeed" class="valid-feedback invalid-assunto">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-12" id="mensagem-container">
                                                <label for="mensagem" class="form-label">Mensagem</label>
                                                <textarea class="form-control" rows="10" id="mensagem" name="mensagem" minlength="4" maxlength="500" style="resize: none" required><?= $mensagem ?></textarea>
                                                <div id="validarfeed" class="invalid-feedback invalid-mensagem">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-1 ">
                                                <button class="btn btn-primary" name="editcontato" id="editcontatobutton" type="submit" disabled>Editar</button>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="dashboardContato.php" class="btn btn-secondary" name="voltarcontato" type="submit">Voltar</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo "<script>alert('Selecione um contacto valido');window.location='dashboardContato.php'</script>";
            } ?>
        </div>
    </div>
    
    <!-- JQuery ativar botão editar -->
    <script>
        $(document).ready(function() {
            $('#editcontato').on('input change', function() {
                $('#editcontatobutton').attr('disabled', false);
            });
        })
    </script>

    <script src="assetsAdmin/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="assetsAdmin/js/popper.min.js"></script>
    <script src="assetsAdmin/js/bootstrap.min.js"></script>
    <script src="assetsAdmin/js/owl.carousel.min.js"></script>
    <script src="assetsAdmin/js/metisMenu.min.js"></script>
    <script src="assetsAdmin/js/jquery.slimscroll.min.js"></script>
    <script src="assetsAdmin/js/jquery.slicknav.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="assetsAdmin/js/line-chart.js"></script>
    <script src="assetsAdmin/js/pie-chart.js"></script>
    <script src="assetsAdmin/js/bar-chart.js"></script>
    <script src="assetsAdmin/js/maps.js"></script>
    <script src="assetsAdmin/js/plugins.js"></script>
    <script src="assetsAdmin/js/scripts.js"></script>
</body>

</html>