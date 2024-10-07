<?php
if(!defined('PROTECT')){die('Protected Content!');}

if (USERTYPE == 'gost') {

	header ("Location: " .ROOT.$lett.'/info');
	} else {

	$username = $_SESSION[SITE]['username'];

	$s = '';
	$e = '';
	$comme = '';

	if ($opt2 != '') {
		
		$link = new DB();
		
		if (!isset($_SESSION[SITE][$opt2])) {
			
			$query1 = "UPDATE articles SET pregledi = pregledi + 1 WHERE seo = ?";
			$result1 = $link->UpdateRow($query1, [$opt2]);
		
			$_SESSION[SITE][$opt2] = 1;
		}
		
		$query = "SELECT * FROM articles WHERE seo = ?";
		$result = $link->GetRow($query, [$opt2]);
		
		if ($result) {
			
			if ($result['comments'] == 0) {
				
				$co = "<i class='fas fa-comment-slash ml-3'></i>";
				$coform = '';
			} else {

				$queryc = "SELECT COUNT(*) FROM comments WHERE artid = ? AND pub = 1";
				$resultc = $link->GetRow($queryc, [$result['artid']]);

				$tot = $resultc['COUNT(*)'];

				$co = "<i class='fas fa-comment ml-3 mr-1'></i><b>".$tot."</b>";

				if (isset($_POST['submit'])) {

					$name = $_POST['name'];
					$message = $_POST['message'];

					if (empty($name) AND empty($message)) {

						$e = "<p class='red'>Попуните обавезна поља!</p>";
					} else {
						
						$cdate = date("Y-m-d H:i:s");
						
						$queryu = "INSERT INTO comments(name, comment, artid, cdate, pub) VALUES(?, ?, ?, ?, ?)";
						$resultu = $link->InsertRow($queryu, [$name, $message, $result['artid'], $cdate, 0]);

						$e = "<p class='green'>Коментар је послат на администрацију!</p>";
					}
				}

				$queryco = "SELECT * FROM comments WHERE artid = ? AND pub = 1 ORDER BY comid DESC";
				$resultco = $link->GetRows($queryco, [$result['artid']]);
				
				if ($resultco) {
					
					foreach ($resultco as $rc) {

						$datum = explode(' ', $rc['cdate']);
						$datum1 = explode('-', $datum[0]);
						$datum2 = $datum1[2].'.'.$datum1[1].'.'.$datum1[0];

						$time = $datum[1];

						$comme .=
						"
						<p>Име: <b>$rc[name]</b> | Датум: <b>$datum2</b> | Време: <b>$time</b></p>
						<p>$rc[comment]</p>
						<div class='line'></div>
						";	
					}
				} else {

					$comme = "<p class='red'>Нема коментара!</p>";
				}

				$coform = 
				"
				<br>
				<h2>Унеси коментар</h2>
				<form action='' method='post'>
					Име * :
					<br>
					<input type='text' name='name' maxlength='20' placeholder='Ваше име' value='$username' class='form-control w-25 mt-2 min1' readonly>
					<br>
					<br>
					Порука * :
					<br>
					<textarea class='form-control w-50 mt-2 min1 fonter' name='message' maxlength='200' placeholder='Порука (200 карактера)'></textarea>
					<br>
					<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Пошаљи'>
				</form>
				<br>
				<br>
				<h2>Коментари</h2>
				$comme
				";
			}

			$date = explode('-', $result['datum']);
			$date = $date[2].'.'.$date[1].'.'.$date[0];
			
			$cat = Engine::CatName($result['catid']);

			$catseo = Engine::CatSeo($result['catid']);
			
			$author = Engine::Author($result['authorid']);
			
			$texter = preg_replace(
			    '/<img([^>]*?)alt=["\']{0,1}["\']{0,1}([^>]*?)>/',
			    '<img$1alt="' . htmlspecialchars($result['header'], ENT_QUOTES) . '"$2>',
			    $result['tekst'],
			    1 // Ograničenje na jednu zamenu
			);

			$s .=
			"
			<h2>$result[header]</h2>
			<p><i class='fas fa-calendar-alt ml-3 mr-1'></i><b>$date</b><i class='fas fa-hashtag ml-3 mr-1'></i><a href='".ROOT.$lett."/kategorija/".$catseo."'><b>$cat</b></a><i class='fas fa-at ml-3 mr-1'></i><a href='".ROOT.$lett."/clanci-od-korisnika/".$author."'><b>$author</b></a><i class='far fa-eye ml-3 mr-1'></i><b>$result[pregledi]</b>$co</p>
			$texter
			$coform
			";
		} else {
			
			$s = "<p class='red'>Нема садржаја!</p>";
		}
	} else {
		
		$s = "<p class='red'>Нема садржаја!</p>";
	}

	$cont =
	"
	<section class='page-section mt-5' id='clanak'>
	<div class='container'>
	$s
	$e
	</div>
	</section>
	";
}

?>