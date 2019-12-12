<?php
/**
* Le delegué peut laisser un petit commentaire.
* @author Corentin GOURICHON
* @package vues
*/
?>
<div id="container">
	<ul class="section">
		<h1>AJOUTER UN COMMENTAIRE</h1>
		<br/>
		<form action="index.php?uc=visite&action=confirmerAjoutCommentaire&idVisite=<?php echo $idVisite;?>" 
			  method="post" name="frmAjouterCommentaire">
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
					<td><label class="texte-orange">Commentaires : </label></td>
				</tr>
				<tr class="invisible">
					<td colspan="2"><textarea id="commentaire" name="txtCommentaire" rows="3" maxlength="32" autofocus>	</textarea></td>
				</tr>
			</table>
			<?php
			include("vues/v_boutonsFormulaire.html");
			?>
			<br/>
			<a role="button" href="index.php?uc=visite" class="btn btnForm bg-bleu texte-blanc" name="btRetour">
				<i class="fa fa-arrow-left"></i>&#10;RETOUR
			</a>
		</form>
	</ul>
</div>