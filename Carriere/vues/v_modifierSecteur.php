<div id="container">
	<ul class="section">
		<?php
			$matricule=$_REQUEST['matricule'];
		?>
		<h1>MODIFIER LE SECTEUR DU VISITEUR</h1>
		<br>
		<form method="post" name="frmmodifierScteur" 
				action="index.php?uc=personnel&action=modifierSecteurValider
				&matricule=<?php echo $matricule ?>">
			<table>
				<tr class="invisible">
					<td><label class="texte-orange">Nouveau secteur :</label></td>
					<td>
						<select name="lstregion">
							<option selected value="">Selectionnez dans la liste</option>
							<?php 
							foreach ($region as $uneRegion) 
							{ ?>
								<option value="<?php echo $uneRegion['NOMR'];?>">
									<?php echo $uneRegion['NOMS'] . " : " . $uneRegion['NOMR']?></option>
							<?php } ?>
						</select> 
					</td>
				</tr>
			</table>
			<br>
			<?php
			include("vues/v_boutonsFormulaire.html");
			?>
			<br>

			<a role="button" href="index.php?uc=personnel" class="btn btnForm bg-bleu texte-blanc">
			<i class="fa fa-arrow-left"></i>&#10; RETOUR
			</a>

		</form>
	</ul>
</div>