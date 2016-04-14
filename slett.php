<?php
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
<?php
@$f=$_GET["f"];
if($f=="p")
{
	@$id=$_GET["id"];
	if($id){
		include 'script/db-tilkobling.php';
		$sql="SELECT p.id, p.navn, p.antallslides, fag.fagkode FROM powerpoint p join fag fag on fag.id=p.fag_id where p.id=$id order by fagkode;";
		$svar=mysqli_query($db,$sql);
		while($rad=mysqli_fetch_array($svar)){
			$id=$rad["id"];
			$navn=$rad["navn"];
			$antallslides=$rad["antallslides"];
			$fagkode=$rad["fagkode"];
			echo "
			<div class='page-header'>
				<h1>Er du sikker på at du vil slette følgende powerpoint?</h1>
			</div>
			<div class='panel panel-default'>
				<div class='panel-heading'>Powerpoint</div>
			<table class='table'>
				<tr><td>Fag</td><td>Navn</td><td>Antall slides</td></tr>
				<tr><td>$fagkode</td><td>$navn</td><td>$antallslides</td></tr>
			</table>
			</div>
				<form method='post' onsubmit=\"return confirm('Er du sikker på at du vil slette $navn?');\">
				<input class='btn btn-success' type='submit' value='Ja' name='fortsett' id='fortsett'>
				<a href='admin-endre-pw.php' class='btn btn-danger'>Nei</a>
			</form>
			";
		}
	}
	else{
		echo"<script>window.open('index.php', '_self')</script>";
	}
	@$fortsett=$_POST["fortsett"];
	if($fortsett)
	{
		$sql="DELETE FROM powerpoint WHERE `id`='$id';";
		mysqli_query($db,$sql) or die("Får ikke slettet $id");
		echo"<script>window.open('admin-endre-pw.php?slett=$navn', '_self')</script>";

		
	}
}
?>
<?php
include 'slutt.php';
?>
