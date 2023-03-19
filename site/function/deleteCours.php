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
if(isset($_GET["idCours"]))
{
    try {
        $Admin->deleteCour($_GET["idCours"]);
    } 
    catch(Exception $e)
    {
        $message="Erreur : ".$e->getMessage();
        echo $message;
        header("Location: ../createCours.php?message=" . urlencode($message));
        exit();          
    }
    $message="Cours bien supprimé";
    header("Location: ../createCours.php?message=" . urlencode($message));
    exit();
}
else{
    $message="Probleme avec un id";
    header("Location: ../createCours.php?message=" . urlencode($message));
    exit();
}