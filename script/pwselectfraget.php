		<?php
		@$powerpoint=$_GET["powerpoint"]; 
		if($powerpoint)
		{

			  include("db-tilkobling.php");
			  $sql="select p.id, p.navn, f.fagkode, pe.ar, pe.termin from powerpoint as p join fag as f on f.id=p.fag_id join periode as pe on pe.id=f.periode_id where p.id=$powerpoint order by f.fagkode;";
			  $sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente fra db<br/>$sql");
			  $tellrader=mysqli_num_rows($sqlresultat);

			  for($r=1;$r<=$tellrader;$r++)
			  {
				$rad=mysqli_fetch_array($sqlresultat);
				$id=$rad["id"];
				$navn=$rad["navn"];
				$fagkode=$rad["fagkode"];
				$ar=$rad["ar"];
				$termin=$rad["termin"];
				print("<option value='$id'>$navn, $fagkode, $ar, $termin</option>");
			  }
		}
		else{
			print("<option>Velg Powerpoint</option>");
		}
?>