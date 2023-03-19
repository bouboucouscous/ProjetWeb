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

if(isset($_GET["cree"],$_POST['nom']))
{
    if($_GET["cree"] == 1)
    {
        //creation
        try
        {
            $Admin->createClasse($_POST['nom']);
        }
        catch(Exception $e)
        {
            $message="Erreur : ".$e->getMessage();
            echo $message;
            //header("Location: ../createClasse.php?message=" . urlencode($message));
            //exit();          
        }
        $message="Classe crée avec succès.";
        header("Location: ../createClasse.php?message=" . urlencode($message));
        exit();
    }
    else
    {
        //modifier nom classe et modifier le nom dans les élèves
    }
}
else
{
    $message="Problème avec le formulaire ne pas modifié le css.";
    header("Location: ../createClasse.php?message=" . urlencode($message));
    exit();
}