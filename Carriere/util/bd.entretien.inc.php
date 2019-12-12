<?php
/**
 * Liste des fonctions retournant les donnnées depuis la base de données vers le controleur 
 * c_entretien
 * @author Hugo GRELLIER
 * @package util
 */

/**
 * Retourne le nom de la region du délégué
 * @param $region
 * @return tableau associatif
 */
function recuperernomRegion($region) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT NOMR FROM region WHERE region.REG_CODE = '$region'");
		$sql->execute();
		$donnees = $sql->fetch();	
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $donnees;
}


/**
 * Retourne tous les entretiens de la region du delegue
 * @param $region
 * @param $matricule
 * @return tableau associatif
 */
	function voirMesEntretienRegion($region,$matricule) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT profil.NOM as 'NOM', profil.PRENOM as 'PRENOM', 
			entretien.DATEENTRETIEN as 'DATET', entretien.NUMENTRETIEN AS 'NUMENTRETIEN', 
			entretien.MATRICULE FROM  entretien
			INNER JOIN VISITEUR on VISITEUR.MATRICULE = entretien.MATRICULE
			INNER JOIN SECTEUR ON SECTEUR.SEC_NUM = VISITEUR.SEC_NUM
			INNER JOIN REGION ON REGION.SEC_NUM = SECTEUR.SEC_NUM
			INNER JOIN PROFIL ON PROFIL.idProfil = visiteur.MATRICULE
			WHERE REGION.REG_CODE = '$region' AND profil.TYPEPROFIL = 'V' AND visiteur.MATRICULE != '$matricule'
			ORDER BY DATET DESC");
		$sql->execute();
		$donnees = $sql->fetchAll();	
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $donnees;
}


/**
 * Retourne tous les entretiens du visiteur
 * @param $matricule
 * @return tableau associatif
 */
function voirMesEntretienVisiteur($matricule) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT * FROM  entretien where MATRICULE = '$matricule'");
		$sql->execute();
		$donnees = $sql->fetchAll();
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $donnees;
}

/**
 * Retourne le nom du secteur à partir de son id
 * @param $secteur
 * @return tableau associatif
 */
function trouvernomSecteur($secteur) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT NOMS FROM secteur WHERE SEC_NUM = '$secteur'");
		$sql->execute();
		$donnees = $sql->fetch();	
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $donnees;
}

/**
 * Retourne les entretiens du secteur du responsable
 * @param $numSecteur
 * @return tableau associatif
 */
function voirMesEntretienSecteur($numSecteur) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT profil.NOM as 'NOM', profil.PRENOM as 'PRENOM', 
			entretien.DATEENTRETIEN as 'DATET', entretien.NUMENTRETIEN AS 'NUMENTRETIEN',
			visiteur.DELEGUE AS 'DELEGUE', entretien.MATRICULE  FROM  entretien
			INNER JOIN VISITEUR on VISITEUR.MATRICULE = entretien.MATRICULE
			INNER JOIN SECTEUR ON SECTEUR.SEC_NUM = VISITEUR.SEC_NUM
			INNER JOIN PROFIL ON PROFIL.idProfil = ENTRETIEN.MATRICULE
			WHERE visiteur.SEC_NUM = '$numSecteur' AND profil.TYPEPROFIL = 'V' 
			ORDER BY DATET DESC");
		$sql->execute();
		$donnees = $sql->fetchAll();	
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $donnees;
}


/**
 * Retourne le detail de l'entretirn choisi
 * @param $entretien
 * @return tableau associatif
 */
function detailEntretien($entretien) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT MAX(entretien.DATEENTRETIEN) as 'dateE', entretien.OBJECTIFFIXE,
			entretien.COMMENTAIRESALAIRE, entretien.OBJECTIFATTEINT, entretien.OBJECTIFNV FROM entretien 
			WHERE entretien.NUMENTRETIEN = '$entretien'
			GROUP BY entretien.MATRICULE");
		$sql->execute();
		$donnees = $sql->fetch();
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $donnees;
}

/**
 * Retourne le tableau des critères à ameliorer
 * @param $matricule
 * @param $date
 * @return tableau associatif
 */
function critereAmeliorer($matricule,$date) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT contient.LIBELLE as 'LIBELLE', contient.NOTE as 'NOTE' FROM `contient` 
			INNER JOIN evaluationvisite ON evaluationvisite.IDVISITE = contient.IDVISITE 
			INNER JOIN visite on visite.IDVISITE = evaluationvisite.IDVISITE
			INNER JOIN visiteur on visiteur.MATRICULE = visite.MATRICULE 
			WHERE contient.AAMELIORER = 1 AND visiteur.MATRICULE = '$matricule' 
			AND YEAR(visite.DATEVISITE) = '$date'");
		$sql->execute();
		$donnees = $sql->fetchAll();
			
	}

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    } 

    return $donnees;
	}

/**
 * Retourne le dernière entretien du visiteur
 * @param $matricule
 * @return tableau associatif
 */
function entretienMax($matricule) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT MAX(DATEENTRETIEN) as 'DATEENTRETIEN' FROM ENTRETIEN
			where MATRICULE='$matricule'");
		$sql->execute();
		$donnees = $sql->fetch();		
	} 

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    } 

    return $donnees;
} 

/**
 * Retourne l'objectif fixé de l'entretien d'avant
 * @param $matricule
 * @param $date
 * @return tableau associatif
 */
function entretienAvant($matricule,$date) {
	try {
		$cnx = connexionPDO();
		$sql = $cnx->prepare("SELECT * FROM ENTRETIEN where MATRICULE = '$matricule' AND DATEENTRETIEN = '$date'");
		$sql->execute();
		$donnees = $sql->fetch();	
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    } 

    return $donnees;
} 

/**
 * Fonction d'ajout d'entretien à un visiteur
 * @param $matricule
 * @param $objF
 * @param $objA
 * @param $objN
 * @param $prime
 * @param $date
 */
function ajoutEntretien($matricule, $objF, $objA, $objN, $prime, $date) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO ENTRETIEN (MATRICULE, OBJECTIFFIXE, COMMENTAIRESALAIRE, DATEENTRETIEN, OBJECTIFATTEINT, OBJECTIFNV) VALUES(:matricule, :objF, :prime, :dateE, :objA, :objN)");
		$req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
		$req->bindValue(':objF', $objF, PDO::PARAM_STR);
		$req->bindValue(':prime', $prime, PDO::PARAM_STR);
		$req->bindValue(':dateE', $date, PDO::PARAM_STR);
		$req->bindValue(':objA', $objA, PDO::PARAM_STR);
		$req->bindValue(':objN', $objN, PDO::PARAM_STR);
		$req->execute();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
} 
?>