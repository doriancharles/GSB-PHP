<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<fieldset>
		<legend>Eléments forfaitisés</legend>
		<?php
			$db_username = 'gsb';
			$db_password = 'azerty';
			$db_name     = 'gsbFrais';
			$db_host     = 'localhost';
			$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
			or die('could not connect to database');
			$dsn = "mysql:host=$db_host;dbname=$db_name";
			$requete = "SELECT id , nom , prenom FROM Visiteur";
			$exec_requete = mysqli_query($db,$requete);
			$reponse= mysqli_fetch_array($exec_requete);
			try{
				$pdo = new PDO($dsn, $db_username, $db_password);
				$stmt = $pdo->query($requete);
				if($stmt === false){
					die("Erreur");
				}
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}
		?>
		<body style="background-color:#606060;">
			<table>
				<thead>
					<tr>
						<th>id</th>
						<th>nom</th>
						<th>prenom</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
						<tr>
							<td><?php echo htmlspecialchars($row['id']); ?></td>
							<td><?php echo htmlspecialchars($row['nom']); ?><td>
							<td><?php echo htmlspecialchars($row['prenom']); ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</body>
	</fieldset>
	<fieldset>
		<legend>Eléments pas forfaitisés</legend>
		<?php
			$db_username = 'gsb';
			$db_password = 'azerty';
			$db_name     = 'gsbFrais';
			$db_host     = 'localhost';
			$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
			or die('could not connect to database');
			$dsn = "mysql:host=$db_host;dbname=$db_name";
			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			if (isset($_POST['Bouton'])) {
				$id=$_POST['id'];
				if ( $_POST['mois'] == "mois"){
					if (strftime("%B") == "janvier"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-01-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de janvier</p>" ;
						}
					}
					if (strftime("%B") == "février"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-02-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de fevrier</p>" ;
						}
					}
					if (strftime("%B") == "mars"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-03-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de mars</p>" ;
						}	
					}
					if (strftime("%B") == "avril"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-04-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois d'avril</p>" ;
						}
					}
					if (strftime("%B") == "mai"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-05-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de mai</p>" ;
						}
					}
					if (strftime("%B") == "juin"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-06-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de juin</p>" ;
						}
					}
					if (strftime("%B") == "juillet"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-07-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de juillet</p>" ;
						}
					}
					if (strftime("%B") == "août"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-08-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);	
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois d'août</p>" ;
						}
					}
					if (strftime("%B") == "septembre"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-09-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de septembre</p>" ;
						}
					}
					if (strftime("%B") == "octobre"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-10-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois d'octobre</p>" ;
						}
					}
					if (strftime("%B") == "novembre"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-11-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de novembre</p>" ;
						}
					}
					if (strftime("%B") == "décembre"){
						$requete = "SELECT dateEngagement , libelle , montant , etat 
						FROM Visiteur 
						INNER JOIN FraisHorsForfait 
						ON Visiteur.id = FraisHorsForfait.idVisiteur 
						WHERE (dateEngagement 
						LIKE '%-12-%' 
						AND Visiteur.id = '$id') 
						AND (etat = 'A Valider' 
						OR etat = 'Mise en paiement')";
						$exec_requete = mysqli_query($db,$requete);
						$reponse = mysqli_fetch_array($exec_requete);
						if ( $reponse == '' ) {
							echo "<p style='color:red'>Pas de fiches frais pour le mois de décembre</p>" ;
						}
					}
				}
				if ( $_POST['mois'] == "janvier"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-01-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de janvier</p>" ;
					}
				}
				if ( $_POST['mois'] == "fevrier"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-02-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de fevrier</p>" ;
					}
				}
				if ( $_POST['mois'] == "mars"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-03-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de mars</p>" ;
					}
				}
				if ( $_POST['mois'] == "avril"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-04-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois d'avril</p>" ;
					}
				}
				if ( $_POST['mois'] == "mai"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-05-%' AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de mai</p>" ;
					}
				}
				if ( $_POST['mois'] == "juin"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-06-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de juin</p>" ;
					}
				}
				if ( $_POST['mois'] == "juillet"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-07-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de juillet</p>" ;
					}
				}
				if ( $_POST['mois'] == "aout"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-08-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois d'août</p>" ;
					}
				}
				if ( $_POST['mois'] == "septembre"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-09-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de septembre</p>" ;
					}
				}
				if ( $_POST['mois'] == "octobre"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-10-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois d'octobre</p>" ;
					}
				}
				if ( $_POST['mois'] == "novembre"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-11-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de novembre</p>" ;
					}
				}
				if ( $_POST['mois'] == "decembre"){
					$requete = "SELECT dateEngagement , libelle , montant , etat 
					FROM Visiteur 
					INNER JOIN FraisHorsForfait 
					ON Visiteur.id = FraisHorsForfait.idVisiteur 
					WHERE (dateEngagement 
					LIKE '%-12-%' 
					AND Visiteur.id = '$id') 
					AND (etat = 'A Valider' 
					OR etat = 'Mise en paiement')";
					$exec_requete = mysqli_query($db,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					if ( $reponse == '' ) {
						echo "<p style='color:red'>Pas de fiches frais pour le mois de décembre</p>" ;
					}
				}
				try{
					$pdo = new PDO($dsn, $db_username, $db_password);
					$stmt = $pdo->query($requete);
				}
				catch (PDOException $e){
					echo $e->getMessage();
				}
			}
		?>
		<form name="form10" method="post">
			<SELECT name="mois">
				<OPTION VALUE="mois">Selectionnez un mois</OPTION>
				<OPTION VALUE="janvier">janvier</OPTION>
				<OPTION VALUE="fevrier">fevrier</OPTION>
				<OPTION VALUE="mars">mars</OPTION>
				<OPTION VALUE="avril">avril</OPTION>
				<OPTION VALUE="mai">mai</OPTION>
				<OPTION VALUE="juin">juin</OPTION>
				<OPTION VALUE="juillet">juillet</OPTION>
				<OPTION VALUE="aout">aout</OPTION>
				<OPTION VALUE="septembre">septembre</OPTION>
				<OPTION VALUE="octobre">octobre</OPTION>
				<OPTION VALUE="novembre">novembre</OPTION>
				<OPTION VALUE="decembre">decembre</OPTION>
			</SELECT>
			<br>
			<label for="id">ID concerné *</label>
			<input type="text" name="id" id="id" value="" >
			<br>
			<input type="submit" name="Bouton" value="Selectionner ce mois">
			<?php echo "* = Obligatoire" ?>
		</form>
		<body style="background-color:#606060;">
			<table>
				<thead>
					<tr>
						<th>dateEngagement</th>
						<th>libelle</th>
						<th>montant</th>
						<th>etat</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
						<tr>
							<td><?php echo htmlspecialchars($row['dateEngagement']); ?></td>
							<td><?php echo htmlspecialchars($row['libelle']); ?></td>
							<td><?php echo htmlspecialchars($row['montant']); ?></td>
							<td><?php echo htmlspecialchars($row['etat']); ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</body>
	</fieldset>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/modificationFraisComptable.php';">Actualiser les informations des frais forfaitisés</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/suppressionFraisComptable.php';">Supprimer les lignes de frais hors forfait non valides</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/accueilComptable.php';">Revenir à l'accueil Comptable</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/connexionComptable.php';">Se déconnecter</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/accueil.php';">Revenir à l'accueil principal</button>
	</ul>
</html>
