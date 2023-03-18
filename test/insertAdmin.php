<?php
     try
     {
         $Conn = new PDO("mysql:host=localhost;dbname=chabert0","chabert","h9IfJHFJ");
         $password = password_hash("123456",PASSWORD_DEFAULT);
         $sql ="INSERT INTO Login (identifiantLogin, nom, prenom, email, role, password, idClasse)
        VALUES ('"."DijouxR"."', '"."Dijoux"."', '"."Rémi"."', '"."RémiDij@gmail.com"."', '"."Admin"."', '".$password."', NULL)";
        if ($Conn->query($sql) == TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $Conn->error;
        }  
     }
     catch (PDOException $e)
     {
         echo "Erreur PDO : ".$e->getMessage()."<br/>";
         die();        
     }
