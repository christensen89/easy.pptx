<?php
  include("script/db-tilkobling.php");
  $sql="SELECT * FROM laerer ORDER BY id;";
  $sqlresultat=mysqli_query($db,$sql) or die("kan ikke hente fra db!<br/>$sql");
  $tellrader=mysqli_num_rows($sqlresultat);

  for($r=1;$r<=$tellrader;$r++)
  {
    $rad=mysqli_fetch_array($sqlresultat);
    $id=$rad["id"];
    $fornavn=$rad["fornavn"];
    $etternavn=$rad["etternavn"];

    
    print("<option value='$id'>$fornavn, $etternavn</option>");
  }
?>
