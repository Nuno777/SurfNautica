<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../login.php');
    exit(0);
}

require_once '../conexao.php';
$query = "SELECT permission from users where email = '{$_SESSION['email']}'";
$perms = mysqli_query($conn, $query);
$levelperm = mysqli_fetch_assoc($perms);
if ($levelperm['permission'] == 0) {
    header('Location: /Permission_level/dashboard/profile.php');
} else {
    if (isset($_POST["editUser"])) {
        $id = $_POST["id"];
        $email = $_POST["email"];
        $nome = $_POST["nome"];
        $query = "UPDATE users SET nome='$nome' WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        // Definir Alerta - Operações (UPDATE) 
        if ($conn->affected_rows > 0) {
            $_SESSION["message"] = array(
                "content" => "The email  <b>" . $email . "</b> permission has been updated successfully!",
                "type" => "success",
            );
        } else {
            $_SESSION["message"] = array(
                "content" => "There was an error updating email permissions <b>" . $email . "</b>!",
                "type" => "danger",
            );
        }
        header('Location: listUser.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="assets/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
    <link href="assets/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet" />
    <link id="main-css-href" rel="stylesheet" href="assets/css/style.css" />

    <link href="assets/images/favicon.png" rel="shortcut icon" />

    <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">

    <div class="wrapper">
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a>
                        <img src="assets/images/logo.png" alt="Mono">
                        <span class="brand-name">Bank.</span>
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
                    <span class="page-title">Edit User</span>

                    <div class="navbar-right ">
                        <?php
                        require_once 'sheets/dashboardNavbar.php';
                        ?>
                    </div>
                </nav>
            </header>


            <div class="content-wrapper">
                <?php
                $id = $_GET["id"];
                $query = "SELECT * FROM users WHERE id='$id'";
                $result = mysqli_query($conn, $query);
                if ($result && $result->num_rows) {
                    $row = $result->fetch_object();
                    $id = $row->id;
                    $email = $row->email;
                    $nome = $row->nome;
                    $permission = $row->permission;
                ?>
                    <div class="content">
                        <!-- Top -->
                        <form id="editUser" action="editUser.php" method="POST" enctype="multipart/form-data">
                            <div class="card card-body">
                                <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" required hidden>
                                <div class="form-group">
                                    <label for="recipient-name">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?>" disabled pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="recipient-name">Name</label>
                                            <input type="text" class="form-control " id="nome" name="nome" placeholder="Name" value="<?= $nome ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="recipient-name">Permission</label>
                                            <input type="number" class="form-control" id="permission" name="permission" placeholder="Permission" value="<?= $permission ?>" disabled minlength="1" maxlength="1" min="0" max="2" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <button class="btn btn-primary btn-pill" name="editUser" id="editbutton" type="submit" disabled>Edit</button>
                                    <a href="listAdmin.php" class="btn btn-secondary btn-pill" name="cancel" type="submit">Cancel</a>
                                </div>
                            </div>
                        </form>
                        <!-- End Top -->

                        <br>
                        <footer class="footer mt-auto">
                            <?php
                            require_once 'sheets/dashboardFooter.php';
                            ?>
                        </footer>
                    </div>
                <?php
                } else {
                    echo "<script>alert('Please select a valid user!');window.location='listAdmin.php'</script>";
                }
                ?>
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
                    $('#editUser').on('input change', function() {
                        $('#editbutton').attr('disabled', false);
                    });
                })
            </script>


</body>

</html>