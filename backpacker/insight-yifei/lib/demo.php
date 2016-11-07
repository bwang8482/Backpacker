<?php
if (PHP_SAPI != 'cli') {
	echo "<pre>";
}

$text ="Loved it! My wife and I just saw it today and were pleasantly surprised! I'm not sure what some of these reviewers are talking about. It's a very creative and really intelligent film. I loved all the twisted science and art direction they used. The story and characters were interesting and made you excited to see what would happen next. I won't give any details but if you appreciate movies that make you delve a little deeper than what's on the surface, you'll like this movie too. It's not your ordinary mindless adventure." ;


require_once __DIR__ . '/../autoload.php';
$sentiment = new \PHPInsight\Sentiment();
//foreach ($strings as $string) {

	// calculations:	
	$sentences=explode(". ",$text);
	$counter=0;
foreach($sentences as $sentence){
	$counter++;
if(strlen(trim($sentence))) {
	$scores = $sentiment->score($sentence);
	$class = $sentiment->categorise($sentence);
	// output:
	echo "String: $sentence\n";
	echo "Dominant: $class, scores: ";
	print_r($scores);
	echo "\n";
	if($class=="pos")
		$result+=3+$scores[pos]*5;
	else{
		$result+=$scores[pos]*5;
	}
		echo $result/$counter;
	}
	
}
	
?>