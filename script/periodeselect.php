<?php
	include("script/db-tilkobling.php");
	$sql="SELECT * FROM  periode;";
	$sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente perioder $sql");
	$tellrader=mysqli_num_rows($sqlresultat);

	for($r=1;$r<=$tellrader;$r++)
	{
		$rad=mysqli_fetch_array($sqlresultat);
		$id=$rad["id"];
		$ar=$rad["ar"];
		$termin=$rad["termin"];


		print("<option value='$id'>$termin, $ar</option>");
	}
?>
