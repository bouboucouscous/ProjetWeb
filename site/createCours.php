<?php
include_once('../class/Cadmin.php');
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
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/background.css">
    <link rel="stylesheet" href="CSS/user.css">
    <link rel="stylesheet" href="CSS/professeur.css">    
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/formAdmin.css">
    <script src="JS/jquery-3.6.3.min.js"></script>
    <script src="JS/admin.js"></script>
</head>
<body>
    <div class="barreHaut">
    <?php include "template/leftMenu.php";?>
    <div class="carreblanc">      
      <form action="function/createCours.php" method="POST">
          <input type="text" placeholder="Nom matiere" name="nomMatiere" required>
          <div class="box">
            <select name="Classe">
              <?php
               $tab = $Admin->getListClasse();
               foreach ($tab as $key => $value) {
                 echo '<option value="'.$value["idCLasse"].'">'.$value["idCLasse"].'</option>';
               }
              ?>
            </select>
          </div>
          <div class="box">
            <select name="Professeur">
              <?php
                $tab = $Admin->getListProf();
                foreach ($tab as $key => $value) {
                  echo '<option value="'.$value["identifiantLogin"].'">'.$value["identifiantLogin"].'</option>';
                }
              ?>
            </select>
          </div>
          <input type="datetime-local" name="date" required>
          <br><br><br>
          <input type="submit" id='submit' value='Créer' >
      </form>
      
      <table class="Cours">
        <thead>
          <th>ID</th>
          <th>Nom</th>
          <th>Date</th>
          <th>Professeur</th>
          <th>Classe</th>
        </thead>
        <tbody>
          <?php
            $tab = $Admin->getListCours();
            foreach ($tab as $key => $value) {            
              echo '<tr onclick="deleteCours(this,\''.$value["idCours"].'\')">';
              echo '<td>'.$value["idCours"].'</td>';
              echo '<td>'.$value["NomCours"].'</td>';
              echo '<td>'.$value["date"].'</td>';
              echo '<td>'.$value["idProf"].'</td>';
              echo '<td>'.$value["idClasse"].'</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
      <br>
      <form class="delete" action="function/deleteCours.php" method="GET" >
        <input hidden name="idCours" value="">
        <input disabled type="submit" id='submit' value='Supprimer Cours'>
      </form>
      <br>
      <?php
          $message="";
          if (isset($_GET["message"])) 
          {
              $message = $_GET["message"];
          }
          echo '<div class="msg">'.$message.'</div>';
        ?>
    </div>
</body>
</html>