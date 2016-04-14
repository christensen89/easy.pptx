<div class="footer navbar-fixed-bottom">
		<p class="text-center navbar-inner">
		© <?php include("script/scripttid.php");?> - Side utviket av Gruppe 10 IS-INT1000</br>
		<?php
		@$script="";
		if(isset($_SESSION['bruker'])){
			print("<a href='script/logut.php'><span class='glyphicon glyphicon-log-out'></span> Logg ut</a>");
		}
		else{
			print("<a href='admin.php'><span class='glyphicon glyphicon-log-in'></span> Logg inn</a>");;
		}
		?>
		</p>
</div>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="js/blueimp-gallery-fullscreen.js"></script>
	<script src="js/custom.js"></script>

<script>
document.getElementById('links').getElementsByTagName('a').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event, thumbnailIndicators: true}
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
<?php
@$slide=$_GET["slide"];
if($slide)
{
	print("
	
	blueimp.Gallery(
    document.getElementById('links').getElementsByTagName('a'),
    {
		container: '#blueimp-gallery',
		index: ");echo @$get=$_GET["slide"]-1; print("
    }
);
");
}
?>

</script>
  </body>
</html>
