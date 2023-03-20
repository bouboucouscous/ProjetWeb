<?php
  include_once('../class/Celeve.php');
  session_start();
  $username = $_SESSION["username"];
  $password = $_SESSION["password"];
  
  try {
    $eleve = new Eleve($username,$password);
  } catch (Exception $e) {
    $message = "Utilisateur incorrect";
    header("Location: login.php?message=" . urlencode($message));;
    exit();
  }
  $nom = $eleve->GetNomPrenom()[0]["nom"];
  $prenom = $eleve->GetNomPrenom()[0]["prenom"];
?>
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
            <div class="user">
                <div class="nom"><?php echo $nom;?></div>
                <div class="prenom"><?php echo $prenom;?> </div>
            </div>
        </div>
        <div class="titre">Relevé d'absence</div>
        <div><img src="CSS/image/3il_Logo.png" class="logo"></div>
    </div>
    <div class="carreblanc">
        <?php
            include_once('../class/Celeve.php'); 
            try{ 
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