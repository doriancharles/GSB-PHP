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
						<th>dateEngagement</th>
						<th>libelle</th>
						<th>montant</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
						<tr>
							<td><?php echo htmlspecialchars($row['dateEngagement']); ?></td>
							<td><?php echo htmlspecialchars($row['libelle']); ?></td>
							<td><?php echo htmlspecialchars($row['montant']); ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</body>
	</fieldset>
	<form name="formulaire1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="dateEngagement">Date Engagement *</label>
		<input type="text" name="dateEngagement" id="dateEngagement" value="" >
		<br>
		<label for="libelle">Libelle *</label>
		<input type="text" name="libelle" id="libelle" value="" >
		<br>
		<label for="montant">Montant *</label>
		<input type="text" name="montant" id="montant" value="" >
		<br>
		<input type="hidden" name="id" value="">
		<input type="hidden" name="idVisiteur" value="">
		<input type="submit" name="Bouton" value="Ajouter un frais hors forfait">
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
				session_start();
				$user = $_SESSION['username'];
				$requete = "SELECT id FROM Visiteur WHERE login = '$user'" ;
				$exec_requete = mysqli_query($connection,$requete);
				$reponse = mysqli_fetch_array($exec_requete);
				$idVisiteur = $reponse['id'];
				if ( empty($dateEngagement)){
					echo "<p style='color:red'>Le champ dateEngagement doit être renseigné</p>";
					$erreur = 1 ;
				}
				else {
					if (!preg_match('/2022-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])/', $dateEngagement)){
						echo "<p style='color:red'>Date attendue tel que AAAA-MM-JJ</p>";
						$erreur = 1 ;
					}
				}
				if ( empty($libelle)){
					echo "<p style='color:red'>Le champ libelle doit être renseigné</p>";
					$erreur = 1 ;
				}
				else {
					if (!preg_match('/[A-Z]{1}[a-z]{1,29}/', $libelle)){
						echo "<p style='color:red'>Valeur alphabétique attendue tel que Xxxx...</p>";
						$erreur = 1 ;
					}
				}
				if ( empty($montant)){
					echo "<p style='color:red'>Le champ montant doit être renseigné</p>";
					$erreur = 1 ;
				}
				else {
					if (!preg_match('/[0-9]{1,5}\.[0-9]{1,2}/', $montant)){
						echo "<p style='color:red'>Valeur numérique attendue tel que xxxxx.xx</p>";
						$erreur = 1 ;
					}
				}
				if ( $erreur != 1 ){
					$AjouterFrais="INSERT INTO FraisHorsForfait (dateEngagement, libelle, montant, idVisiteur) VALUES ('$dateEngagement', '$libelle', '$montant' ,'$idVisiteur')";
					mysqli_query($connection, $AjouterFrais) or die('Erreur SQL !'.$AjouterFrais.'<br>'.mysqli_error($connection));
				}
			}
		}
	?>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/modificationFraisVisiteur.php';">Modifier une ou des valeurs des frais au forfait</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/suppressionFraisVisiteur.php';">Supprimer un frais hors forfait</button>
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
