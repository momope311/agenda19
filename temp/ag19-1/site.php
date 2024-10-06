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

		function scrollToAnchor() {
    		window.location.hash = '#content';
		}
	</script>
	{#basecss#}
</head>
<body>
{#body#}
</body>
</html>