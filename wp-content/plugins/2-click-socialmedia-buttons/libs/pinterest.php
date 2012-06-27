<?php
if(!empty($_REQUEST['pinterest-url']) && !empty($_REQUEST['pinterest-description'])) {
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<style type="text/css">
			html, body {margin:0; padding:0; width:auto;}
			</style>
		</head>
		<body>
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurldecode(strip_tags($_REQUEST['pinterest-url'])); ?>&media=<?php echo $_REQUEST['pinterest-media']; ?>&description=<?php echo $_REQUEST['pinterest-description']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
			<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
		</body>
	</html>
	<?php
}
?>