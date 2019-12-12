<div id="container">
	<ul class="section">
		<h1>MODIFIER MES INFORMATIONS</h1>
		<form method="post" action="index.php?uc=profil&action=modifierProfil" id="validation">
			<table>
				<tr class="invisible">
					<td><label class="texte-orange">Civilité :</label></td>
					<td><input type="radio" id="civiliteH" name="civilite" value="H" class="bg-gris" 
						<?php if($info['CIVILITE']=="H")
						{?>
							checked
						<?php 
						}
						?>/>Homme
						<input type="radio" id="civiliteF" name="civilite" value="F" class="bg-gris"
						<?php if($info['CIVILITE']=="F")
						{?>
							checked
						<?php 
						}
						?>/>Femme
					</td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Nom :</label></td>
					<td><input type="text" name="nom" value="<?php echo $info['NOM'];?>"></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Prenom :</label></td>
					<td><input type="text" name="prenom" value="<?php echo $info['PRENOM'];?>"></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Date de naissance :</label></td>
					<td>
						<input type="date" name="date" min="1950-01-01" value="<?php echo $info['DATENAISSANCE'];?>">
					</td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Email :</label></td>
					<td><input type="email" name="mail" value="<?php echo $info['EMAIL'];?>"></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Login :</label></td>
					<td><input type="text" name="login" value="<?php echo $info['LOGIN'];?>"readonly></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Mot de passe :</label></td>
					<td><input type="password" name="mdp" value="<?php echo $info['PASSWORD'];?>"readonly></td>
				</tr>
				<tr class="invisible">
					<td><label class="texte-orange">Statut :</label></td>
					<td><input type="text" name="typeProfil" value="<?php echo $TYPEPROFIL;?>"readonly></td>
				</tr>
			</table>
			<br>
			<?php 
			include("vues/v_boutonsFormulaire.html");
			?>
			<br>
			<a role="button" href="index.php?uc=accueil" class="btn btnForm bg-bleu texte-blanc">
				<i class="fa fa-arrow-left"></i>&#10; RETOUR
			</a>
		</form>
	</ul>
</div>