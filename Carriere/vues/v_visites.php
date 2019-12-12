<?php
/**
* On affiche la liste des visites simples et évaluées. 
*Tous peuvent voir les visites. Le responsable peut ajouter  des visites simples et évaluées (en ajoutant des critères notés). Le délegué peut commenter la visite jusqu'à  1 mois après la visite et si cela ne le concerne pas.
* @author Corentin GOURICHON
* @package vues
*/?>
<div id="container">
	<ul class="section">
		<?php
		if ($_SESSION['role'] == 'R') {?>
			<h1>VISITES RENDUES SUR LE SECTEUR</h1>
		<?php
		}
		else if ($_SESSION['role'] == 'D') {?>
			<h1>VISITES RENDUES SUR LA REGION</h1>
		<?php
		}?>
		
		<?php
		if ($_SESSION['role']=='R') {?>
			<br/>
			<a href="index.php?uc=visite&action=ajouterVisiteSimple" role="button"  class="btn btnHaut bg-orange texte-blanc">
				<i class='fa fa-plus'></i>&#10;Ajouter une visite simple
			</a>
			<a href="index.php?uc=visite&action=ajouterVisiteEvaluee" role="button"  class="btn btnHaut bg-orange texte-blanc">
				<i class='fa fa-plus'></i>&#10;Ajouter une visite évaluée
			</a>
			<br/>
			<br/>		
			<br/>	
		<?php
		}

		if ($_SESSION['role'] != 'V') {?>	
			<h3>VISITES SIMPLES</h3>
			<table class="tablePrincipal ">
				<tr>
					<th>Date</th>
					<th>Visiteur</th>
					<th>Actions</th>
				</tr>
				<?php 
				if (empty($lesVisitesSimples)) {?>
					<tr><td colspan="3">Aucune visite n'a été effectuée par le responsable</td></tr>
				<?php	 
				}
				foreach ($lesVisitesSimples as $uneVisite) {?>
					<tr>
						<td><?php echo date("d/m/Y", strtotime($uneVisite['DATEVISITE']));?></td>
						<td><?php echo $uneVisite['PRENOM'] . " ". $uneVisite['NOM'];?></td>
						<td>
							<?php
							if (($_SESSION['role']=='D') && ($_SESSION['matricule'] != $uneVisite['IDPROFIL']) &&
								($uneVisite['interval']<=31)) {
								if (empty($uneVisite['COMMENTAIREDELEGUE'])) {?>
									<a href="index.php?uc=visite&action=ajouterCommentaire&&idVisite=<?php echo $uneVisite['IDVISITE'];?>" role="button"  class="btn btnTableau bg-orange texte-blanc">
										<i class='fa fa-plus'></i>&#10;Ajouter un commentaire
									</a>
								<?php
								}
							}?>
							<a href="index.php?uc=visite&action=voirFicheVisiteSimple&idVisite=<?php echo $uneVisite['IDVISITE'];?>" role="button"  class="btn btnTableau bg-orange texte-blanc">
								<i class='fa fa-eye'></i>&#10;Voir la fiche
							</a>
						</td>
					</tr>
					<?php
				}?>
			</table>		
			<br/>
			<h3>VISITES ÉVALUÉES</h3>
			<table class="tablePrincipal">
				<tr>
					<th>Date</th>
					<th>Visiteur</th>
					<th>Actions</th>
				</tr>
				<?php 
				if (empty($lesVisitesEvaluees)) {?>
					<tr><td colspan="3">Aucune visite n'a été effectuée par le responsable</td></tr>
				<?php	 
				}
				foreach ($lesVisitesEvaluees as $uneVisite) {?>
					<tr>
						<td><?php echo date("d/m/Y", strtotime($uneVisite['DATEVISITE']));?></td>
						<td><?php echo $uneVisite['PRENOM'] . " ". $uneVisite['NOM'];?></td>
						<td>
							<?php
							if ($_SESSION['role'] == 'R') {?>
								<a href="index.php?uc=visite&action=ajouterCritere&idVisite=<?php echo 
									$uneVisite['IDVISITE'];?>" role="button"  class="btn btnTableau bg-orange texte-blanc">
									<i class='fa fa-plus'></i>&#10;Ajouter un critère
								</a>
							<?php
							}
							else if ($_SESSION['role'] == 'D' && $_SESSION['matricule'] != $uneVisite['IDPROFIL'] &&
									$uneVisite['interval']<=31) {
								if (!isset($uneVisite['COMMENTAIREDELEGUE'])) {?>
									<a href="index.php?uc=visite&action=ajouterCommentaire&idVisite=<?php echo 
										$uneVisite['IDVISITE'];?>" role="button"  class="btn btnTableau bg-orange texte-blanc">
										<i class='fa fa-plus'></i>
										&#10;Ajouter un commentaire
									</a>
								<?php
								}
							}?>
							<a href="index.php?uc=visite&action=voirFicheVisiteEvaluee&idVisite=<?php echo 
								$uneVisite['IDVISITE']?>" role="button" class="btn btnTableau bg-orange texte-blanc">
								<i class='fa fa-eye'></i>&#10;Voir la fiche
							</a>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
		<?php 
		}
		if ($_SESSION['role'] != 'R') {
			if ($_SESSION['role'] == 'D') {?>
				<br>
			<?php
			}?>
			<h1>MES VISITES EFFECTUÉES AVEC LE RESPONSABLE</h1>
			<h3>VISITES SIMPLES</h3>
			<table class="tablePrincipal">
				<tr>
					<th>Date</th>
					<th>Actions</th>
				</tr>
				<?php 
				if (empty($lesVisitesSimplesV)) {?>
					<tr><td colspan="2">Aucune visite n'a été effectuée par le responsable</td></tr>
				<?php	 
				}	
				foreach ($lesVisitesSimplesV as $uneVisite) {?>
					<tr>
						<td><?php echo date("d/m/Y", strtotime($uneVisite['DATEVISITE']));?></td>
						<td>
							<a href="index.php?uc=visite&action=voirFicheVisiteSimple&idVisite=<?php echo 
								$uneVisite['IDVISITE'];?>" role="button"  class="btn btnTableau bg-orange texte-blanc">
								<i class='fa fa-eye'></i>&#10;Voir la fiche
							</a>
						</td>
					</tr>
					<?php
				}?>
			</table>		
			<br/>
			<h3>VISITES ÉVALUÉES</h3>
			<table class="tablePrincipal">
				<tr>
					<th>Date</th>
					<th>Actions</th>
				</tr>
				<?php 
				if (empty($lesVisitesEvalueesV)) {?>
					<tr><td colspan="3">Aucune visite n'a été effectuée par le responsable</td></tr>
				<?php	 
				}	
				foreach ($lesVisitesEvalueesV as $uneVisite) {?>
					<tr>
						<td><?php echo date("d/m/Y", strtotime($uneVisite['DATEVISITE']));?></td>
						<td>
							<a href="index.php?uc=visite&action=voirFicheVisiteEvaluee&idVisite=<?php echo 
								$uneVisite['IDVISITE'];?>" role="button"  class="btn btnTableau bg-orange texte-blanc">
								<i class='fa fa-eye'></i>&#10;Voir la fiche
							</a>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
		<?php
		}?>	
	</ul>
</div>


