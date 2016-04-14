<?php
@$fag=$_GET["fag"];
if($fag)
{
	include("db-tilkobling.php");
	$sql="select f.id, f.fagkode, p.ar, p.termin from fag f inner join periode p on p.id=f.periode_id where f.id=$fag";
	$sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente fra db<br/>$sql");
	$tellrader=mysqli_num_rows($sqlresultat);
    $rad=mysqli_fetch_array($sqlresultat);
    $id=$rad["id"];
    $fagkode=$rad["fagkode"];
    $termin=$rad["termin"];
    $ar=$rad["ar"];
    print("<option value='$id'>Valgt: $fagkode, $termin, $ar</option>");
}
else{
	print("<option>Velg Fag</option>");
}
 
?>
