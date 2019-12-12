<div id="container">
	<ul class="section formulaire">
		<h1 id="titre">ENTRETIEN DU <?php echo date("d/m/Y", strtotime($entretienDate));?></h1>
		<br/>
		<table>
			<tr class="invisible">
				<td><label class="texte-orange">Objectif fixé :</label></td>
				<td><?php echo $objF; ?></td>
			</tr>
			<tr class="invisible">
				<td><label class="texte-orange">Objectif atteint :</label></td>
				<td><?php echo $objA; ?></td>
			</tr>
			<tr class="invisible">
				<td><label class="texte-orange">Nouvel objectif fixé :</label></td>
				<td><?php echo $objN; ?></td>
			</tr>
			<tr class="invisible">
				<td><label class="texte-orange">Augmentation / prime :</label></td>
				<td><?php echo $commentaire?></td>
			</tr>
			<tr class="invisible">
				<td><label class="texte-orange">Critères à améliorer :</label></td>
			</tr>
		</table>
		<br>
		<table>
			<tr>
				<th>Critère</th>
				<th>Note</th>
			</tr>
			<?php foreach($critere as $uncritere)
			{ ?>
				<tr>
					<td><?php echo $uncritere['LIBELLE'] ?></td>
					<td><?php echo $uncritere['NOTE'] ?></td>
				</tr>
			<?php } ?>
		</table>
		<br/>
		<a role="button" href="index.php?uc=entretien" class="btn btnForm bg-bleu texte-blanc"><i class="fa fa-arrow-left"></i>&#10; RETOUR</a>
		<br/>
	</ul>
</div>