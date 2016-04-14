<?php
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
<?php
@$registrerslide=$_GET["registrerslide"];
@$powerpoint=$_GET["powerpointid"];
if($registrerslide||$powerpoint)
{
	include'db-tilkobling.php';
	$sql="select p.id, p.navn, f.fagkode, pe.ar, pe.termin from powerpoint as p join fag as f on f.id=p.fag_id join periode as pe on pe.id=f.periode_id where p.id=$powerpoint order by f.fagkode;";
	$sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente fra db<br/>$sql");
	$svar=mysqli_fetch_assoc($sqlresultat);
	$id=$svar["id"];
	$navn=$svar["navn"];
	$fagkode=$svar["fagkode"];
	$ar=$svar["ar"];
	$termin=$svar["termin"];
	print("
	<div class='page-header'>
		<h1 class='text-center'>$navn, $fagkode, $ar $termin</h1>
	</div>
	");
	$sql="SELECT antallslides FROM aulesjord2.powerpoint where id=$powerpoint";
	$svar=mysqli_query($db,$sql) or die("Kunne ikke registrere i db.<br/>$sql");
	$rad=mysqli_fetch_assoc($svar);
	$antall=$rad["antallslides"];
	print("
	<form method='post' class='form-horizontal'>
	");
	for($r=1;$r<=$antall;$r++)
	{
		print("
		<div class='form-group'>
			<label class='control-label col-xs-2'>Slide $r</label>
			<div class='col-xs-5'>
				<textarea type='text' class='form-control' id='innhold' name='innhold[]' placeholder='Innhold til slide $r'></textarea>
			</div>
		</div>
		");
	}
	print("
	<div class='form-group'>
	<div class='col-xs-offset-2 col-xs-10'>
		<input type='submit' class='btn btn-primary' value='Registrer slides' name='registrerslides' id='registrerslides'/>
    </div>
	</form>
	");
	@$registrerslides=$_POST["registrerslides"];
	if($registrerslides)
	{
		$innholdfrapost=$_POST["innhold"];
		for($r=1;$r<=$antall;$r++)
		{
			$innhold=$innholdfrapost[$r-1];
			if($innhold)
			{
				$innholdtildb=" " . $innhold . " ";
				$nysql.="UPDATE `aulesjord2`.`pw-slide` set innhold = concat(innhold,'$innholdtildb') where powerpoint_id=$powerpoint and slidenr=$r;";
				$gggggg="UPDATE `aulesjord2`.`pw-slide` set innhold = concat(innhold,'$innholdtildb') where powerpoint_id=$powerpoint and slidenr=$r;";
				echo $gggggg . "</br>";
			}
		}
		mysqli_multi_query($db,$nysql)or die("Får ikke skrevet til server.");
		
	}
}
else{
	include 'form/admin-pw-slide-form.php';
}
?>
</div>

<?php
include 'slutt.php';
?>
