<?php	
	
	 function sentiment_analysis_post($text){    	
	// sentiment analysis on sentence base - phpInsight & SentimentAnalysis
	$sentenceArray = explode(". ", $text);

	// insight & SA
	
	// require_once __DIR__ . '/sentiment/src/test/style.php';
	require_once __DIR__ . '/insight/autoload.php';

	$sentiment= new \PHPInsight\Sentiment();
	
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
	if($class=="pos")
		$result+=3+$scores[pos]*5;
	else{
		$result+=$scores[pos]*5;
	}
		//echo $result/$counter;
		return $result/$counter;
}
}
}	
?>