<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}

require_once '../conexao.php';


if (isset($_POST["editaula"])) {
    $id_aula = $_POST["id_diaAberto"];
    $id_prof = $_POST["id_prof"];
    $titulo = $_POST["titulo"];
    $data1 = $_POST["data1"];
    $horas = $_POST["horas"];
$query = "UPDATE diaaberto SET titulo='$titulo',data1='$data1',horas='$horas',id_prof='$id_prof' WHERE id_diaAberto ='$id_aula'";
  $result = mysqli_query($conn, $query);  
if ($conn->affected_rows > 0) {
  $_SESSION["message"] = array(
    "content" => "Editou o dia aberto <b>" . $titulo . "</b> com sucesso!",
    "type" => "success",
  );
  echo "sucesso";
} else {
  $_SESSION["message"] = array(
    "content" => "Ocorreu um erro ao responder a editar o dia aberto <b>" . $titulo . "</b>!",
    "type" => "danger",
  );
}
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard | Editar Aulas</title>
  <?php
  require_once 'sheets/dashboardHead.php';
  ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
  <div class="wrapper">
    <aside class="left-sidebar sidebar-dark" id="left-sidebar">
      <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
          <a href="../index.php">
            <img src="assets/images/favicon.png" style="height: 65px;" alt="Mono">
            <span class="brand-name text-light">SURFNAUTICA</span>
          </a>
        </div>
        <?php
        require_once 'sheets/dashboardmenu.php';
        ?>
      </div>
    </aside>

    <div class="page-wrapper">
      <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
          <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <span class="page-title">Dashboard</span>

          <div class="navbar-right ">
            <?php
            require_once 'sheets/dashboardNavbar.php';
            ?>
          </div>
        </nav>
      </header>


      <div class="content-wrapper">

        <?php
        $id_aula = isset($_GET["id_diaAberto"]) ? $_GET["id_diaAberto"] : '';
        $query = "SELECT * FROM diaaberto WHERE id_diaAberto='$id_aula'";
        $result = mysqli_query($conn, $query);
        if ($result && $result->num_rows) {
          $row = $result->fetch_object();
          $id_aula = $row->id_diaAberto;
          $titulo = $row->titulo;
          $data1 = $row->data1;
          $horas = $row->horas;
          $id_prof = $row->id_prof;
        }
         ?>
          <div class="content">
            <div class="row">
              <div class="col-lg-12 mt-5">

                <!-- Alerta - Operações (EDITAR) -->
                <?php
                if (isset($_SESSION["message"])) { ?>
                  <div class='alert alert-<?php echo $_SESSION["message"]["type"] ?> alert-dismissible fade show' role='alert'>
                    <?php echo $_SESSION["message"]["content"]; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-times"></span>
                    </button>
                  </div>

                <?php unset($_SESSION["message"]);
                }
                ?>

                <div class="card">
                  <div class="card-body">
                    <h4 class="header-title">Editar Aula</h4>
                    <br>
                    <div class="single-table">

                    <form id="editaula" action="editaula.php" method="POST">   
                    <div class="form-group">

                    <input type="text" class="form-control" id="id_diaAberto" name="id_diaAberto" value="<?= $id_aula ?>" required hidden>


                      <label for="inputtitulo">Titulo</label>
                      <input type="text" class="form-control" name="titulo" id="titulo" value="<?= $titulo; ?>" required>
                      <small id="titulo_preencher">
                        Por favor preencha o campo.
                      </small>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                      <label for="inputdata1">Data</label>
                      <input type="date" class="form-control" name="data1" id="data1" rows="2" value="<?= $data1; ?>" required>
                        <small id="data1_preencher">
                          Por favor preencha o campo.
                        </small>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="horas">Horas</label>
                        <select name="horas" id="horas" class="form-control">
                          <?php
                          $sql = "SELECT horas FROM diaaberto;";
                          $resulthoras = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($resulthoras)) {
                            foreach ($row as $res => $key) {
                              $p = $row['horas'];
                            }
                            echo "<option selected>$p</option>";
                          }
                          ?>
                        </select>
                        <small id="horas_preencher">
                          Por favor preencha o campo.
                        </small>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="id_prof">Escolher Professor</label>
                        <select name="id_prof" id="id_prof" class="form-control" required>
                          <?php
                          $sql = "SELECT * FROM professor WHERE id_prof = " . $id_prof . ";";
                          $resultProfesso = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($resultProfesso)) {
                            foreach ($row as $res => $key) {
                              $q = $row['nome'];
                            }
                            echo "<option selected>$q</option>";
                          }

                          $sql = "SELECT * FROM professor;";
                          $resultProfessor = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($resultProfessor)) {
                            foreach ($row as $res => $key) {
                              $id_prof = $row['id_prof'];
                              $nome = $row['nome'];
                            }
                            echo "<option value='$id_prof'>$nome</option>";
                          }
                          
                          ?>
                        </select>
                        <small id="professor_preencher">
                          Escolher o Professor que dá a aula.
                        </small>
                      </div>
                      </div>
                      <button type="submit" class="btn btn-primary" name="editaula">Editar</button>
                    <a href="showaula.php"><input type="button" value="Voltar" class="btn btn-primary"></a>
                    </div>
                  </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <br>
        <footer class="footer mt-auto">
          <?php
          require_once 'sheets/dashboardFooter.php';
          ?>
        </footer>



      </div>


      <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/plugins/simplebar/simplebar.min.js"></script>
      <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
      <script src="assets/plugins/apexcharts/apexcharts.js"></script>
      <script src="assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
      <script src="assets/plugins/daterangepicker/moment.min.js"></script>
      <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
      <script>
        jQuery(document).ready(function() {
          jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
              cancelLabel: 'Clear'
            }
          });
          jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
          });
          jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
            jQuery(this).val('');
          });
        });
      </script>
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script src="assets/plugins/toaster/toastr.min.js"></script>
      <script src="assets/js/mono.js"></script>
      <script src="assets/js/chart.js"></script>
      <script src="assets/js/map.js"></script>
      <script src="assets/js/custom.js"></script>
      <script>
        $(document).ready(function() {
          $('#editaula').on('input change', function() {
            $('#respondbutton').attr('disabled', false);
          });
        })
      </script>
<script>
        document.getElementById('data1').addEventListener('change', function() {
          var date = new Date(this.value);
          var days = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
          var dayOfWeek = days[date.getDay()];
          document.getElementById('titulo').value = dayOfWeek;
        });
      </script>
</body>

</html>