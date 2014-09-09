<header>
	<h2>Vaccination Record</h2>
	<h3 id="panel">
 		<p id="welcome"><?php echo $welcome?></p>
 		<p id="date"><?php $mydate=getdate(time());
		echo "$mydate[weekday] - $mydate[mday] $mydate[month] $mydate[year]";?></p>
 		<a href="/logout.php"><button id="logout">Logout</button></a>
 	</h3>
</header>
<?php include '../../images/border.svg';?>
<nav>
	<button class="bg_btn" id="home">HOME</button>
	<button class="bg_btn" id="schedule">SCHEDULE</button>
	<img src="/images/logo.png">
	<button class="bg_btn">MY BABY</button>
	<button class="bg_btn">SETTINGS</button>
</nav>

<!------ automatic logout ------>

<div id="timeoutPopup">
	<div id="timeout">
		<p id="time-desc">Your session is about to expire if there is no additional activity in:</p>
		<p id="time"></p>
	</div>
	
</div>
<main>

<!----     progress bar ---->
	<progress value="" max="100"></progress>
	
<!----    ajax load document ---->
	<div id="content">