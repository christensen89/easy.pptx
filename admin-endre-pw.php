<?php
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
<?php
@$slett=$_GET["slett"];
if($slett)
{
	echo"
	<div class='alert alert-danger alert-dismissible' role='alert'>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		Du slettet følgende: <b>$slett</b>
	</div>
	";
}
@$endre=$_GET["endre"];
if($endre)
{
	echo"
	<div class='alert alert-info alert-dismissible' role='alert'>
	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		Du oppdatert følgende: <b>$endre</b>
	</div>
	";
}

?>
	<div class="page-header">
		<h1>Gjør endringer i registrerte powerpoints</h1>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Powerpoints</div>
	<table class="table table-hover">
		<tr><td>Fag</td><td>Navn</td><td>Antall slides</td><td>Endre</td><td>Slett</td></tr>
<?php
include 'script/db-tilkobling.php';
$sql="SELECT p.id, p.navn, p.antallslides, fag.fagkode FROM powerpoint p join fag fag on fag.id=p.fag_id order by fagkode;";
$svar=mysqli_query($db,$sql);
while($rad=mysqli_fetch_array($svar)){
	$id=$rad["id"];
	$navn=$rad["navn"];
	$antallslides=$rad["antallslides"];
	$fagkode=$rad["fagkode"];
	echo "<tr><td>$fagkode</td><td>$navn</td><td>$antallslides</td><td><a href='endre.php?f=p&id=$id'>Endre</a></td><td><a href='slett.php?f=p&id=$id'>Slett</a></td></tr>";
}

?>
	</table>
	</div>
</div>
<?php
include 'slutt.php';
?>
