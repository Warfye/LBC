<?php
/**
 * Liste des fonctions retournant les donnnées depuis la base de données vers le controleur 
 * c_carriere
 * @author Hugo GRELLIER
 * @package util
 */
/**
 * Retourne le recapitulatif de la carrière du visiteur
 * @param $matricule
 * @return tableau associatif
 */
function carriereVisiteur($matricule) {
	try {
		$cnx=connexionPDO();
		$sql=$cnx->prepare("SELECT NOMR, dateaffectation, NOMS FROM  travailler 
			INNER JOIN region ON region.REG_CODE = travailler.REG_CODE
			INNER JOIN secteur ON secteur.SEC_NUM = region.SEC_NUM
			where matricule = '$matricule'
			ORDER BY dateaffectation DESC");
		$sql->execute();
		$donnees = $sql->fetchAll();
	}
	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $donnees;
}?>