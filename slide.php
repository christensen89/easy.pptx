<?php
include 'start.php';
?>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"><?php @$pw=$_GET["id"];
if($pw)
{
	include 'script/db-tilkobling.php';
	$sql="SELECT navn FROM aulesjord2.`powerpoint` where id=$pw;";
	$sqlsvar=mysqli_query($db,$sql)or die("Får ikke hentet slide.");
	while($rad = mysqli_fetch_assoc($sqlsvar)) {
        $navn=$rad["navn"];
		print("$navn");
	}
}
?></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <ol class="indicator"></ol>
</div>
<div id="links">
<div class="container">
<div class="row">
<?php
@$pw=$_GET["id"];
if($pw)
{
	include 'script/db-tilkobling.php';
	$sql="SELECT pw.link, pw.slidenr, p.filbane, p.id FROM aulesjord2.`pw-slide` pw join powerpoint p on p.id=pw.powerpoint_id where p.id=$pw;";
	$sqlsvar=mysqli_query($db,$sql)or die("Får ikke hentet slide.");
	$rad=mysqli_fetch_array($sqlsvar);
	$filbane=$rad["filbane"];
	$powerpointdl=glob("$filbane*.{pptx,ppt}", GLOB_BRACE);
	$pwnavn=substr($powerpointdl[0],strlen($filbane));
	print("
		<div class='page-header'><a href='$powerpointdl[0]' class='btn btn-success text-center'>Last ned $pwnavn</a></div>
	");
	mysqli_data_seek($sqlsvar,0);
	while($r=mysqli_fetch_array($sqlsvar)){
		$filbane=$r["filbane"];
		$link=$r["link"];
		print("
				<div class='col-sm-4 col-xs-6 col-md-3 col-lg-2'>
					<div class='well well-sm'>
						<a href='$filbane$link' data-gallery>
						<img src='$filbane$link' class='img-responsive inline-block'>
						</a>
					</div>
				</div>
		");
	}
}

?>
</div>
</div>
</div>
<?php
include 'slutt.php';
?>
