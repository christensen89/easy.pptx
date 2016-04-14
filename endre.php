<?php
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
<?php
@$fra=$_GET["f"];
if($fra=="p") //Fra p = fra Powerpoint
{
	@$id=$_GET["id"];
	if($id){
		include 'script/db-tilkobling.php';
		$sql="SELECT p.id, p.navn, p.antallslides, fag.fagkode, fag.id as fagid, periode.termin, periode.ar FROM powerpoint p join fag fag on fag.id=p.fag_id join periode on periode.id=fag.periode_id where p.id=$id order by fagkode;";
		$svar=mysqli_query($db,$sql);
		while($rad=mysqli_fetch_array($svar)){
			$id=$rad["id"];
			$navn=$rad["navn"];
			$antallslides=$rad["antallslides"];
			$fagkode=$rad["fagkode"];
			$fagid=$rad["fagid"];
			$termin=$rad["termin"];
			$ar=$rad["ar"];
			echo "
			<div class='container'>
			<div class='page-header'>
						<h1>Endre $navn</h1>
					</div>
				<div class='alert alert-info' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				Du kan <b>ikke</b> slette navn eller tilhørende fag.</br>
				Dette er fordi det vil ødelegge mappestrukturen til tilhørende filer.</br>
				Slett heller powerpointen og begynn på nytt!
				</div>
				
			<form method='post' class='form-horizontal'>
				<div class='form-group'>
					<label class='control-label col-xs-2'>Navn på powerpoint</label>
					<div class='col-xs-5'>
					  <input type='text' autocomplete='off' placeholder='Navn' name='navn' id='navn' required class='form-control' value='$navn' disabled>
					</div>
				</div>
				<div class='form-group'>
					<label class='control-label col-xs-2'>Antall slides</label>
					<div class='col-xs-5'>
					  <input type='text' autocomplete='off' placeholder='Antall slides' name='antallslides' id='antallslides' required class='form-control' value='$antallslides'>
					</div>
				</div>
				<div class='form-group'>
					<label class='control-label col-xs-2'>Fag</label>
					<div class='col-xs-5'>
						<select class='form-control' id='fag' name='fag'>
							<option value='$fagid'>$fagkode, $termin, $ar</option>
						</select>
					</div>
				</div>
				<div class='form-group'>
					<div class='col-xs-offset-2 col-xs-10'>
					  <input type='submit' class='btn btn-primary' value='Endre powerpoint' name='fortsett' id='fortsett'/>
					  <input type='reset' class='btn btn-primary' value='Nullstill' name='nullstillknapp' id='nullstillknapp'/>
					</div>
				</div>
			</form>
			</div>
			";
		}
	}
	else{
		echo"<script>window.open('index.php', '_self')</script>";
	}
	@$fortsett=$_POST["fortsett"];
	if($fortsett)
	{
		$antallslides=$_POST["antallslides"];
		$sql="UPDATE `aulesjord2`.`powerpoint` SET `antallslides`='$antallslides' WHERE `id`='$id';";
		mysqli_query($db,$sql) or die("Får ikke slettet $id");
		echo"<script>window.open('admin-endre-pw.php?endre=$navn', '_self')</script>";
		
		
	}
}
?>
<?php
include 'slutt.php';
?>


