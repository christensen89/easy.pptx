<div class="container">
<div class="page-header">
<h3>
<?php
$brukernavn=$_SESSION['bruker'];
$brukernavn=ucfirst($brukernavn);
print("Velkommen $brukernavn!");
?>
</h3>
</div>
<?php
	$id=$_SESSION["id"];
	$login=$_SESSION["sidensist"];
	if($login)
	{
		$aar=substr($login,0,4);
		$dag=substr($login,8,2);
		$mnd=substr($login,5,2);
		$time=substr($login,11,2);
		$minutt=substr($login,14,2);
		$sekund=substr($login,17,2);
		$sidensist=mktime($time,$minutt,$sekund,$mnd,$dag,$aar);
		$ukedag=array("","Mandag","Tirsdag","Onsdag","Torsdag","Fredag","Lørdag","Søndag");
		$maaned=array("","Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember");
		$mndnr=date("n", $sidensist);
		$mndnavn=$maaned[$mndnr];
		$ukedagnr=date("N", $sidensist);
		$ukedagnavn=$ukedag[$ukedagnr];
		$klokka=date("H:i:s", $sidensist);
		$dag=date("d", $sidensist);
		print("<div class='alert alert-info alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		");
		echo "Du var sist logget inn: <b>".$ukedagnavn . " " . $dag . " " . $mndnavn . ", klokken " .$klokka ."</b></div>";
	}
	else{
		print("<div class='alert alert-warning alert-dismissible' role='alert'>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		Velkommen til <b>EasyPPT </b> sin nettside, $brukernavn!</br>
		I høyre hjørne ser du dine valg. Her kan du bla. legge inn nye powerpoints!
		</div>");
	}
	$brukertype=$_SESSION['brukertype'];
	print("
		<div class='alert alert-info alert-dismissible' role='alert'>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		Din brukerkonto tilhører brukergruppen: <b>$brukertype</b>
		</div>
		");
		
		print("
		<div class='page-header' id='toggle'>
			<h3>Gi oss en tilbakemelding </h3>
		</div>
		<div id='content'>
		<form method='post' class='form-controll'>
			<div class='form-group'>
				<textarea  name='tekst' autocomplete='off' placeholder='Din tilbakemelding' class='form-control'></textarea>
			</div>
			<div class='form-group'>
				<input type='submit' class='btn btn-primary' name='sendtilbakemelding' value='Send tilbakemelding'>
			</div>
		</form>
		</div>
	");
	@$tilbakemelding=$_POST["sendtilbakemelding"];
	if($tilbakemelding)
	{
		$tekst=$_POST["tekst"];
		$sql="INSERT INTO `aulesjord2`.`message` (`tekst`, `user_id`, `type_id`, `dato`, `sett`) VALUES ('$tekst', $id, 1, now(), 'nei');";
		mysqli_query($db,$sql);
		print("
		<h4>Tilbakemelding sendt!</h4>
		<div class='alert alert-success' role='alert'>
		<b>$brukernavn</b></br>
		$tekst
		</div>");
		
	}
	include 'script/tilbakemeldinger.php';
	include 'script/ufullstendigepw.php';
	
?>
</div>