<?php
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
	<div class="page-header">
		<h1>Tilbakemeldinger</h1>
	</div>
	<div class="well-sm">
		<div class="btn-group" role="group">
		  <a href="tilbakemeldinger.php?alle=true" type="button" class="btn btn-primary">Alle</a>
		  <a href="tilbakemeldinger.php?alle=false" type="button" class="btn btn-primary">Uleste</a>
		</div>
	</div>

<?php
@$alle=$_GET["alle"];
$sett="where sett='nei'";
if($alle=='true')
{
	$sett="";
}
$sql="SELECT m.id, m.tekst, m.dato, u.brukernavn, t.type FROM aulesjord2.message m join users u on u.id=.m.user_id join message_type t on t.id=m.type_id $sett order by id desc;";
$svar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($svar);
if($antall>=1)
{
	for($r=1;$r<=$antall;$r++)
	{
		$rad=mysqli_fetch_array($svar);
		$id=$rad["id"];
		$tekst=$rad["tekst"];
		$dato=$rad["dato"];
		$brukernavn=ucfirst($rad["brukernavn"]);
		$type=ucfirst($rad["type"]);
		$knapp="
			<div class='well-sm'>
				<form method='post'>
				<button type='submit' class='btn btn-danger' name='skjul[]' value='$id'>Lest</button>
				</form>
			</div>";
		if($alle=='true')
		{
			$knapp="";
		}
		if($brukernavn=="Gjest")
		{
			print("
			<div class='well well-lg'>
			<b>Type: </b>$type</br>
			<b>Dato: </b>$dato</br>
			<div class='alert alert-info' role='alert'>
			$tekst
			</div>
			$knapp
			</div>");
		}
		else{
			print("
			<div class='well well-lg'>
			<b>Type: </b>$type</br>
			<b>Dato: </b>$dato</br>
			<b>Navn: </b>$brukernavn</br>
			<div class='alert alert-info' role='alert'>
			$tekst
			</div>
			$knapp
			</div>");
		}
		
	}
	@$skjul=$_POST["skjul"];
	if($skjul)
	{
		foreach($skjul as $id)
		{
			$sql="UPDATE `aulesjord2`.`message` SET `sett`='ja' WHERE `id`='$id';";
			mysqli_query($db,$sql);
			echo"<script>window.open('tilbakemeldinger.php', '_self')</script>";
		}
	}
}
else{
	print("
		<div class='alert alert-warning' role='alert'>
		<b>Ingen</b> tilbakemeldinger.
 		</div>");
}
?>
<?php
include 'slutt.php';
?>