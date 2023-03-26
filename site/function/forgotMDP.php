<?php
if (isset($_POST["username"])) 
{
    if (isset($_POST["email"])) 
    {
        //si nom et le mail associé exite
        $login = new LoginNoPass($_POST["username"]);
        if($login->LoginNoPassExist($_POST["email"]))
        {   
            $to=$_POST["email"];
            $subject="Restauration mot de passe";
            $message="Votre mot de passe a été réinitialiser veuillez cliquer sur ce lien pour modifier celui de votre compte.";
            mail( $to, $subject, $message);
            $message = "Email envoyée.";
            header("Location: ../login.php?message=" . urlencode($message));
            exit();
        }
        else
        {
            $message = "Nom d'utilisateur non défini.";
            header("Location: ../oublieMDP.php?message=" . urlencode($message));
            exit();
        }
    }
    else
    {
        $message = "Email vide.";
        header("Location: ../oublieMDP.php?message=" . urlencode($message));
        exit();
    }
}
else
{
    $message = "Nom d'utilisateur vide.";
    header("Location: ../oublieMDP.php?message=" . urlencode($message));
    exit();
}