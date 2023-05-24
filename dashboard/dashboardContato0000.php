<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../login.php');
    exit(0);
}

require_once '../conexao.php';
$query = "SELECT * FROM contacto ORDER BY id_cont";
$result = mysqli_query($conn, $query);
$resultMenssage = mysqli_query($conn, $query);
$resultdelete = mysqli_query($conn, $query);

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
    require_once 'sheets/dashboardHead.php';
    ?>
</head>

<body class="body-bg">
    <div class="horizontal-main-wrapper">
        <?php
        require_once 'sheets/dashboardmenu.php';
        ?>

        <div class="main-content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <!-- Alerta - Operações (EDITAR) -->
                        <?php
                        if (isset($_SESSION["message"])) { ?>
                            <div class='alert alert-<?php echo $_SESSION["message"]["type"] ?> alert-dismissible fade show' role='alert'>
                                <?php echo $_SESSION["message"]["content"]; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button>
                            </div>

                        <?php unset($_SESSION["message"]);
                        }
                        ?>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Contactos</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-center">
                                            <thead class="text-uppercase bg-dark">
                                                <tr class="text-white">

                                                    <th scope="col">Email</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Telefone</th>
                                                    <th scope="col">Assunto</th>
                                                    <th scope="col">Mensagem</th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_object()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row->email . "</td>";
                                                    echo "<td>" . $row->assunto . "</td>";
                                                    echo "<td><a data-toggle='modal' data-target='#viewmensagem$row->id_cont' class='text-primary' name='Menssage'><i class='ti-comment-alt'></i></a></td>";
                                                    echo "<td><a href='editcontato.php?id_cont=$row->id_cont' class='text-secondary' name='edit'><i class='ti-pencil-alt'></i></a></td>";
                                                    echo "<td><a data-toggle='modal' data-target='#deletecontato$row->id_cont' class='text-danger' name='delete'><i class='ti-trash'></i></a></td>";
                                                    echo "</tr>";
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de ver mensagem -->
    <?php while ($row = $resultMenssage->fetch_object()) {
        $mensagem = $row->mensagem; ?>
        <div class="modal fade" id='viewmensagem<?php echo $row->id_cont ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mensagem</h5><span class="span-contat"><?php echo $row->email; ?></span>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" rows="10" style="resize: none" disabled><?= $mensagem ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                        <?php echo "<a href='editcontato.php?id_cont=$row->id_cont' type='button' class='btn btn-primary'>Editar</a>"; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Modal de ver mensagem fechou -->

    <!-- Modal para eliminar -->
    <?php while ($row = $resultdelete->fetch_object()) { ?>
        <div class="modal fade" id='deletecontato<?php echo $row->id_cont ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Contacto</h5><span class="span-contat"><?php echo $row->email; ?></span>
                    </div>
                    <div class="modal-body">
                        <p>Deseja eliminar este contacto?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <a href='deletecontato.php?id_cont=<?php echo $row->id_cont . '&email=' . $row->email ?>' type='button' class='btn btn-primary'>Sim</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Modal para eliminar fechou -->
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
