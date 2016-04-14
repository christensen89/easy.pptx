<?php
include 'start.php';
?>
<div class="container">
<div class="page-header">
    <h1 class="text-center">Velg foreleser</h1>
  </div>
<?php
include 'db-tilkobling.php';
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
		<div class='col-md-4 col-xs-12 col-sm-6 search-result'>
		<div class='well well-lg'>
          <h3>$fornavn $etternavn</h3>
		  <ul class='meta-search'>
					<li><i class='glyphicon glyphicon-user'></i> <span>$stilling</span></li>
					<li><a href='mailto:$epost'><i class='glyphicon glyphicon-envelope'></i> $epost</a></li>
				</ul>
		  </p>
          <a href='vis-fag.php?lid=$id' class='btn btn-primary' title='Fag'>Til fag</a>
		  </div>
        </div>
		  
		  
		 ");
}
?>
</div>
<?php
include 'slutt.php';
?>
