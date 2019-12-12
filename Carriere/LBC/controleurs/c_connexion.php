<?php

if(empty($_POST['identifiantConnexion']))
{
	$pseudo=NULL;
}
else
{
	$pseudo=$_POST['identifiantConnexion'];
}

if(empty($_POST['mdpConnexion']))
{
	$mdp=NULL;
}
else
{
	$mdp=$_POST['mdpConnexion'];
}

include("vues/v_champConnexion.html");
$leClient = getInformationsConnexion($pseudo, $mdp);

if($leClient['TYPEPROFIL'] == 'R')
{
	$_SESSION['numSecteur'] = $leClient['IDPROFIL'];
	$_SESSION['role'] = 'R';
}
else 
{
	$_SESSION['matricule'] = $leClient['NUMPROFIL'];
	$leVisiteur = verifLastReg($_SESSION['matricule']);
	$_SESSION['numRegion'] = $leVisiteur['REG_CODE'];
	$_SESSION['numSecteur'] = $leClient['SEC_NUM'];

	if($leClient['DELEGUE'] == 1)
	{
		$_SESSION['role'] = 'D';
	}
	else
	{
		$_SESSION['role'] = 'V';
	}
}
$_SESSION['login'] = $leClient['LOGIN'];
$_SESSION['password'] = $leClient['PASSWORD'];
$hash = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
$_SESSION['nom'] = $leClient['NOM'];
$_SESSION['prenom'] = $leClient['PRENOM'];



if(!isset($_SESSION['password']))
{
	include("vues/v_champConnexion.html");
}
else
{
	header('Location: index.php?uc=accueil');	
}


?>
