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
if (isset($_GET['idClasse'],$_GET['idEleve']) && $Admin->adminUserExist($_GET['idEleve'])) {
    try {
        $Admin->ajouterStudentClasse($_GET['idClasse'],$_GET['idEleve']);
        echo json_encode($Admin->getListStudentByIdClasse($_GET["idClasse"]), JSON_UNESCAPED_UNICODE);
    } 
    catch (Throwable $th) {
        echo "Déjà dans une classe!!!";
    }
}
else
{
    echo "Identifiant invalide";
}


