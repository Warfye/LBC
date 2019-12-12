<?php
/**
 * Liste des fonctions retournant les donnnées depuis la base de données vers le controleur 
 * c_profil
 * @author Hugo GRELLIER
 * @package util
 */

/**
 * Recupérer les informations du profil du visiteur
 * @param $matricule
 * @return tableau associatif
 */
function informationProfil($matricule) {
	try {
		$cnx=connexionPDO();
		$sql=$cnx->prepare("SELECT * FROM  profil where idprofil = '$matricule'");
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
 * Recupérer les informations du profil du visiteur
 * @param $matricule
 * @return tableau associatif
 */
	function modifierProfil($nom, $prenom, $civilite, $dateN, $mail, $matricule) {
	try {

			$cnx=connexionPDO();
	
			$sql=$cnx->prepare("UPDATE `profil` SET `NOM` = '$nom', `PRENOM` = '$prenom',
								`CIVILITE` = '$civilite', `DATENAISSANCE` = '$dateN', EMAIL = '$mail' 
								WHERE IDPROFIL = '$matricule'");
			$sql->execute();
			
	}//fin try

	catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }//fin catch

	}//fin fonction

?>