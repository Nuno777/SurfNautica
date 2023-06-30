<?php
$email = array_key_exists('email', $_POST) ? $_POST['email'] : "";
$nome = array_key_exists('nome', $_POST) ? $_POST['nome'] : "";
$pass = array_key_exists('password', $_POST) ? $_POST['password'] : "";
$cpass = array_key_exists('cpassword', $_POST) ? $_POST['cpassword'] : "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // validar variáveis
  if ($email == "" || $pass == "" || $cpass == "" || $nome == "") {
    $msg_erro = "Email, nome ou password não inseridos!";
  } else {
    /* 1: estabelecer ligação à BD */
    require_once 'conexao.php';
    if ($conn->connect_errno) {
      $code = $conn->connect_errno;
      $message = $conn->connect_error;
      $msg_erro = "Falha na ligação à BaseDados ($code $message)!";
    } else {
      // descontaminar variáveis
      $email = $conn->real_escape_string($email);
      $nome = $conn->real_escape_string($nome);
      $email = htmlspecialchars($email);
      $nome = htmlspecialchars($nome);
      $pass = htmlspecialchars($pass);
      $cpass = htmlspecialchars($cpass);
      // $pass não precisa porque não será usada diretamente na query
      $pass_hash = hash('sha512', $pass);
      if ($pass !== $cpass) {
        $msg_erro = "Password diferentes!";
      } else {
        /* 2: executar query... */
        $query = "INSERT INTO `users` (`email`, `nome`, `pass`) VALUES ('$email', '$nome', '$pass_hash')";

        $sucesso_query = $conn->query($query);
        if ($sucesso_query) {
          $_SESSION['nome'] = $nome;
          $_SESSION['id'] = $id;
          header("Location: login.php");
          exit(0);
        } else {
          $code = $conn->errno; // error code of the most recent operation
          $message = $conn->error; // error message of the most recent op.
          $msg_erro = "Falha na query! ($code $message)";
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/register.css">
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
        <form method="POST" action="register.php" enctype="multipart/form-data">
          <h2>Registo</h2>
          <div class="inputbox">
            <i class="fa-solid fa-signature icon"></i>
            <input type="text" name="nome" id="nome" placeholder="Nome" required>
          </div>
          <div class="inputbox">
            <i class="fa-solid fa-envelope icon"></i>
            <input type="email" name="email" id="email" placeholder="Email" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
          </div>
          <div class="inputbox">
            <i class="fa-solid fa-lock icon"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
          </div>
          <div class="inputbox">
            <i class="fa-solid fa-lock icon"></i>
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirmar Password" required>
          </div>
          <div class="button">
            <button class="submit" id="register" name="register">Registar</button>
          </div>
          <div class="login">
            <p><a href="login.php">Já tens uma conta?</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>