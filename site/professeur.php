<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title></title>    
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/background.css">
    <link rel="stylesheet" href="CSS/user.css">
    <link rel="stylesheet" href="CSS/professeur.css">
    <script src="JS/script.js"></script>
    <script src="JS/jquery-3.6.3.min.js"></script>

</head>
<body>
    <div class="barreHaut">
        <div class="noirCestNoir" onclick="openNav()" style="cursor:pointer">
            <div><img src="CSS/image/profile2.jpg" class="ppProfile"></div>
            <div class="user">
                <div class="nom">Dijoux</div>
                <div class="prenom">Rémi &#9207;
                </div>                
            </div>
        </div>
        <div class="titre">Appel</div>
        <div><img src="CSS/image/3il_Logo.png" class="logo"></div>
    </div>
    <div id="MENU" class="MENU">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Lundi</a>
        <a href="#">Mardi</a>
        <a href="#">Mercredi</a>        
        <a href="#">Jeudi</a>        
        <a href="#">Vendredi</a>
        <a href="#">Historique d'appel</a>
    </div>

    <div class="carreblanc">
      <div id="cours">
       <?php
include_once('../class/Cprofesseur.php');

try {
    $prof = new Professeur("ChervyH","123456");

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