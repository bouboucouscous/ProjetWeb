<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="JS/script.js"></script>
    <script src="JS/admin.js"></script>
  </head>
  <body>
    <form action="" method="POST">
        <input type="text" placeholder="Nom" name="nom" required>
        <br><br>
        <input type="text" placeholder="Prenom" name="prenom" required>
        <br><br>
        <input type="text" placeholder="email" name="email" required>
        <br><br>
        <input type="text" placeholder="role" name="username" required>
        <br><br>
        <input type="password" placeholder="Mot de passe" name="password" required>
        <br><br><br>
        <input type="submit" id='submit' value='Créer'>
    </form>

    <?php
      require_once('../CommBdd/admin.php');

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $email = $_POST['email'];
          $role = $_POST['username'];
          $password = $_POST['password'];
          $admin = new Admin();
          $admin->creer_user($nom, $prenom, $email, $role, $password);

          echo "<p>Utilisateur créé avec succès.</p>";
      }
    ?>
  </body>
</html>
