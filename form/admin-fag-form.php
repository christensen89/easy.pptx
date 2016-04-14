<form method="post" class="form-horizontal">
    <div class="form-group">
        <label for="inputText" class="control-label col-xs-2">Fagnavn</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" id="fagnavn" name="fagnavn" placeholder="Fagnavn" autocomplete="off">
        </div>
    </div>
    <div class="form-group">
        <label for="inputText" class="control-label col-xs-2">Fagkode</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" id="fagkode" name="fagkode" placeholder="Fagkode" autocomplete="off">
        </div>
    </div>
    <div class="form-group">
        <label for="sel1" class="control-label col-xs-2">Lærer</label>
        <div class="col-xs-5">
          <select class="form-control" id="laerer" name="laerer">
            <option>Velg registrert lærer</option>
            <?php include("script/laererselect.php");?>
          </select>
        </div>
    </div>
    <div class="form-group">
        <label for="sel1" class="control-label col-xs-2">Periode</label>
        <div class="col-xs-5">
          <select class="form-control" id="periode" name="periode">
            <option>Velg periode</option>
            <?php include("script/periodeselect.php");?>
          </select>
        </div>
    </div>


    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <input type='submit' class="btn btn-primary" value='Registrer fag' name='registrerfag' id='registrerfag'/>
			<input type='reset' class="btn btn-primary" value='Nullstill' name='nullstill' id='nullstill'/>
        </div>
    </div>
</form>