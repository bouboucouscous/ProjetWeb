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
        <a href="createUser.php">Créer utilisateur</a>
        <a href="createCours.php">Créer cours</a>
        <a href="createTeam.php">Créer groupe</a>
    </div>
    <div class="carreblanc">      
      <form action="" method="POST">
          <input type="text" placeholder="Nom" name="nom" required>
          <input type="text" placeholder="Prenom" name="prenom" required>          
          <input type="email" placeholder="email" name="email" required>          
          <div class="box">
            <select name="role">
              <option value="Eleve">Élève</option>
              <option value="Professeur">Professeur</option>
            </select>
          </div>          
          <input type="password" placeholder="Mot de passe" name="password" required>
          <input type="file" id="avatar" name="avatar" accept=".png, .jpg">          
          <input type="submit" id='submit' value='Créer'>
      </form>
    </div>
    <?php
      require_once('../class/Cadmin.php');

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $email = $_POST['email'];
          $role = $_POST['username'];
          $password = $_POST['password'];
          try{
            $admin = new Admin("DijouxR","123456");
            $admin->creer_user($nom, $prenom, $email, $role, $password);
          }catch(Exception $e)
          {
            echo "Erreur : ".$e->getMessage()."<br/>";
            die();            
          }      
          echo "<p>Utilisateur créé avec succès.</p>";
      }
    ?>
  </body>
</html>
