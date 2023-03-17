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

if(isset($_GET["cree"],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role']))
{
    if($_GET["cree"] == 1)
    {
        if (!isset($_POST["password"])) 
        {
            $message="Problème avec le formulaire ne pas modifié le css.";
            header("Location: createUser.php?message=" . urlencode($message));
            exit();
        }
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $passwordUser = $_POST['password'];

        try
        {
            $Admin->createUser($nom, $prenom, $email, $role, $passwordUser);
        }
        catch(Exception $e)
        {
            $message="Erreur : ".$e->getMessage();
            header("Location: createUser.php?message=" . urlencode($message));
            exit();          
        }

        $message="Utilisateur créé avec succès.";
        header("Location: createUser.php?message=" . urlencode($message));
        exit();
    }
    else
    {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $passwordUser=NULL;
        if (isset($_POST["password"])) 
        {            
            $passwordUser = $_POST['password'];
        }
        try
        {
            $Admin->updateUserAdmin($id, $nom, $prenom, $email, $role, $passwordUser);
        }
        catch(Exception $e)
        {
            $message="Erreur : ".$e->getMessage();
            echo $message;
            header("Location: createUser.php?message=" . urlencode($message));
            exit();          
        }
        $message="Utilisateur modifiée avec succès.";
        header("Location: createUser.php?message=" . urlencode($message));
        exit();
    }
}
else
{
    $message="Problème avec le formulaire ne pas modifié le css.";
    header("Location: createUser.php?message=" . urlencode($message));
    exit();
}