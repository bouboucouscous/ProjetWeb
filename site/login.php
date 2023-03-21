<?php 
    // Juste pour l'exemple : on vide la session (=> déconnexion)
    session_start();
    session_unset();
    
    // Générer un jeton CSRF aléatoire et le stocker dans la variable de session
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
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
    <form action="function/connexion.php" method="POST">
      <img src="CSS/image/3il_Logo.png" class="logo">
      <br><br>
      <?php echo '<div id="errorMessage" style="text-align: center; font-size: 25px; font-weight: bold;">'.$message.'</div>'?>
      <br>
      <!-- Champ de formulaire pour le jeton CSRF -->
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <input class="inputModerne" type="text" placeholder="Nom d'utilisateur" name="username" required>
      <br><br>
      <input class="inputModerne" type="password" placeholder="Mot de passe" name="password" required>
      <br><br><br>
      <input class="buttonCo" type="submit" id='submit' value='Connexion' >
    </form>
    <a href="oublieMDP.php" class="mdpOublie">Mot de passe oublié?</a>
  </div>
</body>
</html>