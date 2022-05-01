<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['Email']) && !empty($_POST['Password'])) {
    $sql = "INSERT INTO usuarios (Nombres, Apellidos, Email, Password) VALUES (:Nombres, :Apellidos, :Email, :Password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Nombres', $_POST['Nombres']);
    $stmt->bindParam(':Apellidos', $_POST['Apellidos']);
    $stmt->bindParam(':Email', $_POST['Email']);
    $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':Password', $password);

    if ($stmt->execute()) {
      $message = 'Usuario creado satisfactoriamente';
    } else {
      $message = 'Ha ocurrido un error al crear el nuevo usuario';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    <span>o <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input type="text" name="Nombres" placeholder="Ingrese sus nombres">
      <input type="text" name="Apellidos" placeholder="Ingrese sus apellidos">
      <input name="Email" type="text" placeholder="Ingrese su email">
      <input name="Password" type="password" placeholder="Ingrese su contraseña">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
