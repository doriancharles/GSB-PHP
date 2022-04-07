<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<body style="background-color:#606060;">
	<div id="content">
	<?php
		session_start();
		if($_SESSION['username'] !== ""){
			$user = $_SESSION['username'];
			$connection=mysqli_connect("localhost", "gsb", "azerty", "gsbFrais");
			$requete = "SELECT id , nom , prenom FROM Visiteur WHERE login = '$user'" ;
			$exec_requete = mysqli_query($connection,$requete);
			$reponse = mysqli_fetch_array($exec_requete);
			$idVisiteur = $reponse['id'];
			$nom = $reponse['nom'];
			$prenom = $reponse['prenom'];
			echo "Bonjour $nom $prenom, vous êtes connecté en tant que Visiteur" ;
		}
	?>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/saisieFrais.php';">Saisir un ou plusieurs frais pour le mois courant</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/consulter.php';">Consulter mes fiches de frais</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/connexionVisiteur.php';">Se déconnecter</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/accueil.php';">Revenir au menu principal</button>
	</ul>
	</body>
</html>


