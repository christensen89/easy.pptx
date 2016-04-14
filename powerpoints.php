<?php
include 'start.php';
?>

<div class="container">
  <div class="page-header">
    <h1 class="text-center">Powerpoints</h1>
  </div>
<form method="get" class="form-horizontal">
    <div class="form-group">
        <label for="sel1" class="control-label col-xs-2">Fag</label>
        <div class="col-xs-5">
          <select class="form-control" id="fag" name="fag">
			<?php include("script/fagselectget.php");?>
            <?php include("script/fagselect.php");?>
          </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
          <input type='submit' class="btn btn-primary" value='Fortsett' name='velgfag' id='velgfag'/>
        </div>
    </div>
</form>
</div>
<?php
@$fag=$_GET["fag"];
if($fag)
{
	include 'script/db-tilkobling.php';
	$sql="
	select p.id, p.navn as pwnavn, p.powerpointfil, p.filbane, f.navn as fagnavn, l.fornavn, l.etternavn, pe.ar, pe.termin, pw.link, pw.slidenr
	from  powerpoint p
	join fag f on f.id=p.fag_id
	join laerer l on l.id=f.laerer_id
	join periode pe on pe.id=f.periode_id
	inner join `pw-slide` pw on pw.powerpoint_id=p.id
	where f.id=$fag
	and slidenr=1
	order by p.id asc;
	";
	$sqlresultat=mysqli_query($db,$sql);
	$antall=mysqli_num_rows($sqlresultat);
	if($antall==0)
	{
		print("<div class='container'><div class='alert alert-danger' role='alert'>Ingen registrerte powerpoints i ønsket fag.</div>");
	}
	else{
		print("
				<div class='container'><hgroup class='mb20'>
				<section class='col-xs-12 col-sm-12 col-md-12'></br>
		");
		for($r=1;$r<=$antall;$r++)
		{
			$rad=mysqli_fetch_array($sqlresultat);
			$pwLink=$rad["link"];
			$pwslidenr=$rad["slidenr"];
			$pwid=$rad["id"];
			$powerpointNavn=$rad["pwnavn"];
			$filbane=$rad["filbane"];
			$powerpointfil=$rad["powerpointfil"];
			$fagNavn=$rad["fagnavn"];
			$laererFornavn=$rad["fornavn"];
			$laererEtternavn=$rad["etternavn"];
			$periodeArr=$rad["ar"];
			$periodeTermin=$rad["termin"];
			print("
		<div class='col-md-4 col-sm-6 col-xs-12 col-lg-3 search-result'>
			<div class='well well-lg'>
				<div class='text-center'>
					<a href='slide.php?id=$pwid'><img src='$filbane$pwLink' class='img-responsive inline-block' alt='Slide' /></a>
				</div>
					<ul class='meta-search'>
						<li><i class='glyphicon glyphicon glyphicon-comment'></i> <span>$powerpointNavn</span></li>
						<li><i class='glyphicon glyphicon glyphicon-book'></i> <span>$fagNavn</span></li>
						<li><i class='glyphicon glyphicon-user'></i> <span>$laererFornavn $laererEtternavn</span></li>
						<li><i class='glyphicon glyphicon-education'></i> <span>$periodeTermin $periodeArr</span></li>
						<li><a href='$filbane$powerpointfil' title='Last ned'><i class='glyphicon glyphicon-download-alt'></i> Last ned</a></li>
					</ul>
			</div>
		</div>
			");
		}
	print("</section></hgroup></div>");
	}
}
?>
<?php
include 'slutt.php';
?>

