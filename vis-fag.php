<?php
include 'start.php';
?>
<div class="container">
  <div class="page-header">
    <h1 class="text-center">Velg fag</h1>
  </div>
  <!--
  <p class="lead text-center">Hvis ett fag går over flere semestere vil dette hver del av faget være to seperate fag. Finner du ikke faget ditt? Søk her!</p>
  	<div class="row">
		<div class="col-md-12">
			<form method="get" action="search.php">
				<div class="input-group" id="adv-search">
					<input type="search" class="form-control" id="sokeord" name="sokeord" <?php /* include 'script/sokeord.php' */?>>
					<div class="input-group-btn">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
					</div>
				</div>
			</form>
        </div>
	</div>
	-->
	<div class="clearfix"></div>

<?php
include 'db-tilkobling.php';
$sql="select fag.id, fag.navn as fagnavn, fag.fagkode, l.fornavn, l.etternavn, p.ar, p.termin from aulesjord2.fag fag join laerer l on l.id=fag.laerer_id join periode p on p.id=fag.periode_id";
@$lid=$_GET["lid"];
if($lid)
{
	$sql="select fag.id, fag.navn as fagnavn, fag.fagkode, l.fornavn, l.etternavn, l.id as laererid, p.ar, p.termin from aulesjord2.fag fag join laerer l on l.id=fag.laerer_id join periode p on p.id=fag.periode_id where l.id=$lid";
}
@$tid=$_GET["tid"];
if($tid)
{
	$sql="select fag.id, fag.navn as fagnavn, fag.fagkode, l.fornavn, l.etternavn, p.id as laererid, p.ar, p.termin from aulesjord2.fag fag join laerer l on l.id=fag.laerer_id join periode p on p.id=fag.periode_id where p.id=$tid";
}
$sqlsvar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($sqlsvar);
if($antall==0)
{
	print("<div class='container'><div class='alert alert-danger' role='alert'>Ingen registrerte fag i valgt periode.</div>");
}
for($r=1;$r<=$antall;$r++)
{
	$rad=mysqli_fetch_array($sqlsvar);
	$fagid=$rad["id"];
	$fagnavn=$rad["fagnavn"];
	$fagkode=$rad["fagkode"];
	$fornavn=$rad["fornavn"];
	$etternavn=$rad["etternavn"];
	$ar=$rad["ar"];
	$termin=$rad["termin"];
	print("
		<div class='col-md-4 col-xs-12 col-sm-6 search-result'>
		<div class='well well-lg'>
          <h3>$fagkode</h3>
          <p>
		  <ul class='meta-search'>
					<li><i class='glyphicon glyphicon-folder-open'></i> <span>$fagnavn</span></li>
					<li><i class='glyphicon glyphicon-user'></i> <span>$fornavn $etternavn</span></li>
					<li><i class='glyphicon glyphicon-education'></i> <span>$termin $ar</span></li>
				</ul>
		  </p>
          <a href='powerpoints.php?fag=$fagid' class='btn btn-primary' title='Powerpoints'>Til powerpoints</a>
		  </div>
        </div>
    
	  ");
}
print("</div>");
?>

<?php
include 'slutt.php';
?>

    
