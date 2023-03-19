<?php
include_once('../class/Cadmin.php');
    session_start();
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    try {
      $login = new Admin($username,$password);
    } catch (Exception $e) {
        header("Location: login.php?message=" . urlencode($e));
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title></title>    
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/background.css">
    <link rel="stylesheet" href="CSS/user.css">
    <link rel="stylesheet" href="CSS/professeur.css">    
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/formAdmin.css">
    <script src="JS/jquery-3.6.3.min.js"></script>
    <script src="JS/admin.js"></script>
</head>
<body>
    <div class="barreHaut">
    <?php include "template/leftMenu.php";?>
    <div class="carreblanc">      
      <form action=".php" method="POST">
          <input type="text" placeholder="Nom matiere" name="nomMatiere" required> 
          <br><br>       
          <input type="text" placeholder="Professeur" name="Professeur" required>
          <br><br>        
          <input type="text" placeholder="Classe" name="Classe" required>
          <br><br><br>
          <input type="submit" id='submit' value='Créer' >
        </form>
    </div>
</body>
</html>