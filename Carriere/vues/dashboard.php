<link href="util/dashboard.css" rel="stylesheet" type="text/css">
<div id="accueil">
	<a href="index.php?uc=visite">
		<span id="bloc1VISITES" class="dashboard">
			Visites
		</span>
	</a>

	<a href="index.php?uc=entretien">
		<span id="bloc2ENTRETIEN" class="dashboard">
			Évaluations
		</span>
	</a>

	<br>

	<?php
		if ($_SESSION['role']=="D") 
		{?>
			<a href="index.php?uc=statistiques">
				<span id="bloc5DELEGUE" class="dashboard">
					Statistiques
				</span>
			</a>

		<?php
		}
		else if($_SESSION['role']=="R") 
		{?>

			<a href="index.php?uc=statistiques">
				<span id="bloc5RESPONSABLE" class="dashboard">
				Statistiques
				</span>
			</a>
		<?php
		}
		
		if ($_SESSION['role']=="V") 
		{?>
			<a href="index.php?uc=profil">
				<span id="bloc4VISITEUR" class="dashboard">
					Profil
				</span>
			</a>
		<?php
		}
		else if($_SESSION['role']=="D") 
		{
		?>
			<a href="index.php?uc=profil">
				<span id="bloc4PASVISITEUR" class="dashboard">
					Profil
				</span>
			</a>
		<?php
		}
	?>

	<br>
	<?php
		if($_SESSION['role']=="R")
		{?>

			<a href="index.php?uc=personnel">
				<span id="bloc3" class="dashboard">
					Personnel
				</span>
			</a>	
		<?php
		}
		else
		{?>
			<a href="index.php?uc=carriere">
				<span id="bloc3" class="dashboard">
					Carrière
				</span>
			</a>
		<?php
		}
	?>


	<a href="index.php?uc=deconnexion">
		<span id="bloc6DECONNEXION" class="dashboard">
			Déconnexion
		</span>
	</a>
</div>