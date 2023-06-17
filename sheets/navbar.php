<?php
require_once 'conexao.php';
session_start();
if (isset($_SESSION['authenticated'])) {
    $query = "SELECT nome FROM users WHERE email = '{$_SESSION['email']}'";
    $user = mysqli_query($conn, $query);
    if ($user->num_rows) {
        $row = $user->fetch_object();
        $nome = $row->nome;
    }
}

?>

<div class="container d-flex align-items-center justify-content-between">
    <div class="logo">
        <h1 class="text-light">
            <a href="index.php">
                <img src="assets/img/favicon.png" alt="" class="img-fluid">
                <span>SurfNautica</span>
            </a>
        </h1>
    </div>

    <nav id="navbar" class="navbar">
        <ul>
            <li class="dropdown">
                <a href="#" class="nav-link scrollto">
                    <span>Sobre</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="#">História do Clube</a></li>
                    <li><a href="TiagoQuintino/partners.php">Parcerias</a></li>
                    <li><a href="Daniel_Silva/professores.php">Professores</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="Tiago_Gomes/escolasurf.html" class="nav-link scrollto">
                    <span>Escola de Surf</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="Tiago_Gomes/diaaberto.php">Dias Abertos</a></li>
                    <li><a href="#">Aulas</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link scrollto">
                    <span>Info Surf</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="Diogo_Augusto/prancha.php">Pranchas</a></li>
                    <li><a href="Duarte_Lacerda/equipamentos.php">Equipamentos</a></li>
                </ul>
            </li>
            <li><a class="nav-link scrollto" href="noticias.php">Noticias</a></li>
            <li><a class="nav-link scrollto" href="contacto.php">Contactos</a></li>
            <?php

            if (isset($_SESSION['authenticated'])) {
                ?>
                <!-- echo '<li><a class="nav-link scrollto" href="profile.php">' . $nome . '</a></li>'; -->

                <li class="dropdown">
                <a href="dashboard/dashboard.php" class="nav-link scrollto">
                    <span><?php echo $nome?></span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="dashboard/user_profile.php">Perfil</a></li>
                    <li><a href="dashboard/logout.php">Logout</a></li>
                </ul>
            </li>
            <?php
            } else {
                echo '<li><a class="nav-link scrollto" href="login.php">Login</a></li>';
            }
            ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
</div>