<?php
include 'start.php';
?>

<?php
@$pw=$_GET["id"];
if($pw)
{
	$slide=$_GET["slide"];
	$slidened=$slide-1;
	$slideopp=$slide+1;
	$ned="";
	$opp="";
	if($slide=='15')
	{
		$opp=" disabled";
	}
	if($slide=='1')
	{
		$ned=" disabled";
	}
	$sql="SELECT pw.link, pw.slidenr, p.filbane, p.id FROM aulesjord2.`pw-slide` pw join powerpoint p on p.id=pw.powerpoint_id where p.id=$pw and pw.slidenr=$slide";
	$sqlsvar=mysqli_query($db,$sql);
	$rad=mysql_fetch_array($sqlsvar);
	$filbane=$rad["filbane"];
	$link=$rad["link"];
	print("<img href='$filbane$link'");
	echo"
<nav class='text-center'>
	<ul class='pagination'>
		<li><a href='slidetest.php?id=$pw&slide=1' class='btn$ned'><i class='glyphicon glyphicon-fast-backward'></i></a></li>
		<li><a href='slidetest.php?id=$pw&slide=" . $slidened ."' class='btn$ned'><i class='glyphicon glyphicon-backward'></i></a></li>
		<li><a href='slidetest.php?id=$pw&slide=" . $slideopp . "' class='btn$opp'><i class='glyphicon glyphicon-forward'></i></a></li>
		<li><a href='slidetest.php?id=$pw&slide=15' class='btn$opp'><i class='glyphicon glyphicon-fast-forward'></i></a></li>
	</ul>
</nav>
</div>
";

	
}
?>
<?php
include 'slutt.php';
?>

