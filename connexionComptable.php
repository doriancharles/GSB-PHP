<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<body style="background-color:#606060;">
		<div id="container">
			<form action="verificationComptable.php" method="POST">
				<h1>Connexion</h1>
				<label>
					<b>Nom d'utilisateur</b>
				</label>
				<input type="text" placeholder="Entrer le nom d'utilisateur" name="username">
				<label>
					<b>Mot de passe</b>
				</label>
				<input type="password" placeholder="Entrer le mot de passe" name="password">
				<input type="submit" id='submit' value='Se connecter' >
				<?php
					if(isset($_GET['erreur'])){
						$erreur = $_GET['erreur'];
						if($erreur==1){
							echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
						}
						if($erreur==2){
							echo "<p style='color:red'>Veuillez entrer votre nom d'utilisateur</p>";
						}
						if($erreur==3){
							echo "<p style='color:red'>Veuillez entrer votre mot de passe</p>";
						}
						if($erreur==4){
							echo "<p style='color:red'>Veuillez entrer votre nom d'utilisateur ainsi que votre mot de passe</p>";
						}
					}
				?>
			</form>
		</div>
	</body>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/accueil.php';">Revenir à l'accueil principal</button>
	</ul>
</html>
