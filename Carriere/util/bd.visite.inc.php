<?php
/**
 * Liste des fonctions retournant les donnnées depuis la base de données vers le controleur
 * @author Corentin GOURICHON
 * @package util
 */


/**
 * Retourne l'ensemble des visiteurs
 * @param $numSecteur
 * return tableau associatif
 */
function getLesVisiteurs($numSecteur) {
	try {
	    $cnx = connexionPDO();
	    $req = $cnx->prepare("SELECT * FROM profil, visiteur where visiteur.MATRICULE = profil.IDPROFIL AND visiteur.SEC_NUM= $numSecteur AND profil.TYPEPROFIL != 'R'");
	    $req->execute();
	    $lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
	    print "Erreur !: " . $e->getMessage();
	    die();
	}
	return $lesLignes;
}
	

/**
 * Retourne l'ensemble des visites simples d'un secteur concerné.
 * @param $numSecteur
 * @return tableau associatif 
 */
function getLesVisitesSimplesParSecteur($numSecteur) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT visite.IDVISITE, visite.DATEVISITE, visite.COMMENTAIREDELEGUE, 
        	profil.IDPROFIL, profil.NOM, profil.PRENOM FROM visite 
        	INNER JOIN visiteur ON visite.MATRICULE = visiteur.MATRICULE
			INNER JOIN profil ON visiteur.MATRICULE = profil.NUMPROFIL WHERE visite.IDVISITE NOT IN (
			SELECT IDVISITE FROM evaluationvisite) 
			AND visite.sec_num = $numSecteur AND profil.TYPEPROFIL = 'V' ORDER BY visite.DATEVISITE DESC");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
}

/**
 * Retourne l'ensemble des visites simples d'une région concernée lorsque l'utilisateur est un delegué.
 * On récupère les visites ne concernant pas le delegué de la région concernée et qui ont été saisies par le responsable du secteur de la région concernée.
 * @param $numSecteur
 * @param $numRegion
 * @param $matricule 
 * @return tableau associatif 
 */
function getLesVisitesSimplesParRegionDelegue($numSecteur, $numRegion, $matricule) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT visite.IDVISITE, visite.DATEVISITE, DATEDIFF(CURDATE(), visite.DATEVISITE) as 'interval', visite.COMMENTAIREDELEGUE, profil.IDPROFIL, profil.NOM, profil.PRENOM FROM visite 
			INNER JOIN visiteur ON visite.MATRICULE = visiteur.MATRICULE 
			INNER JOIN profil ON visiteur.MATRICULE = profil.NUMPROFIL 
			INNER JOIN travailler ON visite.matricule = travailler.matricule 
			WHERE visite.IDVISITE NOT IN (SELECT IDVISITE FROM evaluationvisite) 
			AND travailler.reg_code = $numRegion AND visite.sec_num = $numSecteur AND profil.TYPEPROFIL = 'V'
			AND VISITE.MATRICULE != $matricule ORDER BY visite.DATEVISITE DESC");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
}

/**
 * Retourne l'ensemble des visites simples d'une région concernée lorsque l'utilisateur est un visiteur.
 * On récupère les visites de la région concernée et qui ont été saisies par le responsable du secteur de la région concernée.
 * @param $numSecteur
 * @param $numRegion
 * @param $matricule
 * @return $lesLignes
 */
function getLesVisitesSimplesParRegionVisiteur($numSecteur, $numRegion, $matricule) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT visite.IDVISITE, visite.DATEVISITE, DATEDIFF(CURDATE(), visite.DATEVISITE) as 'interval', visite.COMMENTAIREDELEGUE, profil.IDPROFIL, profil.NOM, profil.PRENOM FROM visite 
			INNER JOIN visiteur ON visite.MATRICULE = visiteur.MATRICULE 
			INNER JOIN profil ON visiteur.MATRICULE = profil.NUMPROFIL 
			INNER JOIN travailler ON visite.matricule = travailler.matricule 
			WHERE visite.IDVISITE NOT IN (SELECT IDVISITE FROM evaluationvisite) 
			AND travailler.reg_code = $numRegion AND visite.sec_num = $numSecteur AND profil.TYPEPROFIL = 'V'
			AND VISITE.MATRICULE = $matricule ORDER BY visite.DATEVISITE DESC");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
}

/**
 * Retourne l'ensemble des visites évaluées d'un secteur concerné.
 * @param $numSecteur
 * @return tableau associatif 
 */
