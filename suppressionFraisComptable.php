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
			$sql = "SELECT * FROM FraisForfait";
			$exec_requete = mysqli_query($db,$requete);
			$reponse= mysqli_fetch_array($exec_requete);
				try{
					$pdo = new PDO($dsn, $db_username, $db_password);
					$stmt = $pdo->query($sql);
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
							<td><?php echo htmlspecialchars($row['libelle']); ?></td>
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
			$sql = "SELECT * FROM FraisHorsForfait";
			$exec_requete = mysqli_query($db,$requete);
			$reponse = mysqli_fetch_array($exec_requete);
				try{
					$pdo = new PDO($dsn, $db_username, $db_password);
					$stmt = $pdo->query($sql);
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
	<form name="formulaire7" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="id">ID dont l'état est à modifier *</label>
		<input type="text" name="id" id="id" value="" >
		<br>
		<label for="libelle">Libelle *</label>
		<input type="text" name="libelle" id="libelle" value="" >
		<br>
		<input type="submit" name="Bouton" value="Supprimer un frais hors forfait" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce frais hors forfait?')">
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
			$libelle=$_POST['libelle'];
				if ( empty($id)){
					echo "<p style='color:red'>Le champ id doit être renseigné</p>";
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
					else {
						$AjouterFrais="UPDATE FraisHorsForfait SET libelle = 'REFUSE : $libelle' WHERE id = '$id'" ;
						mysqli_query($connection, $AjouterFrais) or die('Erreur SQL !'.$AjouterFrais.'<br>'.mysqli_error($connection));
					}
				}
			}
		}
	?>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/validationFrais.php';">Ajouter un nouveau frais hors forfait</button>
	</ul>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/modificationFraisComptable.php';">Modifier un frais hors forfait</button>
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
