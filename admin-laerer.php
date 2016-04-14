<?php
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
	<div class="page-header">
		<h1>Registrer foreleser</h1>
	</div>
<?php
	include 'form/admin-laerer-form.php';
	@$registrerlaerer=$_POST["registrerlaerer"];
	if($registrerlaerer)
	{
		if(!filter_var($_POST['epost'],FILTER_VALIDATE_EMAIL))
		{
			print("
			<div class='container'>
			<div class='alert alert-danger'>
			<strong>Feil!</strong> Du må fylle ut alle felt.
			</div>
			</div>
			");
		}
		else
		{
			include 'script/db-tilkobling.php';
			$fornavn=$_POST["fornavn"];
			$etternavn=$_POST["etternavn"];
			$stilling=$_POST["stilling"];
			$epost=$_POST["epost"];
			$sql="INSERT INTO `aulesjord2`.`laerer` (`fornavn`, `etternavn`, `stilling`, `epost`) VALUES ('$fornavn', '$etternavn', '$stilling', '$epost');";
			mysqli_query($db,$sql);
			print("
			<div class='container'>
			<div class='alert alert-success'>
			<strong>Fullført!</strong> Du har registrert læreren: $fornavn, $etternavn.
			</div>
			</div>");
		}
		
	}
?>
</div>

<?php
include 'slutt.php';
?>
