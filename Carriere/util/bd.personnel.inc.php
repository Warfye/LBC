<?php
/**
 * Liste des fonctions retournant les donnnées depuis la base de données vers le controleur 
 * c_personnel
 * @author Hugo GRELLIER
 * @package util
 */

/**
 * Retourne toute la liste des delegues du secteur
 * @param $secteur
 * @return tableau associatif
 */
	function voirDelegueSecteur($secteur) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT profil.IDPROFIL,profil.NOM,profil.PRENOM,region.NOMR,profil.idprofil,visiteur.SEC_NUM,travailler.DATEAFFECTATION 
				FROM profil 
				INNER JOIN visiteur ON visiteur.MATRICULE=profil.IDPROFIL 
				INNER JOIN travailler ON travailler.MATRICULE=profil.IDPROFIL 
				INNER JOIN region ON region.REG_CODE=travailler.REG_CODE 
				WHERE visiteur.DELEGUE=1 AND visiteur.SEC_NUM='$secteur' 
				AND profil.TYPEPROFIL!='R' AND travailler.DATEAFFECTATION 
				IN( SELECT max(travailler.DATEAFFECTATION) FROM travailler 
				GROUP BY travailler.MATRICULE ) ORDER BY DATEAFFECTATION DESC");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction


/**
 * Retourne toute la liste des visiteurs du secteur
 * @param $secteur
 * @return tableau associatif
 */
	function voirVisiteurSecteur($secteur) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT DISTINCT profil.NOM,profil.PRENOM,profil.idprofil,visiteur.SEC_NUM,travailler.REG_CODE,
				MAX(travailler.DATEAFFECTATION) as DATEAFFECTATION FROM profil 
				INNER JOIN visiteur ON visiteur.MATRICULE=profil.IDPROFIL 
				INNER JOIN travailler ON travailler.MATRICULE=profil.IDPROFIL 
				WHERE visiteur.DELEGUE=0 AND profil.TYPEPROFIL!='R' 
				AND visiteur.SEC_NUM='$secteur' GROUP BY idProfil ORDER BY DATEAFFECTATION DESC");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction


/**
 * Retourne tous les secteurs et les regions
 * @return tableau associatif
 */
	function voirSecteurRegion() {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT secteur.NOMS,region.NOMR,region.REG_CODE FROM `secteur` INNER JOIN region ON region.SEC_NUM=secteur.SEC_NUM");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction

	/**
 * Retourne l'id de la region avec son nom
  * @param $region
  * @return tableau associatif
 */
	function recupereridRegionACR($region) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT REG_CODE FROM REGION WHERE NOMR='$region'");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction

	/**
 * Retourne l'id du secteur avec le nom de la region
  * @param $region
  * @return tableau associatif
 */
	function recupereridSecteurACR($region) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT SEC_NUM FROM REGION WHERE NOMR='$region'");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction



/**
  * Verifie si un visiteur n'a pas déjà changé de region aujourd'hui
  * @param $dateAuj
  * @param $matricule
  * @return 1 si pas enregistré aujourd'hui ou sinon 0
 */
	function verifDateffect($dateAuj,$matricule) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT * from travailler where DATEAFFECTATION='$dateAuj' AND MATRICULE='$matricule'");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    	if (empty($donnees)) {
			return 1;
		}
		else{
			return 0;
		}
	}//fin fonction

/**
  * Verifie quelle est la région où est actuellement le visiteur
  * @param $matricule
  * @return tableau associatif
 */
	function verifLastReg($matricule) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT MAX(dateaffectation),REG_CODE from travailler WHERE travailler.MATRICULE='$matricule'");
			$sql->execute();
			$donnees = $sql->fetch();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction


	/**
  * Verifie quelle est la région où est actuellement le visiteur
  * @param $region
  * @return tableau associatif
 */
	function verifDel($region) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT * FROM `travailler` 
				INNER JOIN visiteur ON visiteur.MATRICULE=travailler.MATRICULE
				WHERE visiteur.DELEGUE=1 
				AND travailler.REG_CODE='$region' AND DATEAFFECTATION=(SELECT MAX(DATEAFFECTATION) from travailler)");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction

	/**
  * Verifie si le visiteur est délégué
  * @param $matricule
  * @return 1 ou 0
  */
		function verifierSiDelegue($matricule) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT * FROM visiteur where visiteur.MATRICULE = '$matricule'
			AND visiteur.DELEGUE=1");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    if (empty($donnees)) {
		return 1;
	}
	else{
		return 0;
	}
	}//fin fonction


	/**
  * Verifie si le visiteur est délégué
  * @param $date
  * @return 1 ou 0
  */
		function verifierDateExiste($date) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT * FROM DATEAFFECTATION 
								where DATEAFFECTATION = '$date'");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    if (empty($donnees)) {
		return 1;
	}
	else{
		return 0;
	}
	}//fin fonction


