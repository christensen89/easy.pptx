<?php
$dagensdato=date;
$sokchecksql="select * from search where sokeord='$sokeord';";
$sokcheck=mysqli_query($db,$sokchecksql);
$dagensKlokkeslett=date("H:i");
$dagensDato=date("j");
$maaned=array("","Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember");
$dagensMndnr=date("n");
$dagensMndnavn=$maaned[$dagensMndnr];
$date="$dagensKlokkeslett, $dagensDato $dagensMndnavn";
if(mysqli_num_rows($sokcheck) > 0)
{
	$svar=mysqli_fetch_assoc($sokcheck);
	$antallfradb=$svar["antall"];
	$nyttantall=$antallfradb+1;
	$soksql="UPDATE `aulesjord2`.`search` SET `antall`='$nyttantall', `treff`='$antall', `date`='$date'  WHERE `sokeord`='$sokeord';";

	mysqli_query($db,$soksql);
	
}
else{
	
	$soksql="INSERT INTO `aulesjord2`.`search` (`sokeord`, `antall`, `date`, `treff`) VALUES ('$sokeord', 1, '$date', '$antall');";
	mysqli_query($db,$soksql);
}

?>