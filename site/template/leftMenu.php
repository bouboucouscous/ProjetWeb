<?php
  include_once('../class/Cadmin.php');
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
<a href="createClasse.php">Classe</a>
</div>