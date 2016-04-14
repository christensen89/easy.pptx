<?php
@$fortsett=$_POST["admin-login"];
if($fortsett)
{
	include 'db-tilkobling.php';
	$user=$_POST["user"];
	$pwfrapost=$_POST["pw"];
	$pw=md5($pwfrapost);
	mysql_real_escape_string($sql);
	$sql="SELECT u.id, u.brukernavn, u.passord, u.login, u.login, u.logut, t.navn as brukertype FROM aulesjord2.users u join users_type t on u.tilgang_id=t.id where brukernavn='$user' and passord='$pw';";
	$svar=mysqli_query($db,$sql) or die("Ikke mulig å sjekke din identitet mot databasen");
	$idsvar=mysqli_fetch_assoc($svar);
	$id=$idsvar["id"];
	$login=$idsvar["login"];
	$tilgangid=$idsvar["tilgang_id"];
	$brukertype=$idsvar["brukertype"];
	$antallRader=mysqli_num_rows($svar);
	if($antallRader>0)
	{
		$_SESSION['bruker']=$user;
		$_SESSION['id']=$id;
		$_SESSION['sidensist']=$login;
		$_SESSION['tilgangid']=$tilgangid;
		$_SESSION['brukertype']=$brukertype;
		$sql="UPDATE `aulesjord2`.`users` SET `login`=now() WHERE `id`='$id';";
		mysqli_query($db,$sql) or die("Ikke mulig å sette login.");
		echo"<script>window.open('admin.php', '_self')</script>";
	}
	else
	{
		echo"<script>alert('Email eller passord er feil, prøv igjen!')</script>";
	}
}
?>