function getLesVisitesEvalueesParSecteur($numSecteur) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT evaluationvisite.IDVISITE, visite.DATEVISITE, visite.COMMENTAIREDELEGUE, profil.IDPROFIL, profil.NOM, profil.PRENOM, COUNT(contient.idvisite) as 'nb' FROM evaluationvisite 
			LEFT JOIN contient ON evaluationvisite.idvisite = contient.idvisite 
			INNER JOIN visite ON evaluationvisite.idvisite = visite.idvisite 
			INNER JOIN visiteur ON visite.MATRICULE = visiteur.MATRICULE 
			INNER JOIN profil ON visiteur.MATRICULE = profil.NUMPROFIL 
			WHERE visite.sec_num = $numSecteur AND profil.TYPEPROFIL = 'V' GROUP BY evaluationvisite.IDVISITE 
			ORDER BY visite.DATEVISITE DESC");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
}

/**
 * Retourne l'ensemble des visites évaluées d'une région concernée lorsque l'utilisateur est un delegué.
 * On récupère les visites ne concernant pas le delegué de la région concernée et qui ont été saisies par le responsable du secteur de la région concernée.
 * @param $numSecteur
 * @param $numRegion
 * @param $matricule
 * @return tableau associatif 
 */
function getLesVisitesEvalueesParRegionDelegue($numSecteur, $numRegion, $matricule) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT evaluationvisite.IDVISITE, visite.DATEVISITE, DATEDIFF(CURDATE(), visite.DATEVISITE) as 
		    'interval', visite.COMMENTAIREDELEGUE, profil.IDPROFIL, profil.NOM, profil.PRENOM, 
		    COUNT(contient.idvisite) as 'nb' FROM evaluationvisite 
			LEFT JOIN contient ON evaluationvisite.idvisite = contient.idvisite 
			INNER JOIN visite ON evaluationvisite.idvisite = visite.idvisite 
			INNER JOIN visiteur ON visite.MATRICULE = visiteur.MATRICULE 
			INNER JOIN profil ON visiteur.MATRICULE = profil.NUMPROFIL 
			INNER JOIN travailler ON visiteur.matricule = travailler.matricule 
			WHERE travailler.reg_code = $numRegion AND visite.sec_num = $numSecteur AND profil.TYPEPROFIL = 'V' 
			AND VISITE.MATRICULE != $matricule GROUP BY evaluationvisite.IDVISITE ORDER BY visite.DATEVISITE DESC");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
}	

/**
 * Retourne l'ensemble des visites évaluées d'une région concernée lorsque l'utilisateur est un visiteur.
 * On récupère les visites de la région concernée et qui ont été saisies par le responsable du secteur de la région concernée.
 * @param $numSecteur
 * @param $numRegion
 * @param $matricule
 * @return tableau associatif 
 */
function getLesVisitesEvalueesParRegionVisiteur($numSecteur, $numRegion, $matricule) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT evaluationvisite.IDVISITE, visite.DATEVISITE, DATEDIFF(CURDATE(), visite.DATEVISITE) as 'interval', visite.COMMENTAIREDELEGUE, profil.IDPROFIL, profil.NOM, profil.PRENOM, 
		    COUNT(contient.idvisite) as 'nb' FROM evaluationvisite 
			LEFT JOIN contient ON evaluationvisite.idvisite = contient.idvisite 
			INNER JOIN visite ON evaluationvisite.idvisite = visite.idvisite 
			INNER JOIN visiteur ON visite.MATRICULE = visiteur.MATRICULE 
			INNER JOIN profil ON visiteur.MATRICULE = profil.NUMPROFIL 
			INNER JOIN travailler ON visiteur.matricule = travailler.matricule 
			WHERE travailler.reg_code = $numRegion AND visite.sec_num = $numSecteur AND profil.TYPEPROFIL = 'V' 
			AND VISITE.MATRICULE = $matricule GROUP BY evaluationvisite.IDVISITE 
			ORDER BY visite.DATEVISITE DESC");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
}	

/**
 * Enregistre une visite simple
 * @param $dateVisite
 * @param $idVisiteur
 * @param $idResponsable
 * @return bool|string 
 */
function setLaVisiteSimple($dateVisite, $idVisiteur, $idResponsable) {
	$resultat = false;
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO visite (DATEVISITE, MATRICULE, SEC_NUM) values(:dateVisite,:matricule, :sec_num)");
		$req->bindValue(':dateVisite', $dateVisite, PDO::PARAM_STR);
		$req->bindValue(':matricule', $idVisiteur, PDO::PARAM_STR);
		$req->bindValue(':sec_num', $idResponsable, PDO::PARAM_INT);
		$resultat = $req->execute();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $resultat;
}

