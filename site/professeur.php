<?php
  include_once('../class/Cprofesseur.php');
  session_start();
  $username = $_SESSION["username"];
  $password = $_SESSION["password"];
  
  try {
    $prof = new Professeur($username,$password);
  } catch (Exception $e) {
    $message = "Utilisateur incorrect";
    header("Location: login.php?message=" . urlencode($message));;
    exit();
  }
  $nom = $prof->GetNomPrenom()[0]["nom"];
  $prenom = $prof->GetNomPrenom()[0]["prenom"];
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
    <script src="JS/script.js"></script>
    <script src="JS/jquery-3.6.3.min.js"></script>

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
      <div id="cours">
       <?php
include_once('../class/Cprofesseur.php');

try {
    $cours = $prof->getListCours();
    foreach ($cours as $row) {
        echo "<p><a href=\"?cours=".$row['NomCours']."\">Nom Cours : ".$row['NomCours']."</a></p>";
        echo "<p>Date : ".$row['date']."</p>";
    }

    if(isset($_GET['cours'])){
        $appel = $prof->getListAppelProfByCours($_GET['cours']);
        echo "----------------------------";
        echo "<p>Liste d'appel pour le cours ".$_GET['cours']."</p>";
        foreach ($appel as $row) {
            echo "<p>Eleve : ".$row['identifiantLogin']."</p>";
            echo "<p>Presence : <span id='presence_".$row['identifiantLogin']."'>".$row['presence']."</span></p>";
            echo "<button onclick=\"setPresence('".$_GET['cours']."','".$row['identifiantLogin']."', true)\">Présent</button>";
            echo "<button onclick=\"setPresence('".$_GET['cours']."','".$row['identifiantLogin']."', false)\">Absent</button>";
        }
    }
} catch(Exception $e) {
    echo "<p>".$e->getMessage()."</p>";
}
?>

<script>
function setPresence(cours, eleve, isPresent) {
   
    $.post("/~chabert/site/professeurAPI.php?action=setPresent",
    {
        cours:cours,
        eleve:eleve,
        present:isPresent
    },
    (result,status)=>{
        const resultat = JSON.parse(result);
        //recup boolean
        console.log($("#presence_"));
        $("#presence_"+resultat.eleve).text(resultat.present == "true" ? "1" : "0");
    }

        );
    
}
</script>


      </div>
    </div>
</body>
</html>