<?php
session_start();
require_once 'conexao.php';
if (isset($_POST['login'])) {
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $password = hash('sha512', $password); //segurança
    $query = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
    $result = mysqli_query($conn, $query);
    header("location: dashboard/dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="assets/js/jquery-3.6.3.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script defer src="assets/js/app.js"></script>

    <link href="assets/img/favicon.ico" rel="icon">
    <link href="assets/img/favicon.png" rel="apple-touch-icon">
</head>

<body>
    <section>
        <div class="img"></div>
        <div class="form-box">
            <div class="form-value">
                <form method="POST" action="auth.php" enctype="multipart/form-data">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <i class="fa-solid fa-envelope icon"></i>
                        <input type="email" name="email" id="email" value="<?php if (isset($_COOKIE["email"])) {
                                                                                echo $_COOKIE["email"];
                                                                            } ?>" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <i class="fa-solid fa-lock icon"></i>
                        <input type="password" name="password" id="password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                        echo $_COOKIE["password"];
                                                                                    } ?>" required>
                        <label for="">Password</label>
                    </div>
                    <div class="remember">
                        <label for=""><input type="checkbox" name="rememberMe">&nbspLembrar-me&nbsp</label>
                    </div>
                    <div class="button">
                        <button class="submit" id="login" name="login">Login</button>
                    </div>
                    <div class="register">
                        <p><a href="register.php">Não tens uma conta? Regista-te aqui</a></p>
                    </div>
                    <div class="forget">
                        <a href="#">Esqueci a password</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>