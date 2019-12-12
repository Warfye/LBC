<!--  Menu haut-->
<ul id="menu">	
	<?php
	if($_SESSION['role'] == "R")
	{?>
		<li><a href="index.php?uc=statistiques">Statistiques</a></li>
		<li><a href="index.php?uc=visite">Visites</a></li>
		<li><a href="index.php?uc=entretien">Évaluations annuelles</a></li>
		<li><a href="index.php?uc=personnel">Personnel</a></li>
	<?php
	}
	else if ($_SESSION['role'] == "D")
	{?>
		<li><a href="index.php?uc=statistiques">Statistiques</a></li>
		<li><a href="index.php?uc=visite">Visites</a></li>
		<li><a href="index.php?uc=entretien">Évaluations annuelles</a></li>
		<li><a href="index.php?uc=carriere">Carrière</a></li>
	<?php
	}
	else
	{?>
		<li><a href="index.php?uc=visite">Visites</a></li>
		<li><a href="index.php?uc=entretien">Évaluations annuelles</a></li>
		<li><a href="index.php?uc=carriere">Carrière</a></li>
	<?php
	}?>
</ul>
