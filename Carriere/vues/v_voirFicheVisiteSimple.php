<?php
/**
* On affiche la fiche concernant la visite. 
* Tous peuvent voir la voir. On retrouve le commentaire du délegué.
* @author Corentin GOURICHON
* @package vues
*/?>
<div id="container">
	<ul class="section">
		<h1>FICHE VISITE DU <?php echo $dateVisite;?></h1>
		<br/>
		<table>
			<?php 
			if ($_SESSION['role'] != "V") {?>
				<tr class="invisible">
					<td><label class="texte-orange">Visiteur concerné :</label></td>
					<td><input type="text" name="visiteur" value="<?php echo $nomComplet;?>" readonly/></td>
				</tr>
			<?php
			}?>
			<tr class="invisible">
				<td><label class="texte-orange">Commentaire :</label></td>
			</tr>
			<tr class="invisible">
				<td colspan="2">
					<?php 
					if (!empty($commentaire)) {?>
						<textarea id="commentaire" rows="2" readonly><?php echo $commentaire;?></textarea>
					<?php
					}
					else {?>
						Le délegué n'a pas encore saisi un commentaire.
					<?php
					}?>
				</td>
			</tr>							
		</table>
		<br/>
		<a role="button" href="index.php?uc=visite" class="btn btnForm bg-bleu texte-blanc" name="btRetour">
			<i class="fa fa-arrow-left"></i>&#10; RETOUR
		</a>
		<br/>
	</ul>
</div>