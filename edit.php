<?php
include 'start.php';
?>
<div class="container">
<div class="page-header">
    <h1 class="text-center">Rediger registrerte data</h1>
  </div>
  

<!-- FAG -->
<div class="panel panel-info">
  <div class="panel-heading">Fag</div>
  <table class="table table-striped">
  <thead>
  <tr><th>Fagnavn</th><th>Fagkode</th><th>Lærer</th><th>Periode</th><th class="text-center">Rediger</th></tr>
  <tbody>

<?php
include 'db-tilkobling.php';
$fra="?f=fag";
$sql="SELECT f.id, f.navn, f.fagkode, l.fornavn, l.etternavn, p.ar, p.termin FROM aulesjord2.fag f join laerer l on l.id=f.laerer_id join periode p on p.id=f.periode_id";
$sqlsvar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($sqlsvar);
for($r=1;$r<=$antall;$r++)
{
	$rad=mysqli_fetch_array($sqlsvar);
	$id=$rad["id"];
	$navn=$rad["navn"];
	$fagkode=$rad["fagkode"];
	$fornavn=$rad["fornavn"];
	$etternavn=$rad["etternavn"];
	$ar=$rad["ar"];
	$termin=$rad["termin"];
	print("
		<tr>
		<td>$navn</td>
		<td>$fagkode</td>
		<td>$fornavn $etternavn</td>
		<td>$termin $ar</td>
		<td class='text-center'><a class='btn btn-info btn-xs' href='endre.php$fra&id=$id'><span class='glyphicon glyphicon-edit'></span> Endre</a> <a href='slett.php$fra&id=$id' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Slett</a></td>
		 ");
}
?>
<tbody><thead></table></div> <!-- SLUTT PÅ FAG -->

<!-- LÆRERE -->
<div class="panel panel-info">
  <div class="panel-heading">Forelesere</div>
  <table class="table table-striped">
  <thead>
  <tr><th>Navn</th><th>Stilling</th><th>Epost</th><th class="text-center">Rediger</th></tr>
  <tbody>

<?php
include 'db-tilkobling.php';
$fra="?f=laerer";
$sql="SELECT * FROM aulesjord2.laerer;";
$sqlsvar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($sqlsvar);
for($r=1;$r<=$antall;$r++)
{
	$rad=mysqli_fetch_array($sqlsvar);
	$id=$rad["id"];
	$fornavn=$rad["fornavn"];
	$etternavn=$rad["etternavn"];
	$stilling=$rad["stilling"];
	$epost=$rad["epost"];
	print("
		<tr>
		<td>$fornavn $etternavn</td>
		<td>$stilling</td>
		<td>$epost</td>
		<td class='text-center'><a class='btn btn-info btn-xs' href='endre.php$fra&id=$id'><span class='glyphicon glyphicon-edit'></span> Endre</a> <a href='slett.php$fra&id=$id' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Slett</a></td>
		 ");
}
?>
<tbody><thead></table></div> <!-- SLUTT PÅ LÆRERE -->


<!-- POWERPOINTS -->
<div class="panel panel-info">
  <div class="panel-heading">Powerpoints</div>
  <table class="table table-striped">
  <thead>
  <tr><th>Navn</th><th>Fagkode</th><th>Periode</th><th>Antall slides</th><th>Link</th><th class="text-center">Rediger</th></tr>
  <tbody>

<?php
include 'db-tilkobling.php';
$fra="?f=powerpoint";
$sql="SELECT p.id, p.navn, p.link, p.antallslides, f.fagkode, periode.ar, periode.termin FROM aulesjord2.powerpoint p join fag f on f.id=p.fag_id join periode on f.periode_id=periode.id";
$sqlsvar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($sqlsvar);
for($r=1;$r<=$antall;$r++)
{
	$rad=mysqli_fetch_array($sqlsvar);
	$id=$rad["id"];
	$navn=$rad["navn"];
	$link=$rad["link"];
	$antallslides=$rad["antallslides"];
	$fagkode=$rad["fagkode"];
	$ar=$rad["ar"];
	$termin=$rad["termin"];
	print("
		<tr>
		<td>$navn</td>
		<td>$fagkode</td>
		<td>$termin $ar</td>
		<td>$antallslides</td>
		<td>$link</td>
		<td class='text-center'><a class='btn btn-info btn-xs' href='endre.php$fra&id=$id'><span class='glyphicon glyphicon-edit'></span> Endre</a> <a href='slett.php$fra&id=$id' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Slett</a></td>
		 ");
}
?>
<tbody><thead></table></div> <!-- SLUTT PÅ POWERPOINTS -->

<!-- POWERPOINTS SLIDES -->
<div class="panel panel-info">
  <div class="panel-heading">Powerpoint slides</div>
  <table class="table table-striped">
  <thead>
  <tr><th>Navn</th><th>Fagkode</th><th>Link</th><th>Antall slides</th><th>Periode</th><th class="text-center">Rediger</th></tr>
  <tbody>

<?php
$sql="denne kan du fjeren";
if($sql=="fjern")
{
include 'db-tilkobling.php';
$fra="?f=pw-slide";
$sql="SELECT pw.id, pw.link, p.navn, p.antallslides, f.fagkode, periode.ar, periode.termin FROM aulesjord2.`pw-slide` pw join powerpoint p on p.id=pw.powerpoint_id join fag f on f.id=p.fag_id join periode on periode.id=f.periode_id;";
$sqlsvar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($sqlsvar);
for($r=1;$r<=$antall;$r++)
{
	$rad=mysqli_fetch_array($sqlsvar);
	$id=$rad["id"];
	$link=$rad["link"];
	$navn=$rad["navn"];
	$fagkode=$rad["fagkode"];
	$ar=$rad["ar"];
	$termin=$rad["termin"];
	$antallslides=$rad["antallslides"];
	print("
		<tr>
		<td>$navn</td>
		<td>$fagkode</td>
		<td>$link</td>
		<td>$antallslides</td>
		<td>$termin $ar</td>
		<td class='text-center'><a class='btn btn-info btn-xs' href='endre.php$fra&id=$id'><span class='glyphicon glyphicon-edit'></span> Endre</a> <a href='slett.php$fra&id=$id' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Slett</a></td>
		 ");
}
}
?>
<tbody><thead></table></div> <!-- SLUTT PÅ POWERPOINTS SLIDES -->


</div> <!-- CONTAINER -->
<?php
include 'slutt.php';
?>
