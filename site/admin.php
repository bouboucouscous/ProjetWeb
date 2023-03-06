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
        <a href="#" onclick="createUser()">Créer utilisateur</a>
        <a href="#" onclick="createCours()">Créer cours</a>
        <a href="#" onclick="createTeam()">Créer groupe</a>
    </div>
    <div class="carreblanc">
        <iframe id="accesPageByMenu" class="accesPageByMenu" src="createUser.html">
        </iframe>
    </div>
</body>
</html>