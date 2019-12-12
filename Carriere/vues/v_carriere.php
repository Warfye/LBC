<div id="container">
	<ul class="section">
		<h1>MON RECAPITULATIF DE CARRIERE</h1>
		<br>
		<table class="tablePrincipal">
			<tr>
				<th>Affectation</th>
				<th>Region</th>
				<th>Secteur</th>
			</tr>
			<?php 
			foreach ($historique as $monhistorique) 
			{?>
				<tr>		
					<td><?php echo date("d/m/Y", strtotime($monhistorique['dateaffectation']));?></td>
					<td><?php echo $monhistorique['NOMR']?></td>
					<td><?php echo $monhistorique['NOMS']?></td>
				</tr>
			<?php 
			}?>
		</table>
		<br/>
		<a role="button" href="index.php?uc=accueil" class="btn btnForm bg-bleu texte-blanc"><i class="fa fa-arrow-left"></i>&#10; RETOUR</a>		
	</ul>
</div>