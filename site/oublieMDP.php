<?php 
    // Juste pour l'exemple : on vide la session (=> déconnexion)
    session_start();
    session_unset();
    
    $message="";
    if (isset($_GET["message"])) 
    {
        $message = $_GET["message"];
    }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title></title>    
    <link rel="stylesheet" href="CSS/bootstrap.min.css">    
    <link rel="stylesheet" href="CSS/background.css">
    <link rel="stylesheet" href="CSS/loginPage.css">
</head>
<body>
  <div class="carrecolorer">
    <form action="function/forgotMDP.php" method="POST">
      <img src="CSS/image/3il_Logo.png" class="logo">
      <br><br>
      <?php echo '<div id="errorMessage" style="text-align: center; font-size: 25px; font-weight: bold;">'.$message.'</div>'?>
      <br>
      <input class="inputModerne" type="text" placeholder="Nom d'utilisateur" name="username" required>
      <br><br>
      <input class="inputModerne" type="email" placeholder="Email" name="email" required>
      <br><br><br>
      <input class="buttonCo" type="submit" id='submit' value='Restaurer MDP' >
    </form>
  </div>
</body>
</html>