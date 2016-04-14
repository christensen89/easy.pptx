<?php
include 'start.php';
?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    Kontakt oss <small>Ikke nøl med og melde om feil eller mangler</small></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Navn</label>
                            <input type="text" class="form-control" id="name" name="navn" placeholder="Navn" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                E-post adresse</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-post" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Hva gjelder det?</label>
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option value="na" selected="">Velg 1:</option>
                                <option value="Feil i powerpoint">Feil i powerpoint</option>
                                <option value="Feil informasjon om foreleser">Feil informasjon om foreleser</option>
                                <option value="Feil på webside">Feil på webside</option>
                                <option value="Rettigheter">Rettigheter</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Melding</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Skriv melding her"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary pull-right" name="sendtilbakemelding" value="Send melding">
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Gruppe 10, IS-INT1000</legend>
            <address>
                <strong>Gruppe 10</strong><br>
                Høyskolen i Sør-øst Norge<br>
                Horten, Vestfold, Norge<br>
            </address>
            <address>
                <strong>Vår E-post:</strong><br>
                <a href="mailto:#">admin@aluesjord.net</a>
            </address>
            </form>
        </div>
    </div>
</div>
<?php
@$fortsett=$_POST["sendtilbakemelding"];
if($fortsett)
{
	$navn=$_POST["navn"];
	$epost=$_POST["email"];
	$melding=$_POST["message"];
	$subject=$_POST["subject"];
	$tekst="
	<b>Navn:</b> $navn</br>
	<b>Epost:</b> $epost</br>
	<b>Gjelder:</b> $subject</br>
	$melding";
	$sql="INSERT INTO `aulesjord2`.`message` (`tekst`, `user_id`, `type_id`, `dato`, `sett`) VALUES ('$tekst', 19, 2, now(), 'nei');";
	mysqli_query($db,$sql)or die("Feil");
	print("<div class='container'>
	<h4>Melding sendt!</h4>
	<div class='alert alert-success' role='alert'>
	$tekst
	</div>
	</div>
	");
}
?>

<?php
include 'slutt.php';
?>
