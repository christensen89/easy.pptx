<?php
	print
	("
		<form method='post' name='laererform' id='laererform'>
			<input type='text' placeholder='Lærer ID' name='laererid' id='laererid' required/><br/>
			<input type='text' placeholder='Fornavn' name='fornavn' id='fornavn' required/><br/>
			<input type='text' placeholder='Etternavn' name='etternavn' id='etternavn' required/><br/>
			<input type='text' placeholder='Stilling' name='stilling' id='stilling' required/><br/>
			<input type='epost' placeholder='e-Post' name='epost' id='epost' required/><br/>
			<input type='submit' value='Registrer lærer' name='registrerlærer' id='registrerlærer'/>
			<input type='reset' value='Nullstill' name='nullstill' id='nullstill'/>
		</form>
	");
	@$registrerlærer=$_POST["registrerlærer"];
	if($registrerlærer)
	{
		if(!filter_var($_POST['epost'],FILTER_VALIDATE_EMAIL))
		{
			print("Det er noe feil her. Har du kontrollert at du har skrevet riktig?");
			return false;
		}
		else
		{
			print("Gyldig epost angitt!");
			return true;
		}
	}
?>
