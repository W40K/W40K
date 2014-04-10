<!DOCTYPE html>
<html>
	<head>
		<title>Install DB</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<form action='?' method='post'>
			<fieldset>
				<legend>Connection to MySQL database</legend>
				<span>Login :</span><input type='text' name='login' value='root' /><br />
				<span>Password :</span><input type='password' name='passwrd' value='' /><br />
				<input type='submit' name='submit' value='OK' />
			</fieldset>
		</form>
		<div>
			<?php
				if (isset($_POST['login']) and isset($_POST['passwrd']))
				{
					echo "<h2>Database connection</h2>";
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
					echo "<h2>db_W40k creation database</h2>";
					if (mysqli_query($mysqli, "CREATE DATABASE db_W40k") === TRUE)
						echo "<p>db_W40kt succesfully created.<br /><p>";
					else
						echo "<p>Failed to create database:".mysqli_error($mysqli)."<p>";
					if (mysqli_query($mysqli, "USE db_W40k") === TRUE)
						echo "<p>Success to switch to db_W40k</p>";
					else
						echo "<p>Failed to switch to db_W40k</p>";
					if (mysqli_query($mysqli, "CREATE TABLE ships (
						ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
						name VARCHAR(255) NOT NULL,
						sprite VARCHAR(255) NOT NULL,
						height INT NOT NULL,
						width INT NOT NULL,
						life INT NOT NULL,
						pp INT NOT NULL,
						speed INT NOT NULL,
						agility INT NOT NULL,
						shield INT NOT NULL,
						mobilize BOOLEAN DEFAULT TRUE)") === TRUE)
						echo "<p>Ships table ceated with success.";
					else
						echo "<p>Failed to create ships table:".mysqli_error($mysqli)."<p>";
				}
			?>
		</div>
	</body>
</html>
