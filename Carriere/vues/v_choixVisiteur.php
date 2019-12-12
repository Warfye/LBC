<div id="container">
	<ul class="section formulaire">
		<form method="post" action="index.php?uc=entretien&action=ajoutEntretien" id="validation">
			<h1>AJOUTER UN ENTRETIEN</h1>
			<table>
				<tr class="invisible">
					<td><label class="texte-orange">Choisir un visiteur :</label></td>
					<td>
						<select name="matricule" required>
							<option selected value="">Selectionnez dans la liste</option>
							<?php 
							foreach ($visiteur as $unVisiteur) 
							{?>
								<option value="<?php echo $unVisiteur['IDPROFIL'];?>"><?php echo $unVisiteur['NOM'].' '.$unVisiteur['PRENOM']?></option>
							<?php
							}?>
						</select> 
					</td>
				</tr>
			</table>
			<br/>
			<?php include("vues/v_boutonsFormulaireMultiple.html");?>
			<br/>
			<a role="button" href="index.php?uc=entretien" class="btn btnForm bg-bleu texte-blanc"><i class="fa fa-arrow-left"></i>&#10; RETOUR</a>
		</form>
	</ul>
</div>