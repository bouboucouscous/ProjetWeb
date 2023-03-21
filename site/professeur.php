<?php
    include_once('../class/Cprofesseur.php');
    session_start();
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    try {
      $prof = new Professeur($username,$password);
      $nom = $prof->GetNomPrenom()[0]["nom"];
      $prenom = $prof->GetNomPrenom()[0]["prenom"];
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
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/background.css">
    <link rel="stylesheet" href="CSS/user.css">
    <link rel="stylesheet" href="CSS/professeur.css">
    <script src="JS/professeur.js"></script>
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
                try 
                {
                    $cours = $prof->getListCours();
                    $time= time();
                    $dateCurrentDay =  date( "Y-m-d H:i:s", $time );
            ?>
            <table>
                <thead>
                    <th>Nom Cours</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    <?php        
                            foreach ($cours as $row) 
                            {
                                if ($row['date'] <= $dateCurrentDay) 
                                {
                                    echo "<tr onclick='window.location.href = \"?cours=".$row['NomCours']."\"'>";
                                    echo '<td>'.$row['NomCours'].'</td>';
                                    echo '<td>'.$row['date'].'</td>';
                                    echo '</tr>';
                                }
                            }
                    ?>
                </tbody>
            </table>
            <?php 
                if(isset($_GET['cours']))
                { ?>
                <table>
                    <thead>
                    <tr><th colspan="2"><?php echo "Liste d'appel pour le cours ".$_GET['cours']."";?></th></tr>
                        <th>Eleve</th>
                        <th>Présence</th>
                    </thead>
                    <tbody>
                        <?php
                            $appel = $prof->getListAppelProfByCours($_GET['cours']);
                            foreach ($appel as $row) 
                            {
                                echo "<tr>";
                                echo '<td>'.$row['identifiantLogin'].'</td>';
                                echo '<td>'."<input type='checkbox' onclick=\"setPresence('".$_GET['cours']."','".$row['identifiantLogin']."',this)\"";
                                if($row['presence']==1)
                                {
                                    echo "checked";
                                }
                                echo '></td>';
                                echo '</tr>';
                            }                            
                        ?>
                    </tbody>
                </table>
            <?php }
            }
            catch(Exception $e) 
            {
                echo $e->getMessage();
            } ?>
        </div>
    </div>
</body>
</html>