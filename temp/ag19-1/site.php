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
	{#basecss#}
	<style>
		#nav-wrap {
			background-color: #2c3e50;
			width: 100%;
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
			padding-left: 20px;
			padding-right: 20px;
		}
		#navigation ul li a {
			color: white;
			text-decoration: none;
			font-size: 20px;
		}

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