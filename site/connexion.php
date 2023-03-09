<?php
require_once('../class/Clogin.php');
if(isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $login = new CLogin($username,$password);
    $role = $login->LoginUserGetRole();
    switch ($role) {
        case 'Admin':
            header("Location: admin.php");
            exit();
        case 'Professeur':
            //Il faut crée la page user
            header("Location: professeur.php");
            exit();
        case 'Eleve':
            //Il faut crée la page user
            header("Location: etudiant.php");
            exit();
        default:
            $message = "Rôle d'utilisateur inconnu.";
            header("Location: login.php?message=" . urlencode($message));
            exit();
    }
}else{
    $message = "Nom d'utilisateur ou mot de passe incorrect.";
    header("Location: login.php?message=" . urlencode($message));
    exit();
}
?>