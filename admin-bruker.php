<?php
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
	<div class="page-header">
		<h1>Registrer ny bruker</h1>
	</div>
<?php
	include 'form/admin-bruker-form.php';
	include 'script/db-tilkobling.php';
	@$registrerbruker=$_POST["registrerbruker"];
	if($registrerbruker)
	{
		$brukernavn=$_POST["brukernavn"];
		$pw=$_POST["passord"];
		$pw1=$_POST["passord1"];
		if($pw==$pw1)
		{
			$sqlsjekk="select * from `aulesjord2`.`users` where brukernavn='$brukernavn';";
			$sqlsvar=mysqli_query($db, $sqlsjekk);
			$antall=mysqli_num_rows($sqlsvar);
			if($antall>0)
			{
				print("
				<div class='container'>
				<div class='alert alert-danger'>
				<strong>Feil!</strong> brukernavnet er allerede registrert.
				</div>
				</div>
				");
			}
			else{
			$hash=md5($pw);
			include 'script/db-tilkobling.php';
			$sql="INSERT INTO `aulesjord2`.`users` (`brukernavn`, `passord`, `tilgang_id`) VALUES ('$brukernavn', '$hash', 1);";
			mysqli_query($db,$sql);
			print("
			<div class='container'>
			<div class='alert alert-success'>
			<strong>Fullført!</strong> Du har registrert $brukernavn.
			</div>
			</div>
			");
			}
		}
		else{
			print("
			<div class='container'>
			<div class='alert alert-danger'>
			<strong>Feil!</strong> passordene må være like.
			</div>
			</div>
			");
		}
	}
?>

</div>
<?php
include 'slutt.php';
?>
