<div name="haut" style="margin: 2 2 2 2; height: 6%;">
	<h1>
		<a href="index.php"><img src="images/logo.jpg" width="100" height="60" /></a>Gestion
		des visites
	</h1>
</div>
<div name="gauche"
	style="float: left; width: 18%; background-color: white; height: 100%;">
	<h2>Outils</h2>
	<ul>
		<li>Comptes-Rendus</li>
		<ul>
			<li><a href="index.php?uc=consulter&action=formRap">Nouveaux</a></li>
			<li>Consulter</li>
		</ul> 
		<li>Consulter</li>
		<ul>
			<li><a href="index.php?uc=consulter&action=medicament">Médicaments</a></li>
			<li><a href="index.php?uc=consulter&action=formPrac">Praticiens</a></li>
			<li><a href="index.php?uc=consulter&action=formVis">Rapport de visite</a></li>
		</ul>		
		<li>Saisir</li>
		<ul>
			<li><a href="index.php?uc=consulter&action=formMed">Médicaments</a></li>
		</ul>
		<li>Connexion</li>
		<ul><?php  
		if(isset($_SESSION['login'])){?>
			<li><a href="index.php?uc=connexion&action=deconnexion">Déconnexion</a></li>
			<?php }else{?>
			<li><a href="index.php?uc=connexion&action=demandeconnexion">Connexion</a></li>
			<?php }?>
		</ul>
	</ul>
</div>
