<?php
  include("form/admin-pw-slide-form.php");
  @$registrerknapp=$_POST["registrerknapp"];
  if($registrerknapp)
  {
    $link=$_POST["link"];
    $innhold=$_POST["innhold"];
    $tags=$_POST["tags"];
    $notater=$_POST["notater"];
    $powerpoint=$_POST["powerpoint"];
    $overskrift=$_POST["overskrift"];

    if(!$link||!$innhold||!$tags||!$powerpoint||!$overskrift)
    {
      print("alle felter untatt notater må fylles ut");
    }
    else
    {
      include("db-tilkobling.php");
      $sql="INSERT INTO `aulesjord2`.`pw-slide` (`link`, `innhold`, `tags`, `notater`, `powerpoint_id`, `overskrifter`) VALUES ('$link', '$innhold', '$tags', '$notater', '$powerpoint', '$overskrift');";
      mysqli_query($db,$sql) or die("Kunne ikke registrere i db.<br/>$sql");
    }
  }
?>
