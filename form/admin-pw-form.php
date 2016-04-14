<div class="container">
<div class='page-header'>
			<h1>Legg til en ny powerpoint</h1>
		</div>
<form method="post" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Navn på powerpoint</label>
        <div class="col-xs-5">
          <input type='text' autocomplete="off" placeholder='Navn' name='navn' id='navn' required class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label for="inputEmail" class="control-label col-xs-2">Antall slides</label>
        <div class="col-xs-5">
          <input type='text' autocomplete="off" placeholder='Antall slides' name='antallslides' id='antallslides' required class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="sel1" class="control-label col-xs-2">Fag</label>
        <div class="col-xs-5">
          <select class="form-control" id="fag" name="fag">
            <option>Velg Fag</option>
            <?php include("script/fagselect.php");?>
          </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
          <input type='submit' class="btn btn-primary" value='Registrer powerpoint' name='registrerknapp' id='registrerknapp'/>
          <input type='reset' class="btn btn-primary" value='Nullstill' name='nullstillknapp' id='nullstillknapp'/>
        </div>
    </div>
</form>
</div>
