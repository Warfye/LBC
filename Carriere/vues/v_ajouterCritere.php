<?php
/**
* Le responsable note un critère.
* Il choisi un critère sur une visite concernant un visiteur, choisi s'il doit être amélioré et lui attribue une note.
* @author Corentin GOURICHON
* @package vues
*/
?>
<div id="container">
	<ul class="section">
		<h1>AJOUTER UN CRITÈRE</h1>
		<br/>
		<form action="index.php?uc=visite&action=confirmerAjoutCritere&idVisite=<?php echo $idVisite;?>" 
			method="post" name="frmAjouterCritere">
			<table>
				<tr class="invisible">
					<td><label class="texte-orange">Date de la visite :</label></td>
					<td><input type="date" name="txtDateVisite" value="<?php echo $laVisite['DATEVISITE'];?>" readonly></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Visiteur :</label></td>
					<td><input type="text" name="txtVisiteur" value="<?php echo $laVisite['PRENOM']. " ". 
							$laVisite['NOM'];?>" readonly/></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Critère :</label></td>
					<td>
						<select name="lstCritere" required autofocus>
							<option selected value="">Selectionnez dans la liste</option>
							<?php
							foreach ($lesCriteres as $critere)
							{?>
								<option value="<?php echo $critere['LIBELLE'];?>"><?php echo $critere['LIBELLE'];?>
								</option>
								<?php
							}?>
						</select>
					</td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">À améliorer :</label></td>
					<td>
						<input type="radio" name="optAmelioration" value="1" required class="bg-gris"/>Oui
						<input type="radio" name="optAmelioration" value="0" class="bg-gris"/>Non
					</td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Note attribuée :</label></td>
					<td><input type="number" name="txtNote" min="0" max="20" required>
			</table>
			<br/>
			<p>Vous pourrez ajouter d'autres critères d'évaluation.</p>
			<p>Pour cela, il faudra cliquer sur <label class="texte-vertPomme">Ajouter un critère d'évaluation
			</label>.</p>
			<br/>
			<?php
			include("vues/v_boutonsFormulaire.html");
			?>
			<br/>
			<a role="button" href="index.php?uc=visite" class="btn btnForm bg-bleu texte-blanc" name="btRetour">
				<i class="fa fa-arrow-left"></i>&#10; RETOUR
			</a>
		</form>
	</ul>
</div>