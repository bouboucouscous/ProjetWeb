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
        $Admin->deleteUserById($_GET["id"]);
    }
    catch(Exception $e)
    {
        $message="Erreur : ".$e->getMessage();
        header("Location: ../createUser.php?message=" . urlencode($message));
        exit();          
    }
    $message="Classe bien supprimé";
    header("Location: ../createUser.php?message=" . urlencode($message));
    exit();
}
else{
    $message="Probleme avec l'id";
    header("Location: ../createUser.php?message=" . urlencode($message));
    exit();
}