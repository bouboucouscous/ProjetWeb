<?php
  include_once('../class/Cadmin.php');
  session_start();
  $username = $_SESSION["username"];
  $password = $_SESSION["password"];
  
  try {
    $Admin = new Admin($username,$password);
  } catch (Exception $e) {
    $message = "Utilisateur incorrect";
    header("Location: login.php?message=" . urlencode($message));;
  exit();
  }
  $nom = $Admin->GetNomPrenom()[0]["nom"];
  $prenom = $Admin->GetNomPrenom()[0]["prenom"];
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
    <script src="JS/script.js"></script>
    <script src="JS/jquery-3.6.3.min.js"></script>
    <script src="JS/admin.js"></script>
</head>
<body>
    <div class="barreHaut">
        <div class="noirCestNoir" onclick="openNav()" style="cursor:pointer">
            <div class="user">
                <div class="nom"><?php echo $nom; ?></div>
                <div class="prenom"><?php echo $prenom;?> </div>
                <div id="btnNav" style="text-align: right;"></div>
            </div>
        </div>
        <div class="titre">Admin</div>
        <div><img src="CSS/image/3il_Logo.png" class="logo"></div>
    </div>
    <div id="MENU" class="MENU">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="createUser.php">Utilisateur</a>
        <a href="createCours.php">Cours</a>
        <a href="createTeam.php">Classe</a>
    </div>
    <div class="carreblanc">
      <form action="creerOuUpdate.php?cree=1" method="POST">
          <input type="text" placeholder="Nom" name="nom" required value="">
          <input type="text" placeholder="Prenom" name="prenom" required value="">          
          <input type="email" placeholder="email" name="email" required value="">          
          <div class="box">
            <select name="role">
              <option value="Eleve">Élève</option>
              <option value="Professeur">Professeur</option>              
              <option value="Admin">Admin</option>
            </select>
          </div>          
          <input type="password" placeholder="Mot de passe" name="password" required>
          <input hidden name="id" value="">     
          <input type="submit" id='submit' value='Créer'>
      </form>
      <table class="tableauEleve">
        <thead>
          <th style="display:none">ID</th>
          <th>Nom</th>
          <th>Prénom</th>          
          <th>Status</th>
        </thead>
        <tbody>
          <tr onclick="UpdateUser(this,'nouveau')">
            <td style="display:none">0</td>
            <td>...</td>
            <td>...</td>
            <td>...</td>
          </tr>
          <?php
          $tab = $Admin->getListUser();
          foreach ($tab as $key => $value) {            
            echo '<tr onclick="UpdateUser(this,\''.$value["identifiantLogin"].'\')">';
            echo '<td>'.$value["nom"].'</td>';
            echo '<td>'.$value["prenom"].'</td>';
            echo '<td>'.$value["role"].'</td>';
            echo '</tr>';
          }
          ?> 
        </tbody>
      </table>
      <br><br><br>
      <div id="Message"></div>
      <form class="delete" action="deleteUser.php?id=" method="GET" >
        <input hidden name="id" value="">
        <input disabled type="submit" id='submit' value='Supprimer utilisateur'>
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
  </body>
</html>