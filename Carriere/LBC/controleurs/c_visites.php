<?php
/**
* Ce module permet de gérer l'ensemble des visites effectuées par le responsable avec le visiteur.
* @author Corentin GOURICHON
* @package controller
*/
if (empty($_REQUEST['action'])) {
	$action = "";
}
else {
	$action = $_REQUEST['action'];
}

include("vues/v_menu.php");

switch ($action) {
	
	default: 
		if ($_SESSION['role'] == 'R') {
			$lesVisitesSimples = getLesVisitesSimplesParSecteur($_SESSION['numSecteur']);
			$lesVisitesEvaluees = getLesVisitesEvalueesParSecteur($_SESSION['numSecteur']);
		}
		else if ($_SESSION['role'] == 'D') {
			$lesVisitesSimples = getLesVisitesSimplesParRegionDelegue($_SESSION['numSecteur'], 
									   $_SESSION['numRegion'], $_SESSION['matricule']);
			
			$lesVisitesEvaluees = getLesVisitesEvalueesParRegionDelegue($_SESSION['numSecteur'], 
										$_SESSION['numRegion'], $_SESSION['matricule']);
			
			$lesVisitesSimplesV = getLesVisitesSimplesParRegionVisiteur($_SESSION['numSecteur'], 
								 		$_SESSION['numRegion'], $_SESSION['matricule']);
			
			$lesVisitesEvalueesV = getLesVisitesEvalueesParRegionVisiteur($_SESSION['numSecteur'], 
										 $_SESSION['numRegion'], $_SESSION['matricule']);
		}
		else {
			$lesVisitesSimplesV = getLesVisitesSimplesParRegionVisiteur($_SESSION['numSecteur'], 
										$_SESSION['numRegion'], $_SESSION['matricule']);
			$lesVisitesEvalueesV = getLesVisitesEvalueesParRegionVisiteur($_SESSION['numSecteur'],
										$_SESSION['numRegion'], $_SESSION['matricule']);
		}
		date_default_timezone_set('UTC');
		include("vues/v_visites.php");
  		break;
	
	case 'ajouterVisiteSimple' :		
		$lesVisiteurs = getLesVisiteurs($_SESSION['numSecteur']);
		include("vues/v_ajouterVisiteSimple.php");
		break;
	
	case 'ajouterVisiteEvaluee' :
		$lesVisiteurs = getLesVisiteurs($_SESSION['numSecteur']);
		include("vues/v_ajouterVisiteEvaluee.php");
		break;

	case 'confirmerAjoutVisiteSimple' : 
		$dateVisite = $_POST['txtDateVisite'];
		$idVisiteur = $_POST['lstVisiteur'];
		$idResponsable = $_SESSION['numSecteur'];
		$resultat = setLaVisiteSimple($dateVisite, $idVisiteur, $idResponsable);
		if($resultat == false) {
			$message = 'Erreur lors de l\' insertion de la visite dans la base de données';
			include("vues/v_erreurs.php");
		}
		header("Location:index.php?uc=visite");
		break;

	case 'confirmerAjoutVisiteEvaluee' : 
		$dateVisite = $_POST['txtDateVisite'];
		$idVisiteur = $_POST['lstVisiteur'];
		$idResponsable = $_SESSION['numSecteur'];
		$resultat = setLaVisiteSimple($dateVisite, $idVisiteur, $idResponsable);
		if($resultat == false) {
			$message = 'Erreur lors de l\' insertion de la visite simple dans la base de données';
			include("vues/v_erreurs.php");
		}
		else {
			$idResponsable = $_SESSION['numSecteur'];
			$laVisite = getIdDerniereVisite($idResponsable);
			$idVisite = $laVisite['idVisite'];
			$resultat = setLaVisiteEvaluee($idVisite);
			if($resultat == false) {
				$message = 'Erreur lors de l\' insertion de la visite simple dans la base de données';
				include("vues/v_erreurs.php");
			}
			else
			{
				header("Location:index.php?uc=visite&action=ajouterCritere&idVisite=".$idVisite."");
			}
		}
		break;

	case 'ajouterCritere' : 
		$idResponsable = $_SESSION['numSecteur'];
		$idVisite = $_REQUEST['idVisite'];
		$laVisite = getLaVisite($idVisite);
		$lesCriteres = getLesCriteres($idVisite);
		include("vues/v_ajouterCritere.php");
		break;

	case 'confirmerAjoutCritere' :
		$idVisite = $_REQUEST['idVisite'];
		$idCritere = $_POST['lstCritere'];
		$note = $_POST['txtNote'];
		$bAAmeliorer = $_POST['optAmelioration'];
		$resultat = setLeCritere($idVisite, $idCritere, $note, $bAAmeliorer);
		if($resultat == false) {
			header("Location:index.php?uc=visite&action=ajouterCritere&idVisite=".$idVisite."");
		}
		else {
			header("Location:index.php?uc=visite");
		}
		break;

	case 'ajouterCommentaire': 
		$idVisite = $_REQUEST['idVisite'];
		$laVisite = getLaVisite($idVisite);
		date_default_timezone_set('UTC');
		$dateVisite = date("d-m-Y", strtotime($laVisite['DATEVISITE']));
		$nomComplet = strtoupper($laVisite['PRENOM']).' '.strtoupper($laVisite['NOM']);
		include ('vues/v_ajouterCommentaire.php');
		break;

	case 'confirmerAjoutCommentaire' : 
		$idVisite = $_REQUEST['idVisite'];
		$commentaire = $_REQUEST['txtCommentaire'];
		$resultat = setLeCommentaire($idVisite, $commentaire);
		if($resultat == false) {
			header("Location:index.php?uc=visite&action=ajouterCommentaire&idVisite=".$idVisite."");
		}
		else {
			header("Location:index.php?uc=visite");
		}
		break;

	case 'voirFicheVisiteEvaluee' : 
		$idVisite = $_REQUEST['idVisite'];
		$idResponsable = $_SESSION['numSecteur'];
		$laVisite = getLaVisite($idVisite);
		date_default_timezone_set('UTC');
		$dateVisite = date("d/m/Y", strtotime($laVisite['DATEVISITE']));
		$nomComplet = strtoupper($laVisite['PRENOM']).' '.strtoupper($laVisite['NOM']);
		$lesInformationsVisite = getLesInformationsVisiteEvaluee($idVisite, $idResponsable);
		$note = $lesInformationsVisite['MOYENNE'];
		$commentaire = $lesInformationsVisite['COMMENTAIREDELEGUE'];
		$lesCriteres = getLesCriteresByVisite($idVisite);
		include("vues/v_voirFicheVisiteEvaluee.php");
		break;

	case 'voirFicheVisiteSimple': 
		$idVisite = $_REQUEST['idVisite'];
		$idResponsable = $_SESSION['numSecteur'];
		$laVisite = getLaVisite($idVisite);
		date_default_timezone_set('UTC');
		$dateVisite = date("d/m/Y", strtotime($laVisite['DATEVISITE']));
		$nomComplet = strtoupper($laVisite['PRENOM']).' '.strtoupper($laVisite['NOM']);
		$commentaire = $laVisite['COMMENTAIREDELEGUE'];
		include("vues/v_voirFicheVisiteSimple.php");
		break;
}
?>

