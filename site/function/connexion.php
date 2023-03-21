<?php
require_once "../../class/Clogin.php";
if(isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    try {
        $login = new Login($username,$password);
        $role = $login->LoginUserGetRole();
    } catch (Exception $e) {
        $message = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: ../login.php?message=" . urlencode($message));
        exit();
    }
    session_start();

     // Vérifier si le formulaire a été soumis et si le jeton CSRF est valide
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $message = "Erreur.";
            header("Location: ../login.php?message=" . urlencode($message));
            exit();
        }
    }
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    switch ($role) {
        case 'Admin':
            header("Location: ../createUser.php");
            exit();
        case 'Professeur':
            header("Location: ../professeur.php");
            exit();
        case 'Eleve':
            //Il faut crée la page user
            header("Location: ../etudiant.php");
            exit();
        default:
            $message = "Rôle d'utilisateur inconnu.";
            header("Location: ../login.php?message=" . urlencode($message));
            exit();
    }
}else{
    $message = "Nom d'utilisateur ou mot de passe incorrect.";
    header("Location: ../login.php?message=" . urlencode($message));
    exit();
}
?>
