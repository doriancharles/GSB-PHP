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
			$reponse      = mysqli_fetch_array($exec_requete);
			try{
				$pdo = new PDO($dsn, $db_username, $db_password);
				$stmt = $pdo->query($requete);
				if($stmt === false ){
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
							<td><?php echo htmlspecialchars($row['nom']); ?></td>
							<td><?php echo htmlspecialchars($row['prenom']); ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</body>
	</fieldset>
	<form name="form11" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="id">ID dont l'état est à modifier*</label>
		<input type="text" name="id" id="id" value="" >
		<br>
		<label for="etat">Etat (Mise en paiement ou Remboursée ou Validée) *</label>
		<input type="text" name="etat" id="etat" value="" >
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
				$etat=$_POST['etat'];
				if ( empty($id)){
					echo "<p style='color:red'>Le champ id doit être renseigné</p>";
				}
				else {
					$requete = "SELECT count(*) 
					FROM FraisHorsForfait 
					WHERE idVisiteur = '$id'";
					$exec_requete = mysqli_query($connection,$requete);
					$reponse = mysqli_fetch_array($exec_requete);
					$count = $reponse['count(*)'];
					if($count==0){
						echo "<p style='color:red'>Cet ID ne correspond pas à un existant</p>";
					}
					else {
						if (preg_match('/Mise en paiement|Remboursée|Validée/', $etat)){
							$AjouterFrais="UPDATE FraisHorsForfait SET etat = '$etat' WHERE idVisiteur = '$id'" ;
							mysqli_query($connection, $AjouterFrais) or die('Erreur SQL !'.$AjouterFrais.'<br>'.mysqli_error($connection));
						}
					}
				}
				if ( empty($etat)){
					echo "<p style='color:red'>Le champ etat doit être renseigné</p>";
				}
				else {
					if (!preg_match('/Mise en paiement|Remboursée|Validée/', $etat)){
						echo "<p style='color:red'>Valeur etat attendue tel que Mise en paiement ou Remboursée ou Validée</p>";
					}
				}
			}
		}
	?>
	<ul>
		<button onclick="window.location.href = 'http://localhost/gsb/src/vues/suiviFrais.php';">Suivre le paiement des fiches de frais</button>
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