/**
  * Creer la date dans la table dateaffectation
  * @param $date
  */
function creerDate($date) {
	try {
		$cnx=connexionPDO();
		$sql=$cnx->prepare("INSERT INTO dateaffectation(DATEAFFECTATION) VALUES (:dateA)");
		$sql->bindValue('dateA',$date,PDO::PARAM_STR);
		$sql->execute();	
	}//fin try
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch
}//fin fonction


/**
  * Ajouter le visiteur dans la table travailler
  * @param $matricule
  * @param $idRegion
  * @param $dateA
  */
function ajouterTravailler($matricule,$idRegion,$dateA) {
	try {
		$cnx=connexionPDO();
		$sql=$cnx->prepare("INSERT INTO travailler(REG_CODE, MATRICULE, DATEAFFECTATION)
			VALUES (:idregion, :matricule, :dateA)");
		$sql->bindValue(':idregion',$idRegion,PDO::PARAM_STR);
		$sql->bindValue(':matricule',$matricule,PDO::PARAM_STR);
		$sql->bindValue(':dateA',$dateA, PDO::PARAM_STR);
		$sql->execute();	
	}//fin try
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch
}//fin fonction


	/**
  * Modifier le secteur dans visiteur
  * @param $matricule
  * @param $idSecteur
  */
		function modifierSecteurVisiteur($matricule,$idSecteur) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("UPDATE `visiteur` SET `SEC_NUM` = '$idSecteur' 
								WHERE MATRICULE='$matricule'");
			$sql->execute();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch
	}//fin fonction



/**
  * afficher les region du secteur choisi
  * @param $region
  * @return tableau associatif
 */
	function afficheSecteurParRegion($secteur) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT region.NOMR FROM `secteur` 
							INNER JOIN region ON region.SEC_NUM = secteur.SEC_NUM 
							WHERE secteur.SEC_NUM = '$secteur'");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction


	/**
  * cherche le matricule maximum
  * @return tableau associatif
 */
	function cherchermaxVisiteur() {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("SELECT MAX(visiteur.MATRICULE) FROM visiteur");
			$sql->execute();
			$donnees = $sql->fetchAll();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

    return $donnees;
	}//fin fonction





/**
  * Creer un profil
  * @param $nom
  * @param $prenom
  * @param $civilite
  * @param $dateN
  * @param $email
  * @param $login
  * @param $mdp
  * @param $idprofil
  */
		function creerProfil($nom,$prenom,$civilite,$dateN,$email,$login,$mdp,$idprofil) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("INSERT INTO `profil`
				(`NOM`, `PRENOM`, `CIVILITE`, `DATENAISSANCE`, `EMAIL`, `LOGIN`, `PASSWORD`,
				 `TYPEPROFIL`,`IDPROFIL`)
			 		VALUES ('$nom','$prenom','$civilite','$dateN','$email','$login','$mdp','V',
			 				'$idprofil')");
			$sql->execute();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch
	}//fin fonction



	/**
  * Creer un profil
  * @param $idprofil
  * @param $secteur
  * @param $statutVisiteur
  */
		function creerVisiteur($idprofil,$secteur) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("INSERT INTO `visiteur`(`MATRICULE`, `SEC_NUM`, `DELEGUE`)
								 VALUES ('$idprofil','$secteur','0')");
			$sql->execute();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch
	}//fin fonction
?>