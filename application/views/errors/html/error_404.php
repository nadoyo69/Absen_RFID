<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>404 Page Not Found || Nadoyo</title>
	<link rel="shortcut icon" href="https://1.bp.blogspot.com/-xWVC3MXvwUE/XFXE37mJcdI/AAAAAAAAAyg/MlzhceJYWbQr-eaiXCfrS9JrNnDp5EeJQCEwYBhgL/s1600/logoatas.png">
	<style type="text/css">
		* {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
		}

		body {
			padding: 0;
			margin: 0;
		}

		#notfound {
			position: relative;
			height: 100vh;
			background: #030005;
		}

		#notfound .notfound {
			position: absolute;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.notfound {
			max-width: 767px;
			width: 100%;
			line-height: 1.4;
			text-align: center;
		}

		.notfound .notfound-404 {
			position: relative;
			height: 180px;
			margin-bottom: 20px;
			z-index: -1;
		}

		.notfound .notfound-404 h1 {
			font-family: 'Montserrat', sans-serif;
			position: absolute;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			font-size: 224px;
			font-weight: 900;
			margin-top: 0px;
			margin-bottom: 0px;
			margin-left: -12px;
			color: #030005;
			text-transform: uppercase;
			text-shadow: -1px -1px 0px #8400ff, 1px 1px 0px #17a2b8;
			letter-spacing: -20px;
		}


		.notfound .notfound-404 h2 {
			font-family: 'Montserrat', sans-serif;
			position: absolute;
			left: 0;
			right: 0;
			top: 110px;
			font-size: 42px;
			font-weight: 700;
			color: #fff;
			text-transform: uppercase;
			text-shadow: 0px 2px 0px #8400ff;
			letter-spacing: 13px;
			margin: 0;
		}

		.notfound input {
			font-family: 'Montserrat', sans-serif;
			display: inline-block;
			text-transform: uppercase;
			color: #17a2b8;
			text-decoration: none;
			border: 2px solid;
			background: transparent;
			padding: 10px 40px;
			font-size: 14px;
			font-weight: 700;
			-webkit-transition: 0.2s all;
			transition: 0.2s all;
		}

		.notfound input:hover {
			color: #8400ff;
		}

		@media only screen and (max-width: 767px) {
			.notfound .notfound-404 h2 {
				font-size: 24px;
			}
		}

		@media only screen and (max-width: 480px) {
			.notfound .notfound-404 h1 {
				font-size: 182px;
			}
		}
	</style>
</head>

<body>

	<div id="container">
		<div id="notfound">
			<div class="notfound">
				<div class="notfound-404">
					<h1>404</h1>
				</div>
				<input type="button" value="Halaman Yang Anda Cari Tidak Ada" onclick="history.back(-1)" />
			</div>
		</div>
	</div>
</body>

</html>