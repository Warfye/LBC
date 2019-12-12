<div id="container">
	<ul class="section">
		<h1>PERSONNEL DU SECTEUR</h1>
		<br/>
		<a href="index.php?uc=personnel&action=creervisiteur" role="button"  class="btn btnHaut bg-orange texte-blanc">
			<i class='fa fa-plus'></i>
			&#10;Ajouter un visiteur
		</a>
		<br/>
		<br/>		
		<br/>		
		<h3>DÉLEGUÉS</h3>
		<br>
		<table class="tablePrincipal">
			<tr>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Région</th>
				<th>Affectation</th>
				<th></th>
			</tr>
			<?php 
			foreach($lesDelegues as $unDelegue)
			{?>
				<tr>
					<td><?php echo $unDelegue['NOM'];?></td>
					<td><?php echo $unDelegue['PRENOM']?></td>
					<td><?php echo $unDelegue['NOMR'];?></td>
					<td><?php echo date("d/m/Y", strtotime($unDelegue['DATEAFFECTATION']));?></td>
					<td>
						<a href="index.php?uc=personnel&action=modifierSecteur&matricule=<?php echo $unDelegue['idprofil']?>" role="button" class="btn btnTableau bg-orange texte-blanc">
							<i class='fa fa-pencil'></i>
							&#10;Modifier le secteur
						</a>
						<a href="index.php?uc=personnel&action=modifierRegion&matricule=<?php echo $unDelegue['idprofil']?>&secteur=<?php echo $unDelegue['SEC_NUM']?>" role="button" class="btn btnTableau bg-orange texte-blanc">
							<i class='fa fa-pencil'></i>
							&#10;Modifier la region
						</a>
					</td>
				</tr>
			<?php
			}?>
		</table>
		<br/>
		<h3>VISITEURS</h3>
		<br>
		<table class="tablePrincipal">
			<tr>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Région</th>
				<th>Affectation</th>
				<th></th>
			</tr>
			<?php 
			foreach($lesVisiteurs as $unVisiteur)
			{
				?>
				<tr>
					<td><?php echo $unVisiteur['NOM'];?></td>
					<td><?php echo $unVisiteur['PRENOM']?></td>
					<td><?php echo $unVisiteur['REG_CODE'];?></td>
					<td><?php echo date("d/m/Y", strtotime($unVisiteur['DATEAFFECTATION']));?></td>
					<td>
						<a href="index.php?uc=personnel&action=modifierSecteur&matricule=<?php echo $unVisiteur['idprofil']?>" role="button" class="btn btnTableau bg-orange texte-blanc">
							<i class='fa fa-pencil'></i>
							&#10;Modifier le secteur
						</a>
						<a href="index.php?uc=personnel&action=modifierRegion&matricule=<?php echo $unVisiteur['idprofil']?>&secteur=<?php echo $unVisiteur['SEC_NUM']?>" role="button" class="btn btnTableau bg-orange texte-blanc">
							<i class='fa fa-pencil'></i>
							&#10;Modifier la region
						</a>
					</td>
				</tr>
			<?php
			}?>
		</table>
	</ul>
</div>


