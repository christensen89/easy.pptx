<form method="get" class="form-horizontal">
  <div class="form-group">
      <label for="sel1" class="control-label col-xs-2">Powerpoint</label>
      <div class="col-xs-5">
        <select class="form-control" id="powerpointid" name="powerpointid">
		<?php include 'script/pwselectfraget.php';?>
          <?php include("script/pwselect.php");?>
        </select>
      </div>
  </div>
   <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
          <input type='submit' class="btn btn-primary" value='Hent slides' name='registrerslide' id='registrerslide'/>
    </div>
  </div>
</form>