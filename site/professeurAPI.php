<?php

include_once('../class/Cprofesseur.php');

function setPresence() { 
	session_start();
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    try {
      $prof = new Professeur($username,$password);
      //$prof = new Professeur("ChervyH","123456");	
    } catch (Exception $e) {
        header("Location: login.php?message=" . urlencode($e));
        exit();
    }
	if (array_key_exists('eleve', $_POST)  && array_key_exists('cours', $_POST) && array_key_exists('present', $_POST)){
			if($_POST['present']==1) {
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

if (array_key_exists('action', $_GET)){

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

