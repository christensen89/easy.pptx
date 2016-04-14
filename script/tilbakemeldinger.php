<?php
$sql="SELECT * FROM aulesjord2.message where user_id=$id order by id desc;";
$svar=mysqli_query($db,$sql);
$antall=mysqli_num_rows($svar);
if($antall>=1)
{
	print("
	<div class='page-header'>
	<h4>Dine tilbakemeldinger</h4>
	</div>
	");
	for($r=1;$r<=$antall;$r++)
	{
		$rad=mysqli_fetch_array($svar);
		$id=$rad["id"];
		$tekst=$rad["tekst"];
		$dato=$rad["dato"];
		print("
		<div class='alert alert-info' role='alert'>
		<b>$dato</b></br>
		$tekst</br>
		<form method='post'>
		<button type='submit' class='btn btn-danger' name='sletttilbakemelding[]' value='$id'>Slett</button>
		</form>
		</div>");
	}
	@$sletttilbakemelding=$_POST["sletttilbakemelding"];
	if($sletttilbakemelding)
	{
		foreach($sletttilbakemelding as $id)
		{
			$sql="DELETE FROM `aulesjord2`.`message` WHERE `id`='$id';";
			mysqli_query($db,$sql);
			echo"<script>window.open('admin.php', '_self')</script>";
		}
		
	}
}




?>