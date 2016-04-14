<?php
  include("db-tilkobling.php");
  $sql="select f.id, f.fagkode, p.ar, p.termin from fag f inner join periode p on p.id=f.periode_id order by f.fagkode;";
  $sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente fra db<br/>$sql");
  $tellrader=mysqli_num_rows($sqlresultat);

  for($r=1;$r<=$tellrader;$r++)
  {
    $rad=mysqli_fetch_array($sqlresultat);
    $id=$rad["id"];
    $fagkode=$rad["fagkode"];
    $termin=$rad["termin"];
    $ar=$rad["ar"];

    print("<option value='$id'>$fagkode, $termin, $ar</option>");
  }
?>
