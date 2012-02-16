<?php
if(!empty($_REQUEST['xing-url'])) {
	?>


	<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        html,
        body {
            margin:0;
            padding:0;
            width:auto;
            /*overflow:hidden;*/
        }
    </style>
    <script src="https://www.xing-share.com/js/external/share.js" type="text/javascript"></script>
</head>
<body>
	<script type="XING/Share" data-counter="right" data-lang="de" data-url="<?php echo $_REQUEST['xing-url']?>"></script>
</body>
</html>


	<?php
}
?>
