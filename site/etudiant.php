<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title></title>    
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/background.css">
    <link rel="stylesheet" href="CSS/user.css">
    <link rel="stylesheet" href="CSS/etudiant.css">
</head>
<body>
    <div class="barreHaut">
        <div>
            <div><img src="CSS/image/profile2.jpg" class="ppProfile"></div>
            <div class="user">
                <div class="nom">Dijoux</div>
                <div class="prenom">Rémi</div>
            </div>
        </div>
        <div class="titre">Relevé d'absence</div>
        <div><img src="CSS/image/3il_Logo.png" class="logo"></div>
    </div>
    <div class="carreblanc">
        <?php
            include_once('../class/Celeve.php'); 
            try{
                $eleve = new Eleve("CoussyR", "123456"); 
                $presence = $eleve->getFicheAppel(); 
                foreach ($presence as $row){
                    echo "<p><a href=\"?presence=".$row['presence']."\">Presence : ".$row['presence']."</a></p>";
                    echo "<p>Cours: ".$row['idCours']."</p>";
                    }
                }catch(Exception $e){

                }
            ?>
    </div>
</body>
</html>