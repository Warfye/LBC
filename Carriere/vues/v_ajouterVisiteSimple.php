<?php
/**
* Le responsable ajoute une nouvelle visite qui ne sera pas évaluée.
* Il saisi la date de la visite et choisi le visiteur concerné.
* @author Corentin GOURICHON
* @package vues
*/
?>
<div id="container">
	<ul class="section">
		<h1>AJOUTER UNE VISITE SIMPLE</h1>
		<br/>
		<form action="index.php?uc=visite&action=confirmerAjoutVisiteSimple" method="post" name="frmAjouterVisiteSimple">
			<table>
				<tr class="invisible">
					<td><label class="texte-orange">Date de la visite : </label></td>
					<td><input type="date" name="txtDateVisite" required autofocus></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Visiteur : </label></td>
					<td>
						<select name="lstVisiteur" required>
							<option selected value="">Selectionnez dans la liste</option>
							<?php 
							foreach ($lesVisiteurs as $unVisiteur) {?>
								<option value="<?php echo $unVisiteur['IDPROFIL'];?>"><?php echo 
									$unVisiteur['PRENOM'] . " " . $unVisiteur['NOM'];?></option>
							<?php
							}?>
						</select> 
					</td>
				</tr>
				
			</table>
			<br/>
			<?php
			include("vues/v_boutonsFormulaire.html");
			?>
			<br/>
			<a role="button" href="index.php?uc=visite&action=voirVisites" class="btn btnForm bg-bleu texte-blanc" name="btRetour">
				<i class="fa fa-arrow-left"></i>&#10; RETOUR
			</a>
		</form>
	</ul>
</div>
