<div id="container">
	<ul class="section">
		<h1>AJOUTER UN VISITEUR</h1>
		<form name="frmCreerVisiteur" method="post" 
		action="index.php?uc=personnel&action=creervisiteurValider">
			<table>
				<tr class="invisible">
					<td><label class="texte-orange">Civilité :</td>

					<td>Homme <input type="radio" id="civiliteH" name="optcivilite" value="H" required>
						Femme <input type="radio" id="civiliteF" name="optcivilite" value="F">
					</td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Nom :</td>
					<td><input type="text" name="txtnom" required></td>

				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Prenom :</td>
					<td><input type="text" name="txtprenom" required></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Date de naissance </td>
					<td><input type="date" id="start" name="date" min="1950-01-01" required></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Email :</td>
					<td><input type="email" name="txtmail" required></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Login :</td>
					<td><input type="text" name="txtlogin" required></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Mot de passe :</td>
					<td><input type="password" name="txtmdp" required></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Secteur - Region :</td>
					<td>
						<select name="lstregion" required>
							<option selected value="">Selectionnez dans la liste</option>
							<?php 
							foreach ($secteur as $unSecteur) 
							{?>
								<option value="<?php echo $unSecteur['NOMR'];?>"><?php echo $unSecteur['NOMS'] . "-" . $unSecteur['NOMR'];?></option>
								<?php
							}?>
						</select> 
					</td>
				</tr>
			</table>
			<br/>

			<?php include("vues/v_boutonsFormulaire.html");?>

			<br/>
			<a role="button" href="index.php?uc=personnel" class="btn btnForm bg-bleu texte-blanc" name="btnretour">
				<i class="fa fa-arrow-left"></i>&#10; RETOUR
			</a>
		</form>
	</ul>
</div>