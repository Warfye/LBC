<?php
if(empty($_REQUEST['action']))
{
	$action = "";
}
else
{
	$action = $_REQUEST['action'];
}

include("vues/v_menu.php");

switch ($action) {

	default:
		$info = informationProfil($_SESSION['matricule']);

		if ($info['TYPEPROFIL'] == "V") {
			$TYPEPROFIL = "Visiteur";
		}
		else {
			$TYPEPROFIL = "Responsable";
		}
		include("vues/v_informations.php");
		break;

	case 'modifierProfil':
		$nom = $_REQUEST['nom'];
		$prenom = $_REQUEST['prenom'];
		$civilite = $_REQUEST['civilite'];
		$dateN = $_REQUEST['date'];
		$email = $_REQUEST['mail'];

		modifierProfil($nom, $prenom, $civilite, $dateN, $email, $_SESSION['matricule']);
		$info = informationProfil($_SESSION['matricule']);
		if ($info['TYPEPROFIL'] == "V") {
			$TYPEPROFIL = "Visiteur";
		}
		else {
			$TYPEPROFIL = "Responsable";
		}
		include("vues/v_informations.php");
		break;

}