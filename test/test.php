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
    <form action="" method="POST">
        <input type="text" placeholder="Nom" name="nom" required> 
        <br><br><br>
        <input type="submit" id='submit' value='Créer' >
      </form>
    </div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once('../class/Celeve.php');
        try{
            $eleve = new Eleve("CoussyR","123456");
            $appel = $eleve->getFicheAppel();
            foreach ($appel as $col) {
                foreach ($col as $lin) {
                    echo "<p>$lin</p>";
                }              
            }    
        }catch(Exception $e){
            echo "<p>$e</p>";
        }
    }
?>
</body>
</html>