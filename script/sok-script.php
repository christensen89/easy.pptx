<hgroup class="mb20">
<?php
@$sokeord=$_GET["sokeord"];
if($sokeord)
{
	include 'script/db-tilkobling.php';
	$sql="select pw.link,pw.slidenr, p.id, p.navn as pwnavn, p.filbane, p.powerpointfil, f.navn as fagnavn, l.fornavn, l.etternavn, pe.ar, pe.termin
from `pw-slide` pw
join powerpoint p on p.id=pw.powerpoint_id
join fag f on f.id=p.fag_id
join laerer l on l.id=f.laerer_id
join periode pe on pe.id=f.periode_id
where
pw.innhold like '%$sokeord%';";
	$sqlresultat=mysqli_query($db,$sql);
	$antall=mysqli_num_rows($sqlresultat);
	include 'script/registrersok.php';
	print("
	<h1>Søkeresultater</h1>
	<h2 class='lead'><strong class='text-danger'>$antall</strong> resultater ble funnet ved ditt søk <strong class='text-danger'>$sokeord</strong></h2>
	<section class='col-xs-12 col-sm-6 col-md-12'></br>
	");
	for($r=1;$r<=$antall;$r++)
	{
		$rad=mysqli_fetch_array($sqlresultat);
		$pwLink=$rad["link"];
		$pId=$rad["id"];
		$powerpointNavn=$rad["pwnavn"];
		$slidenr=$rad["slidenr"];
		$filbane=$rad["filbane"];
		$powerpointdl=glob("$filbane*.{pptx,ppt}", GLOB_BRACE);
		$fagNavn=$rad["fagnavn"];
		$laererFornavn=$rad["fornavn"];
		$laererEtternavn=$rad["etternavn"];
		$periodeArr=$rad["ar"];
		$periodeTermin=$rad["termin"];
		print("
		<div class='col-md-4 search-result'>
		<div class='well well-lg'>
				<a href='slide.php?id=$pId&slide=$slidenr' class='thumbnail'><img src='$filbane$pwLink' alt='Slide' /></a>
				<ul class='meta-search'>
					<li><i class='glyphicon glyphicon glyphicon-comment'></i> <span>$powerpointNavn</span></li>
					<li><i class='glyphicon glyphicon glyphicon-book'></i> <span>$fagNavn</span></li>
					<li><i class='glyphicon glyphicon-user'></i> <span>$laererFornavn $laererEtternavn</span></li>
					<li><i class='glyphicon glyphicon-education'></i> <span>$periodeTermin $periodeArr</span></li>
					<li><a href='$powerpointdl[0]' title='Last ned'><i class='glyphicon glyphicon-download-alt'></i> Last ned</a></li>
				</ul>
			</div>
		</div>
		");
	}
}
?>
	</section>
</hgroup>
