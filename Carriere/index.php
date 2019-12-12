<?php
session_start();
include_once("util/bd.inc.php");
include("util/bd.visite.inc.php");
include("util/bd.carriere.inc.php");
include("util/bd.entretien.inc.php");
include("util/bd.utilisateur.inc.php");
include("util/bd.personnel.inc.php");
include("util/bd.authentification.inc.php");

include("vues/v_entete.html");
include("vues/v_bandeau.html");

if (!isset($_REQUEST['uc'])) {
    $uc = 'accueil';
}
else {
	$uc = $_REQUEST['uc'];
}

if (isset($_SESSION['password'])) {
	include("vues/v_informationsConnexion.php");
}

switch ($uc)
{
	case 'accueil':
		if (!isset($_SESSION['password'])) {
			include("vues/v_champConnexion.html");
		}
		else {
			include("vues/dashboard.php"); 
		}
		break; 

	case 'visite':
		include("controleurs/c_visites.php"); 
		break; 

	case 'personnel': 
		include("controleurs/c_personnel.php");
		break;

	case 'profil' :
		include("controleurs/c_profil.php");
		break;

	case 'carriere' :
		include("controleurs/c_carriere.php");
		break;

	case 'entretien' :
		include("controleurs/c_entretien.php");
		break;

	case 'connexion' :
		include("controleurs/c_connexion.php");
		break;

	case 'deconnexion' :
		include("controleurs/c_deconnexion.php");
		break;
}
include("vues/v_pied.html") ;
?>

