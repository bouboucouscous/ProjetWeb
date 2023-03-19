<?php
require_once('../../class/Cadmin.php');
session_start();
$username = $_SESSION["username"];
$password = $_SESSION["password"];
try 
{
    $Admin = new Admin($username,$password);
} 
catch (Exception $e) 
{
    $message = "Utilisateur incorrect";
    header("Location: ../login.php?message=" . urlencode($message));;
    exit();
}
if(isset($_POST["nomMatiere"],$_POST["Classe"],$_POST["Professeur"],$_POST["date"]))
{
    try {
        $Admin->createCour($_POST["nomMatiere"],$_POST["Classe"],$_POST["date"],$_POST["Professeur"]);
    } 
    catch(Exception $e)
    {
        $message="Erreur : ".$e->getMessage();
        echo $message;
        header("Location: ../createCours.php?message=" . urlencode($message));
        exit();          
    }
    $message="Cours crée";
    header("Location: ../createCours.php?message=" . urlencode($message));
    exit();
}
else{
    $message="Erreur dans les informations envoyées";
    header("Location: ../createCours.php?message=" . urlencode($message));
    exit();
}