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
if(isset($_GET["id"]))
{
    try
    {
        $Admin->deleteClasse($_GET["id"]);
    }
    catch(Exception $e)
    {
        $message="Erreur : ".$e->getMessage();
        echo $message;
        header("Location: ../createClasse.php?message=" . urlencode($message));
        exit();          
    }
    $message="utilisateur bien supprimé";
    header("Location: ../createClasse.php?message=" . urlencode($message));
    exit();
}
else{
    $message="Probleme avec l'id";
    header("Location: ../createClasse.php?message=" . urlencode($message));
    exit();
}