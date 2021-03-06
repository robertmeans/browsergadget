<!DOCTYPE html>
<html lang="en">
<!--

	Built with love by EvergreenBob.com

-->
<head>
	<meta charset="UTF-8">	
	
	<title>BroswerGadget | Browser Utility</title>
	<link rel="icon" type="image/ico" href="_images/favicon.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="Stop browsing the Internet like a Neanderthal! Upgrade to a Swiss Army homepage. BrowserGadget is a browser utility that consolidates and organizes projects for private use or to share.">
	<meta name="format-detection" content="telephone=no">

	<meta property="og:url" content="https://www.browsergadget.com/" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="BrowserGadget | Browser Utility" />
	<meta property="og:image" content="https://www.browsergadget.com/_images/browsergadget.jpg" />
	<meta property="og:image:alt" content="BrowserGadget emblem" /> 
	<meta property="og:description" content="Stop browsing the Internet like a Neanderthal! Upgrade to a Swiss Army homepage. BrowserGadget is a browser utility that consolidates and organizes projects for private use or to share." />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css">
  	
	<link href='https://fonts.googleapis.com/css?family=Architects+Daughter|Courier+Prime|Roboto|Special+Elite' rel='stylesheet' type='text/css'>

	<?php if (isset($_SESSION['color']) && $_SESSION['color'] == "2") { // 2 = Spring ?>
		<link rel="stylesheet" href="style-spring.css?<?php echo time(); ?>" type="text/css">
	<?php } else if (isset($_SESSION['color']) && $_SESSION['color'] == "3") { // 3 = Classic ?>
		<link rel="stylesheet" href="style-classic.css?<?php echo time(); ?>" type="text/css">
	<?php } else { // default is Darkmode which is = 1 ?>
		<link rel="stylesheet" href="style.css?<?php echo time(); ?>" type="text/css">
	<?php } ?>

	<script src="scripts/jquery-3.5.1.min.js"></script>
  <script src="scripts/jquery_1-12-1_ui_min.js"></script>
  
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-ER0L96WN41"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-ER0L96WN41');
	</script>
	
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="scripts/preload.js?<?php echo time(); ?>"></script>
</head>