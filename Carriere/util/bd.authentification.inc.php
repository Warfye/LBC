<?php
/**
 * Liste des fonctions retournant les donnnées depuis la base de données vers le controleur 
 * c_connexion
 * @author Arthur CHAIGNE
 * @package util
 */

/**
 * Recupérer les informations du profil du visiteur
 * @param $pseudo
 * @param $mdp
 * @return tableau associatif
 */
function getInformationsConnexion($pseudo, $mdp) {
	try {
	    $cnx = connexionPDO();
	     $req = $cnx->prepare("SELECT * FROM profil INNER JOIN visiteur ON profil.idprofil=visiteur.matricule
								  WHERE login = '$pseudo' AND password = '$mdp'");
	    $req->execute();
	    $laLigne = $req ->fetch();    
	} catch (PDOException $e) {
	    print "Erreur !: " . $e->getMessage();
	    die();
	}
	return $laLigne;
}
?>