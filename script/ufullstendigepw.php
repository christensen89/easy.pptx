<?php
	$sql="select p.id, p.navn, p.antallslides, f.fagkode, pe.ar, pe.termin from powerpoint as p join fag as f on f.id=p.fag_id join periode as pe on pe.id=f.periode_id;";
	$sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente fra db<br/>$sql");
	$antall=mysqli_num_rows($sqlresultat);
	for($r=0;$r<$antall;$r++)
	{
		$rad=mysqli_fetch_array($sqlresultat);
		$navn=$rad["navn"];
		$fagkode=$rad["fagkode"];
		$antallslides=$rad["antallslides"];
		$id=$rad["id"];
		$filbane="powerpoints/$fagkode/$navn";
		$files = scandir($filbane);
		$filerframappe= count($files);
		//minus to for . og .., og minus en for .pptx
		$numfiles = count($files)-3;
		$mangler=$antallslides-$numfiles-2;
		if($numfiles<$antallslides){
			$melding[]="<div class='alert alert-danger' role='alert'>
			
  <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='tanrue'></span> $mangler slides mangler i \"$navn\". <a href='admin-pw.php?id=$id' class='alert-link'>Fiks!</a></div>";
		}

	}
if(count($melding)>0)
{
	$antall=count($melding);
	echo "<div class='page-header'><h3> Feilmeldinger <span class='label label-danger'>$antall</span></h3></div>";
	foreach($melding as $printut)
	{
		echo $printut;
	}
}	
?>