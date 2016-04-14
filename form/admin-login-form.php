<div class="container">
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Logg inn</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="post" id="admin-login">
                    <fieldset>
			    	  	<div class="form-group">
							<input type="text" id="user" name="user" autocomplete="off" placeholder="Brukernavn" class="form-control">
			    		</div>
			    		<div class="form-group">
							<input type="password" id="pw" name="pw" placeholder="Passord" class="form-control">
			    		</div>
			    		<input type="submit" id="admin-login" name="admin-login" value="Logg inn" class="btn btn-lg btn-success btn-block">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
<?php include 'script/script-admin-login.php';?>