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
$secteur = $_SESSION['numSecteur'];
switch ($action) {


	default:
		date_default_timezone_set('UTC');
		
		$lesDelegues = voirDelegueSecteur($secteur);
		$lesVisiteurs = voirVisiteurSecteur($secteur);

		include("vues/v_voirvisiteur.php");
		break;


	case 'modifierSecteur':

		$matricule = $_REQUEST['matricule'];
		$region = voirSecteurRegion();

		include("vues/v_modifierSecteur.php");
		break;

	case 'modifierSecteurValider':

		$matricule = $_REQUEST['matricule'];
		$nomRegion = $_REQUEST['lstregion'];
		$region1 = recupereridRegionACR($nomRegion);
		$idRegion = $region1[0][0];
		$idRegion = (int)$idRegion;

		$secteur1 = recupereridSecteurACR($nomRegion);
		$idSecteur = $secteur1[0][0];
		$idSecteur = (int)$idSecteur;
		

		date_default_timezone_set('UTC');
		$dateA = date("Y-m-d");

		$verifDate = verifDateffect($dateA,$matricule);
		$verifReg = verifLastReg($matricule,$idRegion);
		$verifDel = verifDel($idRegion);
		$verifSiDelegue = verifierSiDelegue($matricule);

		if ($verifSiDelegue == 0) {

		$verifDel = verifDel($idRegion);
		if (($verifReg['REG_CODE'] != $idRegion) && ($verifDate == 1) && ($verifDel == 1)) {
	
		$verifD=verifierDateExiste($date);
		if($verifD == 1){
			creerDate($dateA);
		}
			ajouterTravailler($matricule,$idRegion,$dateA);
			modifierSecteurVisiteur($matricule,$idSecteur);
		}
		}
		else{
			if (($verifReg['REG_CODE'] != $idRegion) && ($verifDate == 1)) {
				
		$verifD=verifierDateExiste($dateA);
		if($verifD == 1){
			creerDate($dateA);
		}
				ajouterTravailler($matricule,$idRegion,$dateA);
				modifierSecteurVisiteur($matricule,$idSecteur);
			}
		}
		$lesDelegues = voirDelegueSecteur($secteur);
		$lesVisiteurs = voirVisiteurSecteur($secteur);

		include("vues/v_voirvisiteur.php");
		break;


	case 'modifierRegion':

		$secteur = $_REQUEST['secteur'];
		$lesRegions = afficheSecteurParRegion($secteur);
		include("vues/v_modifierRegion.php");
		break;

	case 'modifierRegionValider':

		$matricule = $_REQUEST['matricule'];
		$nomRegion = $_REQUEST['lstregions'];
		date_default_timezone_set('UTC');
		$dateA = date("Y-m-d");

		$region1 = recupereridRegionACR($nomRegion);
		$idRegion = $region1[0][0];
		$idRegion = (int)$idRegion;


		$verifDate = verifDateffect($dateA,$matricule);
		$verifReg = verifLastReg($matricule,$idRegion);
		
		$verifSiDelegue = verifierSiDelegue($matricule);
		echo $verifSiDelegue;
		if ($verifSiDelegue == 0) {
			$verifDel = verifDel($idRegion);
			if (($verifReg['REG_CODE'] != $idRegion) && ($verifDate == 1) && ($verifDel == 1)) {
				$verifD=verifierDateExiste($dateA);
				if($verifD == 1){
					creerDate($dateA);
				}
				ajouterTravailler($matricule,$idRegion,$dateA);
			}
		}
		else {

			if (($verifReg['REG_CODE'] != $idRegion) && ($verifDate == 1)) {
				creerDate($dateA);
				ajouterTravailler($matricule,$idRegion,$dateA);
			}

		}
		$lesDelegues = voirDelegueSecteur($secteur);
		$lesVisiteurs = voirVisiteurSecteur($secteur);

		include("vues/v_voirvisiteur.php");
		break;

	case 'creervisiteur':

		$secteur = voirSecteurRegion();
		include("vues/v_creervisiteur.php");
		break;

	case 'creervisiteurValider':

		$nom = $_REQUEST['txtnom'];
		$prenom = $_REQUEST['txtprenom'];
		$civilite = $_REQUEST['optcivilite'];
		$dateN = $_REQUEST['date'];
		$email = $_REQUEST['txtmail'];
		$login = $_REQUEST['txtlogin'];
		$mdp = $_REQUEST['txtmdp'];


		$id = cherchermaxVisiteur();
		$idprofil = $id[0][0];
		$idprofil = (int)$idprofil+1;

		$region = $_REQUEST['lstregion'];
		$idSecteur = recupereridSecteurACR($region);
		$idmonSecteur1= $idSecteur[0][0];
		$idmonSecteur = (int)$idmonSecteur1;

		$idRegion = recupereridRegionACR($region);
		$idmaRegion1 = $idRegion[0][0];
		$idmaRegion = (int)$idmaRegion1;

		date_default_timezone_set('UTC');
		$dateA = date("Y-m-d");
		$verifD=verifierDateExiste($dateA);
		if($verifD == 1){
			creerDate($dateA);
		}
		

		creerProfil($nom,$prenom,$civilite,$dateN,$email,$login,$mdp,$idprofil);

		creerVisiteur($idprofil,$idmonSecteur);
		ajouterTravailler($idprofil,$idmaRegion,$dateA);
		
		

		include("vues/dashboard.php");
		break;
}
?>