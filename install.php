<!DOCTYPE html>
<html>
	<head>
		<title>Install DB</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<form action='?' method='post'>
			<fieldset>
				<legend>Connexion a la base de donnée MySQL</legend>
				<span>Login :</span><input type='text' name='login' value='root' /><br />
				<span>Password :</span><input type='password' name='passwrd' value='' /><br />
				<input type='submit' name='submit' value='OK' />
			</fieldset>
		</form>
		<div>
			<?php
				if (isset($_POST['login']) and isset($_POST['passwrd']))
				{
					echo "<h2>Tentative de connexion a la base de donnée</h2>";
					$mysqli = mysqli_connect("local.42.fr", "$_POST[login]", "$_POST[passwrd]");
					if (mysqli_connect_errno()) {
						echo "<p>Failed to connect to MySQL: ".mysqli_connect_error()."<p>";
						exit();}
					else
					{
						echo "<p>Connexion success!</p>";
						$file = "<?php \$mysqli = mysqli_connect(\"local.42.fr\", \"$_POST[login]\", $_POST[passwrd]\", \"db_W40k\") ?>";
						file_put_contents("connect.inc.php", $file);
					}
					echo "<h2>Creation de la bse de donnée db_W40k</h2>";
					if (mysqli_query($mysqli, "CREATE DATABASE db_W40k") === TRUE)
						echo "<p>db_W40kt creee avec succes.<br /><p>";
					else
						echo "<p>Erreur a la creation de la base de donnee:".mysqli_error($mysqli)."<p>";
					if (mysqli_query($mysqli, "CREATE TABLE ship (
													Ref CHAR(15) NOT NULL,
													PRIMARY KEY(Ref),
													Titre CHAR(255),
													Prix FLOAT,
													Description TEXT,
													Cat INT NOT NULL)") === TRUE)
						echo "<p>catalogue creee avec succes.";
					else
						echo "<p>Erreur a la creation de la table:".mysqli_error($mysqli)."<p>";
				}
			?>
		</div>
	</body>
</html>
