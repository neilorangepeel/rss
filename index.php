<?php
/**
 * index.php
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>RSS - Curated by Neil Hainsworth</title>
	<link rel="shortcut icon" href="">

	<style media="screen">
		* {
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		body {
			margin: 100px 0;
			margin: 7vw 0;
			font-family: Brandon Text, -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
			color: #191919;
		}
		.wrapper {
			width: 90%;
			max-width: 1000px;
			margin: 0 auto;
		}
		.page-title {
			margin-bottom: 10vw;
			font-size: 80px;
			font-weight: 300;
			font-style: italic;
		}
		a {
			color: inherit;
			text-decoration: none;
		}
		a:hover,
		a:focus,
		a:active {
			color: #67F;
		}
		a:visited {
			color: #ccd;
		}
		.entry {
			margin-bottom: 50px;
		}
		time {
			font-weight: bold;
			font-size: 12px;
			letter-spacing: 1px;
			text-transform: uppercase;
			margin-bottom: 4px;
			display: inline-block;
		}
		h2 {
			margin: 0 0 4px;
		}
		p {
			margin: 0;
		}
		.entry-author {
			font-style: italic;
		}
		.entry-author a {
			color: inherit;
			text-decoration: underline;
		}
	</style>
</head>
<body>

	<div class="wrapper">
		<h1 class="page-title">RSS</h1>

		<?php
		    /**
			 * Sites i'm following that are mixed together via http://www.rssmix.com/
			 *
			 * http://chriscoyier.net/feed
			 * https://ma.tt/feed
			 * http://laurakalbag.com/feed
			 * https://daverupert.com/atom.xml
			 * http://trentwalton.com/feed.xml
			 * https://arraythemes.com/feed
			 * http://girlwithacamera.co.uk/feed
			 * http://www.frankchimero.com/feed.xml
			 * http://www.newrafael.com/feed/
			 * http://www.heydonworks.com/feed
			 * https://sarasoueidan.com/rss.xml
			 * http://lea.verou.me/feed
			 * https://design.blog/feed
			 * http://siobhanmckeown.com/feed
			 * http://gutenberg.news/feed
			 */

			$html = "";
			$url  = "http://www.rssmix.com/u/8276615/rss.xml";
			$xml  = simplexml_load_file($url);
			for ($i = 0; $i < 30; $i++) {
				$title   = $xml->channel->item[$i]->title;
				$link    = $xml->channel->item[$i]->link;
				$pubDate = $xml->channel->item[$i]->pubDate;
				$dc 	 = $xml->channel->item[$i]->children('http://purl.org/dc/elements/1.1/');
				$creator = $dc->creator;

				$website = $xml->channel->item[$i]->guid;

				// strip url to make pretty url
				$domain = parse_url($website, PHP_URL_HOST);

				// converting pubDate to timeStamp
				$timeStamp = strtotime($pubDate);

				$html .= "<div class='entry'>";
					$html .= "<time class='entry-date'>".date('j M Y', $timeStamp)."</time>";
					$html .= "<h2 class='entry-title'><a href='$link'>$title</a></h2>";
					$html .= "<p class='entry-author'>By $creator on <a href='$website'>$domain</a></p>";
				$html .= "</div>";

			}
			echo $html;
		?>
	</div><!-- .wrapper -->

</body>
</html>
