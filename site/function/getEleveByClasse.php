<?php
include_once('../../class/Cadmin.php');
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

echo json_encode($Admin->getListStudentByIdClasse($_GET["id"]), JSON_UNESCAPED_UNICODE);