<?php
if (empty($_REQUEST['action'])) {
	$action = "";
}
else {
	$action = $_REQUEST['action'];
}


include("vues/v_menu.php");

switch ($action) {

	default:
	    			
		date_default_timezone_set('UTC');
		$historique = carriereVisiteur($_SESSION['matricule']);

		include("vues/v_carriere.php");
		break;
}?>