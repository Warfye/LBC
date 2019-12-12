<div class="user">

<?php 
	if ($_SESSION['role']!= 'R' ){
?>		
		<a class="metadata" href="index.php?uc=profil">
		<?php echo $_SESSION['prenom'];?> 
		<?php echo $_SESSION['nom'];?>
		<?php 
			if ($_SESSION['role']=='D'){
				echo "(Visiteur / Délegué)";	
			} else if ($_SESSION['role']=="V") {
				echo "(Visiteur)";
			}
		?>	
		</a>
		<a class="metadata" href="index.php?uc=deconnexion"> Déconnexion </a>	
	

	<?php
	 	} else if ($_SESSION['role']=="R") {
	?>
			<a class="metadata">
			<?php echo $_SESSION['prenom'];?> 
			<?php echo $_SESSION['nom'];?>
			<?php 
				echo "(Responsable)";
			?>	
			</a>
			<a class="metadata" href="index.php?uc=deconnexion"> Déconnexion </a>
	<?php } ?>

</div>
