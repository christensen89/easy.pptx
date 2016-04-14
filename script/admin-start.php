<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
	<div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-elearning-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img style="max-width:100px; margin-top: -7px;" src="images/logoxs.png" alt="logo"></a>
	</div>
    <div class="collapse navbar-collapse navbar-right" id="bs-elearning-navbar-collapse-1">
          <ul class="nav navbar-nav">
          <li><a href="index.php">Hjem</a></li>
          <li><a href="vis-laerere.php">Forelesere</a></li>
          <li><a href="vis-fag.php">Fag</a></li>
          <li><a href="semester.php">Semester</a></li>
          <li><a href="powerpoints.php">Powerpoints</a></li>
          <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Annet <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="omoss.php">Om oss</a></li>
          <li><a href="kontakt.php">Kontakt</a></li>
          <li class="divider"></li>
          <li><a href="#">Notater</a></li>
        </ul>
      </li>
          <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php include 'script/brukernavn.php';?><b class="caret"></b></a>
        <ul class="dropdown-menu">
			<li class="dropdown-header"><strong>Registrer</strong></li>
          <li><a href="admin-pw.php">Powerpoint</a></li>
          <li><a href="admin-laerer.php">Foreleser</a></li>
          <li><a href="admin-fag.php">Fag</a></li>
          <li><a href="admin-bruker.php">Brukere</a></li>
          <li class="divider"></li>
		  <li class="dropdown-header"><strong>Administrer</strong></li>
          <li><a href="admin.php">Admin panel</a></li>
		  <?php
		  if($_SESSION['brukertype']=='Administrator'){
			echo "<li><a href='tilbakemeldinger.php'>Tilbakemeldinger</a></li>";
		  }
		  ?>
		  <li class="divider"></li>
		  <li class="dropdown-header"><strong>Gjør endringer</strong></li>
          <li><a href="admin-endre-pw.php">Powerpoint</a></li>
		  <li class="divider"></li>
		  <li class="dropdown-header"><strong>Bruker</strong></li>
		  <li><a href='script/logut.php'><span class='glyphicon glyphicon-log-out'></span> Logg ut</a></li>
		</ul>
      </li>
    </ul>
    </div>
  </div>
</nav>
