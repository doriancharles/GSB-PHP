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
			$requete = "SELECT nom , prenom FROM Comptable WHERE login = '$user'" ;
			$exec_requete = mysqli_query($connection,$requete);
			$reponse = mysqli_fetch_array($exec_requete);
			$nom = $reponse['nom'];
			$prenom = $reponse['prenom'];
			echo "Bonjour $nom $prenom, vous êtes connecté en tant que Comptable" ;
		}
	?>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/validationFrais.php';">Valider les fiches de frais</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/suiviFrais.php';">Suivre le paiement des fiches de frais</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/connexionComptable.php';">Se déconnecter</button>
	</ul>
	</body>
</html>
