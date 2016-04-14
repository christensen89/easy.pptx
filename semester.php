<?php
include 'start.php';
?>
<div class="container">
<div class="page-header">
    <h1 class="text-center">Velg semester</h1>
  </div>
<?php
include 'db-tilkobling.php';
$sql="SELECT * FROM aulesjord2.periode;";
$sqlsvar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($sqlsvar);
for($r=1;$r<=$antall;$r++)
{
	$rad=mysqli_fetch_array($sqlsvar);
	$id=$rad["id"];
	$ar=$rad["ar"];
	$termin=$rad["termin"];
	print("
		 <div class='col-md-4 col-xs-12 col-sm-6 search-result'>
		<div class='well well-lg'>
          <h3><i class='glyphicon glyphicon-education'></i> $termin $ar</h3>
          <a href='vis-fag.php?tid=$id' class='btn btn-primary' title='Fag'>Til fag</a>
		  </div>
        </div>
		  
		  
		 ");
}
print("</div>");
?>

<?php
include 'slutt.php';
?>
