<?php
    try
    {
        $Conn = new PDO("mysql:host=localhost;dbname=chabert0","chabert","h9IfJHFJ");
    }
    catch (PDOException $e)
    {
        echo "Erreur PDO : ".$e->getMessage()."<br/>";
        die();
        
    }

    $texteRequete = "select identifiantLogin, nom, prenom from Login";	
	$requete = $Conn->prepare($texteRequete);
	$requete->execute();
	
	// récupération du résultat dans un tableau associatif
	$tabRes = $requete->fetchAll(PDO::FETCH_ASSOC);
	
	// Si vous voulez mieux comprendre la structure de données retournée :
	//var_dump($tabRes);
	
	foreach($tabRes as $uneLigne)
	{
		echo $uneLigne['identifiantLogin']." : ".$uneLigne['nom']. " --> ".$uneLigne['prenom']. "<br>";
	}
