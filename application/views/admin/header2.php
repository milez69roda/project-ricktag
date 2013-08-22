<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<base href="<?php echo base_url(); ?>" />	
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="static/admin/css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="static/admin/css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="static/admin/css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="static/admin/css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="static/admin/css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="static/admin/css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	
	<!--<script type="text/javascript" src="static/admin/js/jquery.js"></script>
	<script type="text/javascript" src="static/admin/js/switcher.js"></script>
	<script type="text/javascript" src="static/admin/js/toggle.js"></script>
	<script type="text/javascript" src="static/admin/js/ui.core.js"></script>
	<script type="text/javascript" src="static/admin/js/ui.tabs.js"></script>-->
	
	<link rel="stylesheet" type="text/css" href="static/jquery-ui-themes/custom-theme/jquery-ui-1.8.23.custom.css" />
	
	<!--<script type="text/javascript" src="static/js/jquery-1.7.2.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="static/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>	
	<script src="static/js/ajaxupload.js"></script>  	
	
	<script type="text/javascript" src="static/admin/js/admin.js"></script>
	<script type="text/javascript" src="static/admin/js/toggle.js"></script>
	<script type="text/javascript" src="static/admin/js/switcher.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		//$(".tabs > ul").tabs();
	});
	</script>
	<title>Ricktag Admin</title>
</head>

<body>

<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="static/admin/design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="static/admin/design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>
 

		</p>

		<p class="f-right">User: <strong><a href="#">Administrator</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="#" id="logout">Log out</a></strong></p>

	</div> <!--  /tray -->

	<hr class="noscreen" /> 

	<hr class="noscreen" />
	

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="<?php echo base_url(); ?>"><img src="static/midas/images/logo.png" alt="Our logo" title="Visit Site" /></a></p>
 
			</div> <!-- /padding -->

			<ul class="box">
 
				<li id="submenu-active"><a href="javascript:void(0)">Manage</a> <!-- Active -->
					<ul>
						<li><a href="admin/cities">Cities</a></li>
						<!--<li><a href="admin/business">Business in cities</a></li>-->
						<li><a href="admin/businessmanager">Distributor Manager</a></li>
						<li><a href="admin/cardmanager">Card Manager</a></li>
						<li><a href="admin/storemanager">Store Manager</a></li>
						<li><a href="admin/cardholders">Card Holders Manager</a></li>
						<li><a href="admin/operators">Operators Manager</a></li>
						
						 
					</ul>
				</li>
				 
			</ul>

		</div> <!-- /aside -->

		<hr class="noscreen" />	