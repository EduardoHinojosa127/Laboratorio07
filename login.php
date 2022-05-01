<?php

  session_start();

  require 'database.php';

  if (!empty($_POST['Email']) && !empty($_POST['Password'])) {
    $records = $conn->prepare('SELECT *FROM usuarios WHERE Email = :Email');
    $records->bindParam(':Email', $_POST['Email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['Password'], $results['Password'])) {
      $_SESSION['user_id'] = $results['idUsuarios'];
      $message="Bienvenido ".$results['Nombres']." ".$results['Apellidos'];?>
      <a href="indexx.html">Ir a la página de inicio</a>
    <?php
    } else {
      $message = 'Disculpe, las credenciales no son correctas';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>o <a href="signup.php">Registro</a></span>

    <form action="login.php" method="POST">
      <input name="Email" type="text" placeholder="Ingrese su email">
      <input name="Password" type="password" placeholder="Ingrese su contraseña">
      <input type="submit" value="Enviar">
    </form>
  </body>
</html>
