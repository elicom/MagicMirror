<!doctype html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title>Magic Mirror</title>
	<meta name="description" content="The Magic Mirror">
	<meta http-equiv="refresh" content="1800" /> <!-- Updates the whole page every 30 minutes (each 1800 second) -->
	<link rel="stylesheet" href="style.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
		<script language="JavaScript"> <!-- Getting the current date and time and updates them every second -->
			setInterval(function() { 
				var currentTime = new Date ( );
				var currentHours = currentTime.getHours ( );   
				var currentMinutes = currentTime.getMinutes ( );
				var currentMinutesleadingzero = currentMinutes > 9 ? currentMinutes : '0' + currentMinutes; // If the number is 9 or below we add a 0 before the number.
				var currentDate = currentTime.getDate ( );
	
					var weekday = new Array(7);
					weekday[0] = "Sunday";
					weekday[1] = "Monday";
					weekday[2] = "Tuesday";
					weekday[3] = "Wednesday";
					weekday[4] = "Thursday";
					weekday[5] = "Friday";
					weekday[6] = "Saturday";
				var currentDay = weekday[currentTime.getDay()]; 
	
					var actualmonth = new Array(12);
					actualmonth[0] = "January";
					actualmonth[1] = "February";
					actualmonth[2] = "March";
					actualmonth[3] = "April";
					actualmonth[4] = "May";
					actualmonth[5] = "June";
					actualmonth[6] = "July";
					actualmonth[7] = "August";
					actualmonth[8] = "September";
					actualmonth[9] = "October";
					actualmonth[10] = "November";
					actualmonth[11] = "December";
				var currentMonth = actualmonth[currentTime.getMonth ()];

    var currentTimeString = "<h1>" + currentHours + ":" + currentMinutesleadingzero + "</h1><h2>" + currentDay + " " + currentDate + " " + currentMonth + "</h2>";
    document.getElementById("clock").innerHTML = currentTimeString;
}, 1000);
	</script>
</head>
<body>
<div id="wrapper">
	<div id="upper-left">
		<div id="clock"></div> <!-- Including the date/time-script -->
	</div>
	<div id="upper-right">
		<h2>...</h2>
		<?php // Code for getting the RSS-news-feed
			$rss = new DOMDocument();
			$rss->load('http://feeds.idg.se/idg/vzzs'); // Specify the address to the feed
			$feed = array();
				foreach ($rss->getElementsByTagName('item') as $node) {
					$item = array (
					'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
					'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
					'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
					);
				array_push($feed, $item);
				}
   
		$limit = 3; // Number of posts to be displayed
			for($x=0;$x<$limit;$x++) {
				$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
				$description = $feed[$x]['desc'];
				$date = date('j F', strtotime($feed[$x]['date']));
				echo '<h2 class="smaller">'.$title.'</h2>';
				echo '<p class="date">'.$date.'</p>';
				echo '<p>'.strip_tags($description, '<p><b>').'</p><h2>...</h2>';
			}
		?>
		<p>idg.se</p>
	</div>
	<div id="bottom">
		<h3>
		<?php // Depending on the hour of the day a different message is displayed.
			$now = date('H');
				if (($now > 06) and ($now < 10)) echo 'Good morning!';
				else if (($now >= 10) and ($now < 12)) echo 'Have a nice day!';
				else if (($now >= 12) and ($now < 14)) echo 'Time for lunch!';
				else if (($now >= 14) and ($now < 17)) echo 'Come and see!';
				else if (($now >= 17) and ($now < 20)) echo 'Time to start to think about dinner?';
				else if (($now >= 20) and ($now < 22)) echo 'Have a nice evening!';
				else if (($now >= 22) and ($now < 23)) echo 'Sleep tight, see you tomorrow!';
				else if (($now >= 00) and ($now < 06)) echo 'Shh, sleeping...';
			?>
		</h3>
	</div>
</div>
</body>
</html>