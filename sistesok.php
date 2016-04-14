<h3>Populære søk</h3>
<?php
include 'db-tilkobling.php';
$sql="SELECT * FROM aulesjord2.search order by antall desc limit 8;";
$sqlsvar=mysqli_query($db,$sql);
$antallsqlsvar=mysqli_num_rows($sqlsvar);
for($r=1;$r<=$antallsqlsvar;$r++)
{
	$rad=mysqli_fetch_array($sqlsvar);
	$sokeord=$rad["sokeord"];
	$antall=$rad["antall"];
	$treff=$rad["treff"];
	$date=$rad["date"];
	
	print("
		  <div class='col-md-3 col-sm-6 search-result'>
		<div class='well well-lg'>
		  <ul class='meta-search'>
					<li><a href='search.php?sokeord=$sokeord'><h4>$sokeord</h4></a></li>
					<li><i class='glyphicon glyphicon-transfer'></i> Søkt på $antall ganger</li>
					<li><i class='glyphicon glyphicon-signal'></i>$treff treff</li>
					<li><i class='glyphicon glyphicon-calendar'></i>Sist: $date</li>
				</ul>
		  </p>
        </div>
        </div>
		  
		  
		 ");
}
?>