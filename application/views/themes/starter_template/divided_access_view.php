<?php
/*
 * This file is the view of default controller
 *
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ru"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="./public/image/favicon.ico">
	
	<!-- Bootstrap 3 is the most popular HTML, CSS, and JS framework -->
	<!-- Bootstrap core CSS -->
	<link href="/public/vendor/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="/public/vendor/bootstrap-3.3.7/ie10-viewport-bug-workaround.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="/public/vendor/bootstrap-3.3.7/starter-template.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
  <link href="/public/vendor/bootstrap-3.3.7/signin.css" rel="stylesheet">
		
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="/public/vendor/bootstrap-3.3.7/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="/public/vendor/bootstrap-3.3.7/ie-emulation-modes-warning.js"></script>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- ./Bootstrap 3 is the most popular HTML, CSS, and JS framework -->
	
	<!-- styles -->
  <!--<link href="/public/css/styles.css" rel="stylesheet">-->
	
	
	<link href="/public/vendor/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
	<link href="/public/css/own_css.css" rel="stylesheet">
	
	<title><?php echo $title; ?></title>
	
	</head>

	<body>
		
		<?php echo $content; ?>

		<footer class="footer">
      <div class="container">
        <div class="col-md-10 col-md-offset-1">
					<p class="text-muted text-right small"><span class="small">Code licensed under <a class="mit_a" href="https://en.wikipedia.org/wiki/MIT_License" target="_blank">MIT</a>,<br>documentation under <a href="http://creativecommons.org/licenses/by/3.0/" target="_blank">CC BY 3.0</a></span>.<br><span class="small">&nbsp;&copy;&nbsp;numbrCode,&nbsp;&nbsp;2017&nbsp;&nbsp;<a href="http://www.yoursite.com" title="Переход на сайт программиста и дизайнера этого сайта - numbrCode: www.yoursite.com." target="_blank">www.yoursite.com</a>.</span></p>
				</div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/public/vendor/jquery-1.12.4/jquery.min.js"><\/script>')</script>
    <script src="/public/vendor/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/public/vendor/bootstrap-3.3.7/ie10-viewport-bug-workaround.js"></script>
		<!-- ./Bootstrap core JavaScript -->
		 
		<script src="/public/vendor/jquery-ui-1.12.1/jquery-ui.js"></script>
		 
		<!-- Own-jQuery for their own needs -->
		<script src="/public/js/own_jquery.js" charset="UTF-8">></script>

</body>
</html>