/**
 * Retourne l'identifiant de la dernière visite simple saisie par le secteur.
 * @param $idResponsable
 * @return tableau associatif 
 */
function getIdDerniereVisite($idResponsable) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT MAX(IDVISITE) AS 'idVisite' FROM visite WHERE sec_num = $idResponsable");
        $req->execute();
		$laLigne = $req->fetch();
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $laLigne;
}

/**
 * Enregistre une visite évaluée
 * @param $idVisite
 * @return bool|string 
 */
function setLaVisiteEvaluee($idVisite) {
	$resultat = false;
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO evaluationvisite (IDVISITE) values(:idvisite)");
		$req->bindValue(':idvisite', $idVisite, PDO::PARAM_INT);
		$resultat = $req->execute();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $resultat;
}

/**
 * Retourne l'identifiant de la dernière visite évaluée saisie par le secteur.
 * @param $idResponsable
 * @return tableau associatif 
 */	
function getIdDerniereVisiteEvaluee($idResponsable) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT MAX(IDVISITE) AS 'idVisite' FROM visite WHERE sec_num = $idResponsable AND idvisite IN(SELECT IDVISITE FROM evaluationvisite)");
        $req->execute();
		$laLigne = $req->fetch();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $laLigne;
}

/**
 * Retourne les informations relatives à une visite
 * @param $idVisite
 * @return tableau associatif 
 */
function getLaVisite($idVisite) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT visite.DATEVISITE, visite.COMMENTAIREDELEGUE, visite.MATRICULE, profil.NOM, profil.PRENOM FROM visite, profil WHERE visite.MATRICULE = profil.IDPROFIL 
        	AND profil.TYPEPROFIL = 'V' AND visite.IDVISITE = $idVisite");
        $req->execute();
		$laLigne = $req->fetch();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $laLigne;
}


/**
 * Retourne les critères qui n'ont pas encore été notés lors d'une visite
 * @param $idVisite
 * @return tableau associatif 
 */
function getLesCriteres($idVisite) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM criteres WHERE criteres.libelle NOT IN(SELECT libelle FROM contient WHERE contient.idvisite = $idVisite)");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
} 

/**
 * Enregistre une critère noté lors d'une visite
 * @param $idVisite
 * @param $idCritere
 * @param note
 * @param  $bAAmeliorer
 * @return bool|string 
 */
function setLeCritere($idVisite, $idCritere, $note, $bAAmeliorer) {
	$resultat = false;
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO contient (IDVISITE, LIBELLE, NOTE, AAMELIORER) values(:idvisite, :libelle, :note, :aameliorer)");
		$req->bindValue(':idvisite', $idVisite, PDO::PARAM_INT);
		$req->bindValue(':libelle', $idCritere, PDO::PARAM_STR);
		$req->bindValue(':note', $note, PDO::PARAM_INT);
		$req->bindValue(':aameliorer', $bAAmeliorer, PDO::PARAM_BOOL);
		$resultat = $req->execute();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $resultat;
}

/**
 * Retourne les critères qui ont été notés lors d'une visite
 * @param $idVisite
 * @return tableau associatif 
 */
function getLesCriteresByVisite($idVisite) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM contient WHERE idvisite = $idVisite");
        $req->execute();
		$lesLignes = $req->fetchAll();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $lesLignes;
} 

/**
 * Retourne les informations complémentaires d'une visite évaluée
 * @param $idVisite
 * @return tableau associatif 
 */
function getLesInformationsVisiteEvaluee($idVisite) {
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT ROUND(AVG(note)) AS 'MOYENNE', COMMENTAIREDELEGUE FROM contient 
			INNER JOIN evaluationvisite ON contient.idvisite = evaluationvisite.idvisite
			INNER JOIN visite ON evaluationvisite.idvisite = visite.idvisite
			WHERE contient.idvisite = $idVisite");
        $req->execute();
		$laLigne = $req->fetch();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $laLigne;
} 

/**
 * Retourne les informations complémentaires d'une visite évaluée
 * @param $idVisite
 * @param $commentaire
 * @return tableau associatif 
 */
function setLeCommentaire($idVisite, $commentaire) {
	$resultat = false;
	try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE visite SET COMMENTAIREDELEGUE = :commentaire WHERE IDVISITE = :idvisite");
		$req->bindValue(':idvisite', $idVisite, PDO::PARAM_STR);
		$req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
		$resultat = $req->execute();    
	} 
	catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
	return $resultat;
}
?>