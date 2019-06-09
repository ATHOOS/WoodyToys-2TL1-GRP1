<?php require("functions.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Hello WT1 B2B</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="b2b.css" />
		<script language="Javascript"> 
			function bascule(elem) { 
			// Quand on clique sur un menu quelconque 
			// on ferme tout les menus
			document.getElementsByClassName("contenu").style.visibility="hidden";
			// On regarde l'état du menu sur lequel on a cliqué
			etat=document.getElementById(elem).style.visibility; 
			if(etat=="hidden"){
				// si le menu concerné est dissimulé, on le rend visible
				document.getElementById(elem).style.visibility="visible";
				} 
			else{
				// si le menu concerné est affiché, on le cache
				document.getElementById(elem).style.visibility="hidden";
				} 
			} 
		</script> 
	</head>
	<body>
		<h1> B2B </h1>
		<div>
			<button type="button" action="signin.php">Se connecter</button>
		</div>
		<ul id="menu_horizontal">
			<li class="menu" onClick="bascule('Presentation')">Qui sommes-nous ?</a></li>
			<li class="menu" onClick="bascule('Produits')">Nos Produits</a></li>
			<li class="menu" onClick="bascule('Inscription')">Inscription</a></li>
			<li class="menu" onClick="bascule('Contact')">Nous contacter</a></li>
		</ul>
		<div class="contenu" id="Presentation">
			<h2> Qui sommes-nous ?</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div class="contenu" id="Inscription">
			<h2>Inscription</h2>
			<form method="post" action="addClient.php">
				<p>
		  			ONSS:<br>
		  			<input type="text" name="Id" value="" required><br><br>    			
					Nom de la société :<br>
		  			<input type="text" name="name" value="" required><br><br>

					Adresse mail de contact:<br>
		  			<input type="text" name="mail" value="" required><br><br>

		  			Adresse du siège social:<br>
		  			<input type="text" name="address" value="" required><br><br>

					Mot de passe:<br>
					<input type="password" name="password" value="" required><br><br>

					Confirmer le mot de passe:<br>
					<input type="password" name="password2" value="" required><br><br>

					<input type="checkbox" name="news" id="news"/> <label for="news" value="news">Je veux être tenu aux courant des nouveautés</label>
		  			<input type="submit" value="valider">
				</p>
			</form>
		</div>
		<div class="contenu" id="Clients">
			<h2> Clients </h2>
			<?= getAllClients(); ?>
		</div>
	</body>
</html>
