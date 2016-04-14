<form method="post" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Brukernavn</label>
        <div class="col-xs-5">
			<input type='text' autocomplete="off" placeholder='Brukernavn' name='brukernavn' id='brukernavn' required class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="control-label col-xs-2">Passord</label>
        <div class="col-xs-5">
			<input type='password' autocomplete="off" placeholder='Passord' name='passord' id='passord' required class="form-control">
        </div>
    </div>
      <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Bekreft passord</label>
        <div class="col-xs-5">
			<input type='password' autocomplete="off" placeholder='Bekreft passord' name='passord1' id='passord1' required class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">			
			<input type='submit' class="btn btn-primary" value='Registrer bruker' name='registrerbruker' id='registrerbruker'/>
			<input type='reset' class="btn btn-primary" value='Nullstill' name='nullstill' id='nullstill'/>
        </div>
    </div>
</form>