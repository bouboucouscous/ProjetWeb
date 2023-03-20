<?php

include_once('../../class/Cprofesseur.php');

function setPresence() { 
	session_start();
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    try {
      $prof = new Professeur($username,$password);
    } catch (Exception $e) {
        header("Location: login.php?message=" . urlencode($e));
        exit();
    }
	if(isset($_POST['cours'],$_POST['eleve'],$_POST['present']))
	{
		if($_POST['present'] == "true") {
			$prof->setElevePresent($_POST['cours'],$_POST['eleve']);

		} else {
			$prof->setEleveNonPresent($_POST['cours'],$_POST['eleve']);
		}
		echo json_encode([
			'cours'=> $_POST['cours'],
			'eleve'=> $_POST['eleve'],
			'present'=> $_POST['present']
		]);
	}
	else {
		http_response_code(400);
		echo json_encode($_POST);
		echo "Manque informations dans le post";
		return;
	}	

}

if (isset($_GET['action'])){

	switch ($_GET['action']) {
		case 'setPresent':
			setPresence();
			break;
		
		default:
			http_response_code(400);
			echo "Ne fonctionne pas";
			break;
	}
}

