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
    <form action="connexion.php" method="POST">
      <img src="CSS/image/3il_Logo.png" class="logo">
      <br><br>
      <div id="errorMessage"><?php echo $message;?></div>
      <input class="inputModerne" type="text" placeholder="Nom d'utilisateur" name="username" required>
      <br><br>
      <input class="inputModerne" type="password" placeholder="Mot de passe" name="password" required>
      <br><br><br>
      <input class="buttonCo" type="submit" id='submit' value='Connexion' >
    </form>
    <a class="mdpOublie">Mot de passe oublié?</a>
  </div>
</body>
</html>