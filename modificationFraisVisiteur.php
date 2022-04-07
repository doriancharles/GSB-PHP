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
			$requete = "SELECT * FROM FraisForfait";
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
						<th>libelle</th>
						<th>montant</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
						<tr>
							<td><?php echo htmlspecialchars($row['id']); ?></td>
							<td><?php echo htmlspecialchars($row['libelle']); ?><td>
							<td><?php echo htmlspecialchars($row['montant']); ?></td>
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
			session_start();
			$user = $_SESSION['username'];
			$requete = "SELECT id FROM Visiteur WHERE login = '$user'" ;
			$exec_requete = mysqli_query($db,$requete);
			$reponse = mysqli_fetch_array($exec_requete);
			$idVisiteur = $reponse['id'];
			try{
				$pdo = new PDO($dsn, $db_username, $db_password);
				$stmt = $pdo->query($requete);
				if(stmt === false){
					die("Erreur");
				}
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}
			$requete = "SELECT * FROM FraisHorsForfait WHERE idVisiteur = '$idVisiteur'";
			$exec_requete = mysqli_query($db,$requete);
			$reponse = mysqli_fetch_array($exec_requete);
			try{
				$pdo = new PDO($dsn, $db_username, $db_password);
				$stmt = $pdo->query($requete);
				if(stmt === false){
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
						<th>dateEngagement</th>
						<th>libelle</th>
						<th>montant</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
						<tr>
							<td><?php echo htmlspecialchars($row['id']); ?></td>
							<td><?php echo htmlspecialchars($row['dateEngagement']); ?></td>
							<td><?php echo htmlspecialchars($row['libelle']); ?></td>
							<td><?php echo htmlspecialchars($row['montant']); ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</body>
	</fieldset>
	<form name="formulaire2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="id concerné">ID concerné *</label>
		<input type="text" name="id" id="id" value="" >
		<br>
		<label for="dateEngagement">Date Engagement</label>
		<input type="text" name="dateEngagement" id="dateEngagement" value="" >
		<br>
		<label for="libelle">Nouveau libelle</label>
		<input type="text" name="libelle" id="libelle" value="" >
		<br>
		<label for="montant">Nouveau montant</label>
		<input type="text" name="montant" id="montant" value="" >
		<br>
		<input type="submit" name="Bouton" value="Modifier">
		<?php echo "* = Obligatoire" ?>
	</form>
	<?php
	$connection=mysqli_connect("localhost", "gsb", "azerty", "gsbFrais");
	if (!$connection){
		$MessageConnexion = die ("connection impossible");
	}
	else {
		if(isset($_POST['Bouton'])){
			$id=$_POST['id'];
			$dateEngagement=$_POST['dateEngagement'];
			$libelle=$_POST['libelle'];
			$montant=$_POST['montant'];
			if ( empty($id)){
				echo "<p style='color:red'>Le champ id doit être renseigné</p>";
			}
			else {
				if (!preg_match('/[0-9]{1,3}/', $id)){
					echo "<p style='color:red'>ID numérique attendu tel que xxx</p>";
				}
				else {
					$requete = "SELECT count(*) 
					FROM FraisHorsForfait 
					WHERE id = '$id'";
					$exec_requete = mysqli_query($connection,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					$count = $reponse['count(*)'];
					if($count==0){
						echo "<p style='color:red'>Cet ID ne correspond pas à un existant</p>";
					}
					if (preg_match('/20[0-9]{2}-(0[1-9])|(1[012])-(0[1-9])|([12][0-9])|(3[01])/', $dateEngagement)){
						$ModifierDateEngagementFrais="UPDATE FraisHorsForfait SET dateEngagement='$dateEngagement' WHERE id='$id'";
						mysqli_query($connection, $ModifierDateEngagementFrais) or die('Erreur SQL !'.$ModifierDateEngagementFrais.'<br>'.mysqli_error($connection));
					}
					if (preg_match('/[A-Z]{1}[a-z]{1,29}/', $libelle)){
						$ModifierLibelleFrais="UPDATE FraisHorsForfait SET libelle='$libelle' WHERE id='$id'";
						mysqli_query($connection, $ModifierLibelleFrais) or die('Erreur SQL !'.$ModifierLibelleFrais.'<br>'.mysqli_error($connection));
					}
					if (preg_match('/[0-9]{1,5}\.[0-9]{1,2}/', $montant)){
						$ModifierMontantFrais="UPDATE FraisHorsForfait SET montant='$montant' WHERE id='$id'";
						mysqli_query($connection, $ModifierMontantFrais) or die('Erreur SQL !'.$ModifierMontantFrais.'<br>'.mysqli_error($connection));
					}
				}
			}
			if (!preg_match('/20[0-9]{2}-(0[1-9])|(1[012])-(0[1-9])|([12][0-9])|(3[01])/', $dateEngagement)){
				echo "<p style='color:red'>Date attendue tel que AAAA-MM-JJ</p>";
			}
			if (!preg_match('/[A-Z]{1}[a-z]{1,29}/', $libelle)){
				echo "<p style='color:red'>Valeur alphabétique attendue tel que Xxxx...</p>";
			}
			if (!preg_match('/[0-9]{1,5}\.[0-9]{1,2}/', $montant)){
				echo "<p style='color:red'>Valeur numérique attendue tel que xxxxx.xx</p>";
			}		
		}
	}
	?>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/suppressionFraisVisiteur.php';">Supprimer un frais hors forfait</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/saisieFrais.php';">Ajouter un nouveau frais hors forfait</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/accueilVisiteur.php';">Revenir à l'accueil Visiteur</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/connexionVisiteur.php';">Se déconnecter</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/accueil.php';">Revenir à l'accueil principal</button>
	</ul>
</html>
