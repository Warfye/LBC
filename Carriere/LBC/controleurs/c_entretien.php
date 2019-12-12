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
		if ($_SESSION['role'] == "D") 
	{
		$region = recuperernomRegion($_SESSION['numRegion']);
		$region = $region['NOMR'];
		$entretienR = voirMesEntretienRegion($_SESSION['numRegion'],
							$_SESSION['matricule']);
		
		$entretien = voirMesEntretienVisiteur($_SESSION['matricule']);
	}	
		elseif ($_SESSION['role'] == "R") 
	{
		$Nsecteur = trouvernomSecteur($_SESSION['numSecteur']);
		$secteur = $Nsecteur['NOMS'];
		$entretienS = voirMesEntretienSecteur($_SESSION['numSecteur']);

	}
		elseif ($_SESSION['role'] == "V")
	{
		$entretien = voirMesEntretienVisiteur($_SESSION['matricule']);
	}

		date_default_timezone_set('UTC');
		include("vues/v_entretien.php");
		break;

	case 'detailEntretien':
		
		$entretien = $_REQUEST['entretien'];
		$matricule = 1;
		$entretienInfo = detailEntretien($entretien);
		$objF = $entretienInfo['OBJECTIFFIXE'];
		$objA = $entretienInfo['OBJECTIFATTEINT'];
		$objN = $entretienInfo['OBJECTIFNV'];
		$dateE = $entretienInfo['dateE'];
		$entretienDate = $dateE;
		$commentaire = $entretienInfo['COMMENTAIRESALAIRE'];

		if (empty($commentaire)) {
			$commentaire = "Non renseigner";
		}

		$date = date_parse($dateE);
    	$annee = $date['year'];

		$critere = critereAmeliorer($matricule,$annee);
		date_default_timezone_set('UTC');
		include("vues/v_detailEntretien.php");
		break;

	case 'creerentretienCXV':

	$visiteur = getLesVisiteurs($_SESSION['numSecteur']);
	include("vues/v_choixVisiteur.php");
	break;


	case 'ajoutEntretien';


	$matricule = $_REQUEST['matricule'];

	$date = entretienMax($matricule);
	$date = $date['DATEENTRETIEN'];
	$objFixe = entretienAvant($matricule,$date);
	$obj = $objFixe['OBJECTIFNV'];


	include("vues/v_ajoutentretien.php");
	break;

	case 'confAjout':

		$matricule = $_REQUEST['matricule'];
		$objF = $_REQUEST['objF'];
		$objA = $_REQUEST['objA'];
		$objN = $_REQUEST['objN'];
		$prime = $_REQUEST['prime'];
		$date = $_REQUEST['date'];
		
		ajoutEntretien($matricule,$objF,$objA,$objN,$prime,$date);
		
		if ($_SESSION['role'] == "D") 
		{
			$region = recuperernomRegion($_SESSION['numRegion']);
			$region = $region['NOMR'];
			$entretienR = voirMesEntretienRegion($_SESSION['numRegion'],$_SESSION['matricule']);
			$entretien = voirMesEntretienVisiteur($_SESSION['matricule']);
		}	
			else if ($_SESSION['role'] == "R") 
		{
			$Nsecteur = trouvernomSecteur($_SESSION['numSecteur']);
			$secteur = $Nsecteur['NOMS'];
			$entretienS = voirMesEntretienSecteur($_SESSION['numSecteur']);

		}
			else if ($_SESSION['role'] == "V")
		{
			$entretien = voirMesEntretienVisiteur($_SESSION['matricule']);
		}

			date_default_timezone_set('UTC');
			include("vues/v_entretien.php");
	break;	

}