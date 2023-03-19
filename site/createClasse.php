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
    <div class="carreblanc" style="column-count: 3;">
      <form action="function/manageClasse.php?cree=1" method="POST">
        <input type="text" placeholder="Nom de la classe" name="nom" required> 
        <br>
        <input type="submit" id='submit' value='Créer'>
      </form>
      <div class="ensemble">
        <table class="tableauClasse" style="position:relative;">
          <thead>
            <th style="display:none">ID</th>
            <th>Nom</th>
            <th>Nombre Élève</th>
          </thead>
          <tbody>
            <tr onclick="UpdateClasse(this,'nouveau')">
              <td>...</td>
              <td>...</td>
            </tr>
            <?php
            $tab = $Admin->getListClasse();
            foreach ($tab as $key => $value) {            
              echo '<tr onclick="UpdateClasse(this,\''.$value["idCLasse"].'\')">';
              echo '<td>'.$value["idCLasse"].'</td>';
              echo '<td>'.$Admin->getNbELeveFromClasse($value["idCLasse"]).'</td>';
              echo '</tr>';
            }
            ?> 
          </tbody>
        </table>
        <br>
        <form class="delete" action="function/deleteClasse.php" method="GET" >
          <input hidden name="id" value="">
          <input disabled type="submit" id='submit' value='Supprimer Classe'>
        </form>      
        <?php      
          $message="";
          if (isset($_GET["message"])) 
          {
              $message = $_GET["message"];
          }
          echo '<div class="msg">'.$message.'</div>';
        ?>
      </div>
      <table id="tableauEleveParClasse">
        <thead>
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
        </thead>
        <tbody>
          <tr onclick="AddUserToClasse()">
            <td style="display:none">0</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
          </tr>
        </tbody>
      </table>
      <br>
      <form class="delete" action="function/deleteEleveByClasse.php" method="GET" >
        <input hidden name="idClasse" value="">
        <input hidden name="idEleve" value="">
        <input disabled type="submit" id='submit' value='Supprimer Eleve de la classe'>
      </form>      
</body>
</html>