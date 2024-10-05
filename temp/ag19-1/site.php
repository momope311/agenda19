<!doctype html>
<html lang='{#html_lang#}'>
<head>
	<meta charset='utf-8'>
	<meta name='description' content='{#meta_desc#}'>
	<meta name='keywords' content='{#meta_keys#}'>
	<meta name='author' content='{#meta_auth#}'>
	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
	{#favicon#}
	<title>{#title#}</title>
	<script type='text/javascript'>
		function Dropd() {
			var x = document.getElementById('links');
			if (x.style.display === 'block') {
				x.style.display = 'none';
			} else {
				x.style.display = 'block';
			}
		} 
	</script>
	{#basecss#}
	<style>
		/* Navigacija Top */
		#nav-wrap {
			background-color: #2c3e50;
			width: 100%;
			position: fixed;
			top: 0;
			left: 0;
			z-index: 1000;
		}
		#navigation {
			display: flex;
			justify-content: center;
			align-items: center;
			max-width: 1000px;
			margin: 0 auto;
			padding: 14px 30px;
			min-height: 60px;
		}
		#left-menu, #right-menu {
			display: flex;
			align-items: center;
		}
		#left-menu {
			margin-right: auto;
		}
		#right-menu {
			margin-left: auto;
		}
		#navigation ul {
			list-style-type: none;
		}
		#navigation ul li {
			display: inline-flex;
			position: relative;
			padding-left: 20px;
			padding-right: 20px;
		}
		#navigation ul li a {
			color: white;
			text-decoration: none;
			font-size: 20px;
		}
		ul#left-menu li a {
			font-size: 26px;
			font-weight: 400;
		}
		#navigation ul li a:hover {
			color: #18aebc;
		}
		.dropdown-menu {
			display: none;
			position: absolute;
			top: 100%;
			left: 50%;
			transform: translateX(-50%);
			background-color: #34495e;
			min-width: 160px;
			box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}
		.dropdown-menu li {
			display: flex;
			justify-content: center;
			padding: 10px 0;
		}
		.dropdown-menu li a {
			color: white;
			font-size: 18px !important;
			padding: 5px 20px;
			display: block;
			white-space: nowrap;
			text-align: left;
			margin-left: -60px;
		}
		.dropdown:hover .dropdown-menu {
			display: block;
			color: #18aebc;
		}
		.dropdown-menu li a:hover {
			color: #18aebc;
		}
		.mobnav {
			display: none;
		}

		/* Front Slika*/
		#front {
			background-color: #18aebc;
			min-height: 300px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			color: white;
			text-align: center;
			padding: 30px 20px;
		}
		#front h1 {
			font-size: 46px;
			padding-left: 10px;
			padding-right: 10px;
		}
		.white-line {
			display: inline-block;
			border-bottom: 4px solid white;
			padding-bottom: 10px;
		}
		#front h2 {
			font-size: 24px;
			font-weight: 100;
			margin-top: -20px;
		}
		#front img {
			margin: 30px;
			max-width: 540px;
			width: 80%;
			border-radius: 0 0 60px 60px;
			box-shadow: 8px 10px 20px rgba(0, 0, 0, 0.5);
		}
		@media screen and (max-width: 940px) {
			#navigation {
				display: none;
			}
			.mobnav {
				display: block;
				justify-content: center;
				align-items: center;
				overflow: hidden;
				min-height: 60px;
				position: relative;
				padding: 14px 30px;
				margin: 0 auto;
			}
			.mobnav #links {
			  	display: none;
			}
			.mobnav a {
				color: white;
				padding: 14px 30px;
				text-decoration: none;
				font-size: 18px;
				display: block;
			}
			.mobnav a.lang {
				margin-left: 20px;
			}
			.logo {
				background-color: #2c3e50;
				color: white;
				font-size: 26px !important;
				font-weight: 400;
				margin-right: auto;
				margin-left: -20px;
				margin-top: 2px;
			}
			.mobnav a.icon {
				display: block;
				position: absolute;
				right: 0;
				top: 14px;
				font-size: 26px !important;
			}
			.mobnav a:hover {
			  	color: #18aebc;
			}

			#front img {
				margin: 20px;
				border-radius: 0 0 40px 40px;
			}
		}
		@media screen and (max-width: 700px) {
			#front img {
				border-radius: 0 0 20px 20px;
			}
			#front h2 {
				font-size: 20px;
				padding-left: 10px;
				padding-right: 10px;
				font-weight: 400;
			}
		}
		@media screen and (max-width: 380px) {
			#front h1 {
				font-size: 40px;
			}
		}
	</style>
</head>
<body>
{#body#}
</body>
</html>