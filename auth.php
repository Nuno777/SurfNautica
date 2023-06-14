<?php
session_start();
require_once 'conexao.php';
$_SESSION['errors'] = array();
if (isset($_POST['email'])) $email = trim($_POST['email']);
else $email = "";
if (isset($_POST['password'])) $password = trim($_POST['password']);
else $password = "";
if (strlen($email) == 0)
    $_SESSION['errors']['email'] = 'Empty email';
if (strlen($password) == 0)
    $_SESSION['errors']['password'] = 'Empty password';
if (count($_SESSION['errors']) == 0) {
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT email,pass FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if ($result && $result->num_rows != 0) {
        $password = hash('sha512', $password);
        if ($result->fetch_object()->pass == $password) {
            $_SESSION['authenticated'] = true;
            $_SESSION['email'] = $email;
            if ($conn->affected_rows > 0) {
                $_SESSION["message"] = array(
                    "content" => "O email  <b>" . $email . "</b> fez login com sucesso!",
                    "type" => "success",
                );
                header('Location: dashboard/dashboard.php');
            } else {
                $_SESSION["message"] = array(
                    "content" => "Houve um erro ao entrar com o email <b>" . $email . "</b>!",
                    "type" => "danger",
                );
            }
        } else {
            $_SESSION['errors']['auth'] = 'Email/password incorretas';
            echo "<script>alert('Password errada!');window.location='login.php'</script>";

        }
    }
}
if (count($_SESSION['errors']) != 0) {
    header('Location: login.php');
    exit(0);
}
