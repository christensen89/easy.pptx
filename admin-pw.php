<?php
include 'start.php';
include 'script/login-check.php';
?>
<?php
include'db-tilkobling.php';
@$id=$_GET["id"];
if($id)
{
	$powerpointid=$_GET["id"];
	$sql="select p.id, p.navn, p.antallslides, f.fagkode, pe.ar, pe.termin from powerpoint as p join fag as f on f.id=p.fag_id join periode as pe on pe.id=f.periode_id where p.id=$powerpointid;";
	$sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente fra db<br/>$sql");
	$svar=mysqli_fetch_assoc($sqlresultat);
	$id=$svar["id"];
	$navn=$svar["navn"];
	$fagkode=$svar["fagkode"];
	$ar=$svar["ar"];
	$termin=$svar["termin"];
	$antallslides=$svar["antallslides"];
	print("
<div class='container'>
	<div class='page-header'>
		<h1 class='text-center'>$navn, $fagkode, $ar $termin</h1>
	</div>    
	<div class='panel panel-default'>
		<div class='panel-heading'><strong>Last opp </strong> <small> .pptx-filen og alle tilhørende .JPG filer for $navn</small></div>
			<div class='panel-body'>
				<h4>Velg filer fra din datamaskin</h4>
				<form method='post' action='' enctype='multipart/form-data'>
					<div class='form-inline'>
						<div class='form-group'>
						<span class='btn btn-success fileinput-button'>
							<i class='glyphicon glyphicon-plus'></i>
							<span>Legg til filer</span>
							<input type='file' name='files[]' multiple>
						</span>
						<span class='btn btn-primary fileinput-button'>
							<i class='glyphicon glyphicon-upload'></i>
							<span>Last opp</span>
							<input type='submit' value='Last opp' name='lastopp'>
						</span>
						<span class='btn btn-danger fileinput-button'>
							<i class='glyphicon glyphicon-ban-circle'></i>
							<span>Tøm mappen</span>
							<input type='submit' value='Tøm mappen' name='slettslides'>
						</span>
						</div>
					</div>
				</br>
			</form>	
        </div>
	</div>
</div>
<div class='container'>
	");
	@$lastopp=$_POST["lastopp"];
	$filbane="powerpoints/$fagkode/$navn";
	if($lastopp)
	{
		if(!empty($_FILES["files"]["tmp_name"][0]))
		{
			$tempnavn=$_FILES["files"]["tmp_name"];
			$filnavn=$_FILES["files"]["name"];
			for($r=0;$r < count($tempnavn);$r++)
			{
				if(file_exists($filbane . "/" . $filnavn[$r])){
					echo "<a href='#' class='list-group-item list-group-item-danger'><span class='badge alert-danger pull-right'>Finnes fra før</span>" . $filnavn[$r] . "</a>";
				}
				else if(move_uploaded_file($tempnavn[$r], $filbane . "/" . $filnavn[$r])){
					echo "<a href='#' class='list-group-item list-group-item-success'><span class='badge alert-success pull-right'>Fullført</span>" . $filnavn[$r] . "</a>";
				}
				else{
					echo "<a href='#' class='list-group-item list-group-item-danger'><span class='badge alert-danger pull-right'>Feilet</span>" . $filnavn[$r] . "</a>";
				}
			}
		
		}
		else{
			echo "<div class='alert alert-danger' role='alert'><b>Ingen</b> filer er valgt.</div>";
		}
	}
	

	@$slettslides=$_POST["slettslides"];
	$files = scandir($filbane);
	$filerframappe= count($files);
	//minus to for . og .., og minus en for .pptx
	$numfiles = count($files)-3;
	if($slettslides)
	{
		if($filerframappe<3)
		{
			echo "<div class='alert alert-danger' role='alert'><b>Ingen</b> filer funnet i mappen.</div>";
		}
		
		for($r=0;$r<$filerframappe;$r++)
		{
			if($r>1)
			{
				$mappeogfilnavn= $filbane . "/" . $files[$r];
				echo "<a href='#' class='list-group-item list-group-item-danger'><span class='badge alert-danger pull-right'>Slettet</span> " . $files[$r] . "</a>";
				@unlink($mappeogfilnavn);
			}
		}
	}
	
	$sql="SELECT * FROM aulesjord2.`pw-slide` where powerpoint_id=$id and length(innhold)>1;";
	$svar=mysqli_query($db,$sql);
	$antallslidesmedinnhold=mysqli_num_rows($svar);
	if($filerframappe<0)
	{
		echo "<div class='alert alert-danger' role='alert'>
		Denne powerpointen er opplastet i det gamle systemet.</br>
		Denne bør oppdateres!</br>
		dvs. slettes og legges inn på nytt.</div>";
	}
	else if($numfiles<$antallslides)
	{
		if($numfiles==-1)
		{
			echo "<div class='alert alert-warning' role='alert'><b>Ingen</b> slides er opplastet i <b>$navn</b></div>";
		}
		else{
			echo "<div class='alert alert-warning' role='alert'><b>$numfiles/$antallslides</b> slides er opplastet i <b>$navn</b></div>";
		}
		
	}
	else{
		
		echo "<div class='alert alert-success' role='alert'>
		<b>$numfiles/$antallslides</b> slides er opplastet i <b>$navn</b>.</br>
		<b>$antallslidesmedinnhold/$antallslides</b> slides er søkbare.
		</div>";
	}
	if($numfiles == $antallslides)
	{
		$sql="SELECT * FROM aulesjord2.`pw-slide` where powerpoint_id=$id;";
		$result=mysqli_query($db,$sql);
		$antall=mysqli_num_rows($result);
		if($antall<1)
		{
			 print("
			<div class='alert alert-danger' role='alert'>
			<h4>Nå er alle nødvendige filer opplastet. Registrer de!</h4>
				<form method='post'>
					<input type='submit' name='registrerslides' id='registrerslides' value='Registrer slides' class='btn btn-danger'>
				</from>
			</div>
			</div>
			");
			@$registrerslides=$_POST["registrerslides"];
			if($registrerslides)
			{
				
					sort($files, SORT_NATURAL);
					for($r=0;$r<$filerframappe;$r++)
					{
						if($r>2)
						{
							$input=$files[$r];
							$nr=$r-2;
							$nysql.="INSERT INTO `aulesjord2`.`pw-slide` (`link`, `slidenr`, `powerpoint_id`, `innhold`) VALUES ('$input', '$nr', '$id', ' ');";
							$sqlarray[]=$nysql;
						}
						
					}
					mysqli_multi_query($db,$nysql)or die("Får ikke skrevet til server.");
					function getUrl() {
						$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
						$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
						$url .= $_SERVER["REQUEST_URI"];
						return $url;
					}
					$adresse=getUrl();
					echo"<script>window.open('$adresse', '_self')</script>";
			}
		}
		else{
			print("
				<div class='alert alert-info' role='alert'>
				Nå <b>gjenstår</b> bare en ting!</br>
				Nemmelig å gjøre hver enkelt slide søkbar.</br>
				Dette gjør du <b>enkelt</b> ved å kopiere alt innholder fra hver enkelt powerpoint-slide inn på denne siden.</br>
				<a class='btn btn-primary' href='admin-pw-slide.php?powerpointid=$id'>Fortsett</a></div>
			");
		}
	}

}

else{
	@$fag=$_GET["fag"];
	if(!$fag)
	{
		include 'form/admin-pw-form.php';
	}
	@$registrerknapp=$_POST["registrerknapp"];
	if($registrerknapp)
	{
		$navn=$_POST["navn"];
		$powerpointfil=$_POST["powerpointfil"];
		$fag=$_POST["fag"];
		$antallslides=$_POST["antallslides"];		
		$sql="select fagkode from aulesjord2.fag where id=$fag;";
		$svar=mysqli_query($db,$sql) or die("$sql");
		$rad=mysqli_fetch_assoc($svar);
		$fagkode=$rad["fagkode"];
		$mappenavn="powerpoints/$fagkode";
		$pwmappe="powerpoints/$fagkode/$navn";
		$filbane=$pwmappe . "/";
		
		$sql="INSERT INTO `aulesjord2`.`powerpoint` (`navn`, `fag_id`,`antallslides`,`powerpointfil`,`filbane`) VALUES ('$navn', '$fag', '$antallslides', '$powerpointfil', '$filbane');";
		mysqli_query($db,$sql) or die("Kunne ikke registrere i db.<br/>$sql");
		if(!file_exists($mappenavn))
		{
			mkdir($mappenavn);
		}
		if(!file_exists($pwmappe))
		{
			mkdir($pwmappe);
		}
		$sql="SELECT id FROM aulesjord2.powerpoint where navn='$navn'";
		$svar=mysqli_query($db,$sql) or die("Klarer ikke å hente fagkoden.");
		$rad=mysqli_fetch_assoc($svar);
		$id=$rad["id"];
		echo"<script>window.open('admin-pw.php?id=$id', '_self')</script>";
	}
	
	
print("<div class='container'>
<div class='row'>
<div class='clearfix'></div>");
	if($fag)
	{
		print("
		<div class='page-header'>
			<h1>Endre powerpoints</h1>
		</div>
		");
		$sql="SELECT * FROM aulesjord2.powerpoint where fag_id=$fag;";
		$sqlsvar=mysqli_query($db,$sql);
		$antallsqlsvar=mysqli_num_rows($sqlsvar);
		if($antallsqlsvar>=1)
		{
			for($r=1;$r<=$antallsqlsvar;$r++)
			{
				$rad=mysqli_fetch_array($sqlsvar);
				$id=$rad["id"];
				$fag=$rad["fag_id"];
				$navn=$rad["navn"];
				print("
					<div class='col-md-6 col-sm-6  search-result'>
						<div class='well well-lg'>
							<ul class='meta-search'>
								<li><h3><i class='glyphicon glyphicon-folder-open'></i> $navn</h3></a></li>
								<a href='admin-pw.php?id=$id' class='btn btn-primary'>Endre</a>
							</ul>
						</div>
					</div>
					");
			}
		}
		else{
			print("
			<div class='alert alert-info' role='alert'>
			Ingen registrerte powerpoints i valgt fag.</br>
			Gå tilbake med knapper under.</br>
			<a href='admin-pw.php' class='btn btn-primary'>Powerpoints</a>
			</div>
			
			");
		}
		
	}
	else{
		print("
		<div class='page-header'>
			<h1>Registrerte powerpoints</h1>
		</div>
		<h3>Fag</h3>
		");
		$sql="SELECT id, navn, fagkode FROM aulesjord2.fag group by navn;";
		$sqlsvar=mysqli_query($db,$sql);
		$antallsqlsvar=mysqli_num_rows($sqlsvar);
		for($r=1;$r<=$antallsqlsvar;$r++)
		{
			$rad=mysqli_fetch_array($sqlsvar);
			$id=$rad["id"];
			$navn=$rad["navn"];
			$fagkode=$rad["fagkode"];
			print("
				<div class='col-md-6 col-sm-6  search-result'>
					<div class='well well-lg'>
						<ul class='meta-search'>
							<li><h3><i class='glyphicon glyphicon-folder-open'></i> $fagkode, $navn</h3></li>
							<a href='admin-pw.php?fag=$id' class='btn btn-primary'>Finn powerpoints</a>
						</ul>
					</div>
				</div>
				");
		}
	}
print("</div></div>");
}
?>
<?php
include 'slutt.php';
?>
