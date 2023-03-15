<?php
require_once('../class/Cadmin.php');
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
    header("Location: login.php?message=" . urlencode($message));;
    exit();
}
if(isset($_GET["id"]))
{
    $Admin->deleteUserById($_GET["id"]);
    $message="utilisateur bien supprimé";
    header("Location: createUser.php?message=" . urlencode($message));
    exit();
}
else{
    $message="Probleme avec l'id";
    header("Location: createUser.php?message=" . urlencode($message));
    exit();
}