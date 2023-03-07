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
    <script src="JS/script.js"></script>
    <script src="JS/admin.js"></script>
</head>
<body>
    <div class="barreHaut">
        <div class="noirCestNoir" onclick="openNav()" style="cursor:pointer">
            <div><img src="CSS/image/profile.jpg" class="ppProfile"></div>
            <div class="user">
                <div class="nom">LEBG</div>
                <div class="prenom">Enzo &#9207;
                </div>                
            </div>
        </div>
        <div class="titre">Admin</div>
        <div><img src="CSS/image/3il_Logo.png" class="logo"></div>
    </div>
    <div id="MENU" class="MENU">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="createUser.php">Créer utilisateur</a>
        <a href="createCours.php">Créer cours</a>
        <a href="createTeam.php">Créer groupe</a>
    </div>
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