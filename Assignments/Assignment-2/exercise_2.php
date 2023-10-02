<?php

// Declaration and intialization of variables
$title="Web Page";
$heading="My Web Page";
$name="Ishaq Ahmed";
$footer="My Web Page@2018";
$paragrphToBeInjected="";
$paragraphProvided="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat mollis 
dolor at bibendum. In congue maximus ligula, ut faucibus mi accumsan at. Vestibulum sagittis
tortor eget dui ultricies, a vulputate lacus faucibus. Fusce aliquet bibendum erat, sed bibendum
eros cursus eu. Nulla at neque rhoncus, ultricies odio at, accumsan elit. Proin in turpis eu leo
dapibus pulvinar. Vivamus viverra massa ut enim fringilla ultricies. Donec in enim blandit, iaculis
nulla quis, egestas elit. Nullam ut enim id erat bibendum finibus nec ac eros. Nulla malesuada ex
facilisis ultrices rhoncus. Nullam in euismod nisl. Donec pulvinar ex sit amet aliquet egestas.";

// Logic to concatenate to get 3 para in one string variable
for ($i=0; $i<3;$i++){
	$paragrphToBeInjected.=$paragraphProvided;
    $paragrphToBeInjected.="<br>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title?></title>
	<style>
		* {margin: 0; padding: 0;}
		body {font: 120%/1.5 sans-serif;}
		#wrapper {width: 1000px; margin: 0 auto; border: 1px solid black;}
		header {background: green; height: 150px; padding: 20px;}
		header h1 {color: white;}
		main {padding: 10px;}
		main h2 {margin: 15px 0;}
		main p {margin-bottom: 15px;}
		footer {background: #eee; padding: 10px 0; text-align: center}
		footer p {font-size: .8em;}
	</style>
</head>
<body>
	<div id="wrapper">
		<header>
			<h1><?php echo $heading?></h1>
		</header>
		<main>
			<h2>My name is <?php echo $name?></h2>
			<?php echo $paragrphToBeInjected?>
		</main>
		<footer>
			<p><?php echo $footer?></p>
		</footer>
	</div>
	
</body>
</html>