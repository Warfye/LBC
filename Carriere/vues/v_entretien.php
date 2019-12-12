<div id="container">
	<ul class="section">
		<?php 
		if ($_SESSION['role']=="D") 
		{
		?>
		<h1>EVALUATIONS ANNUELLES DES VISITEURS DE LA REGION <?php echo $region ?></h1>
		<br/>
		<table>
			<tr>
				<th>Date</th>
				<th>Nom</th>
				<th>Prenom</th>					
				<th>Action</th>
			</tr>
			<?php 
			foreach ($entretienR as $unEntretienR)
			{
			?>
				<tr>
					<td>	
					<?php echo date("d/m/Y", strtotime($unEntretienR['DATET']));?>
					</td>
					<td>	
					<?php echo $unEntretienR['NOM']?>
					</td>
					<td>	
					<?php echo $unEntretienR['PRENOM']?>
					</td>
					<td>
						<a href="index.php?uc=entretien&action=detailEntretien&entretien=<?php echo $unEntretienR['NUMENTRETIEN']?>&matricule=<?php echo $unEntretienR['MATRICULE']?>" role="button" class="btn btnTableau bg-orange texte-blanc"><i class='fa fa-eye'></i>&#10;Voir l'entretien
					</td>	
				</tr>
			<?php 
			}
			?>
		</table>
		<?php 
		}
		if ($_SESSION['role']=="R") 
		{
		?>
		<h1>EVALUATIONS ANNUELLES DU SECTEUR <?php echo $secteur ?></h1>
		<a href="index.php?uc=entretien&action=creerentretienCXV" role="button"  class="btn btnHaut bg-orange texte-blanc">
			<i class='fa fa-plus'></i>
			&#10;Ajouter un entretien
		</a>
		<br/>
		<table>
			<tr>
				<th>Date</th>
				<th>Nom</th>
				<th>Prenom</th>	
				<th>Fonction</th>
				<th>Action</th>
			</tr>
			<?php 
			foreach ($entretienS as $unentretienS)
			{
			?>
				<tr>
					<td>
					<?php echo date("d/m/Y", strtotime($unentretienS['DATET']));?>
					</td>
					<td>
					<?php echo $unentretienS['NOM']?>
					</td>
					<td>
					<?php echo $unentretienS['PRENOM']?>
					</td>
					<td>
					<?php if($unentretienS['DELEGUE']=="1"){echo "Delegue";}else{echo "Visiteur";}?>
					</td>
					<td>
						<a href="index.php?uc=entretien&action=detailEntretien&entretien=<?php echo $unentretienS['NUMENTRETIEN']?>" role="button" class="btn btnTableau bg-orange texte-blanc"><i class='fa fa-eye'></i>&#10;Voir l'entretien
					</td>	
				</tr>
			<?php 
			}
			?>
		</table>
		<?php 
		}
		if ($_SESSION['role']=="V"||$_SESSION['role']=="D") 
		{
		?>
		<h1 id="titre">MES EVALUATIONS ANNUELLES</h1>
		<br/>

		<table>
			<tr>
				<th>Date</th>
				<th>Action</th>
			</tr>
			<?php 
			if(empty($entretien))
			{?>
				<tr><td colspan="2">Aucun entretien n'a été enregistré par le responsable.</td></tr>
			<?php
			}
			foreach ($entretien as $monentretien) {
			?>
				<tr>
					<td>	
					<?php echo date("d/m/Y", strtotime($monentretien['DATEENTRETIEN']));?>
					</td>
					<td>
						<a href="index.php?uc=entretien&action=detailEntretien&entretien=<?php echo $monentretien['NUMENTRETIEN']?>&matricule=<?php echo $monentretien['MATRICULE']?>" role="button" class="btn btnTableau bg-orange texte-blanc">	
							<i class='fa fa-eye'></i>&#10;Voir l'entretien
						</a>
					</td>	
				</tr>
			<?php 
			}
			?>
		</table>
		<?php
		}
		?>
	</ul>
</div>
