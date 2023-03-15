<?php 
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
    <script src="JS/script.js"></script>
    <script src="JS/admin.js"></script>        
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/background.css">
    <link rel="stylesheet" href="CSS/user.css">    
    <link rel="stylesheet" href="CSS/professeur.css"> 
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <div class="barreHaut">
        <div class="noirCestNoir" onclick="openNav()" style="cursor:pointer">
            <div class="user">
                <div class="nom"><?php //ajouter nom admin?></div>
                <div class="prenom"><?php //ajouter prenom admin?> &#9207;
                </div>                
            </div>
        </div>
        <div class="titre">Admin</div>
        <div><img src="CSS/image/3il_Logo.png" class="logo"></div>
    </div>
    <div id="MENU" class="MENU">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="createUser.php">Utilisateur</a>
        <a href="createCours.php">Cours</a>
        <a href="createTeam.php">Classe</a>
    </div>
    <div class="carreblanc">
    <form action=".php" method="POST">
        <input type="text" placeholder="Nom" name="nom" required> 
        <br><br><br>
        <input type="submit" id='submit' value='Créer' >
      </form>
    </div>
</body>
</html>