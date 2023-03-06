<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="CSS/formAdmin.css">
    <script src="JS/script.js"></script>
    <script src="JS/admin.js"></script>
</head>
<body>
    <form action=".php" method="POST">
        <input type="text" placeholder="Nom matiere" name="nomMatiere" required> 
        <br><br>       
        <input type="text" placeholder="Professeur" name="Professeur" required>
        <br><br>        
        <input type="text" placeholder="Classe" name="Classe" required>
        <br><br><br>
        <input type="submit" id='submit' value='Créer' >
      </form>
</body>
</html>