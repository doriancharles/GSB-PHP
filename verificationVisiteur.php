<?php
	session_start();
	if(isset($_POST['username']) && isset($_POST['password'])){
		$db_username = 'gsb';
		$db_password = 'azerty';
		$db_name = 'gsbFrais';
		$db_host = 'localhost';
		$db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
		or die('could not connect to database');
		$username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username']));
		$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
		if($username !== "" && $password !== ""){
			$requete = "SELECT count(*) 
			FROM Visiteur 
			WHERE login = '".$username."' 
			AND mdp = '".$password."' ";
			$exec_requete = mysqli_query($db,$requete);
			$reponse = mysqli_fetch_array($exec_requete);
			$count = $reponse['count(*)'];
			if($count!=0){
				$_SESSION['username'] = $username;
				header('Location: accueilVisiteur.php');
			}
			else{
				header('Location: connexionVisiteur.php?erreur=1');
			}
		}
		else{
			if($username === "" && $password !== ""){
				header('Location: connexionVisiteur.php?erreur=2');
			}
			else {
				if($username !== "" && $password === ""){
					header('Location: connexionVisiteur.php?erreur=3');
				}
				else{
					if($username === "" && $password === ""){
						header('Location: connexionVisiteur.php?erreur=4');
					}
				}
			}
		}
	}
	else{
		header('Location: connexionVisiteur.php');
	}
	mysqli_close($db);
?>
