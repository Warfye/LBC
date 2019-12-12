<div id="container">
	<ul class="section">
		<h1>AJOUT ENTRETIEN AU VISITEUR N°<?php echo $matricule;?></h1>
		<br/>
		<form action="index.php?uc=entretien&action=confAjout&matricule=<?php echo $matricule ?>" method="post">
			<table>
				<tr class="invisible">
					<td><label class="texte-orange">Date de l'entretien :</label></td>
					<td><input type="Date" name="date" required><td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Objectif fixé à l'entretien précédant :</label></td>
					<td><input type="" name="objF" value="<?php echo $obj; ?>" readonly></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Objectif atteint :</label></td>
					<td><input type="text" name="objA" required></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Nouvel objectif fixé :</label></td>
					<td><input type="text" name="objN" required></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Augmentation / prime :</label></td>
					<td><input type="text" name="prime" required></td>
				</tr>
			</table>
			<br/>
			<?php
			include("vues/v_boutonsFormulaireMultiple.html");
			?>
		</form>
		<a role="button" href="index.php?uc=entretien" class="btn btnForm bg-bleu texte-blanc">
			<i class="fa fa-arrow-left"></i>&#10; RETOUR
		</a>
	</ul>
</div>