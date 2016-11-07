<?php	
	//$text = "<div> <em>The NFL Network recently compiled a list of the <a href='http://top100.nfl.com/'>100 best players in NFL history</a>, as selected by a blue-ribbon panel. This is not that list. Part 1 is below. Part 2 <a href='http://deadspin.com/5690560'>is here</a>. Share your own list at #theworstever.</em> <p> </p><div> <p><a href='http://deadspin.com/5690560'> <img src='http://i.kinja-img.com/gawker-media/image/upload/s--o0BIsFcD--/c_fill,fl_progressive,g_center,h_77,q_80,w_137/1866wrenv177fjpg.jpg'></a></p> </div> <p>You've seen Part 1. Read on for the rest of the worst. Share your own list at #theworstever. <a href='http://deadspin.com/5690560'> Read more Read more </a></p> <p>Blair Thomas was a bust. A larger-than-large bust.</p> <p>Selected by the Jets as the No. 2 overall pick in the 1990 NFL draft, the Penn State All-American was supposed to become one of the great running backs in league history. He was, Joe Paterno said, 'the best player I've ever coached' - a brutalizing combination of otherworldly speed and bulldozer power.</p> <p>After six years, however, Thomas was an NFL ghost - a forgotten man whose 2,236 career rushing yards represented one of the biggest disappointments in league history. Thomas was never great. Never exceptional. He was, frankly, average. A solid, unremarkable, run-of-the-mill NFL player who, had he not been selected so high, would have gone down as a solid, unremarkable, run-of-the-mill NFL player.</p> <p>Which is why he doesn't belong here.</p> <p>Earlier this month, the NFL Network completed its 100 greatest players series - an impressive list that started with Joe Namath at No. 100 and <a href='http://deadspin.com/5682620/jerry-rice-is-obviously-not-the-best-football-player-of-all-time'>ended with Jerry Rice at No. 1</a>. Inspired by that effort, I have compiled my own rankings - the 100 worst players in NFL history.</p> <p> </p><div> <p><a href='http://deadspin.com/5682620/jerry-rice-is-obviously-not-the-best-football-player-of-all-time'> <img src='http://i.kinja-img.com/gawker-media/image/upload/s--wKtNur_X--/c_fill,fl_progressive,g_center,h_77,q_80,w_137/18j56d931emvijpg.jpg'></a></p> </div> <p>The way I see it, there were six players they could have named as No. 1 and no one could seriously... <a href='http://deadspin.com/5682620/jerry-rice-is-obviously-not-the-best-football-player-of-all-time'> Read more Read more </a></p> <p>The base criteria is simple: You had to have been a very bad NFL player. That alone, however, is too easy. The league is filled with subpar performers who last a game or two, then vanish for eternity. (Where have you gone, Onzy Elam?) Here, not only do the candidates have to be bad; they have to be bad and of consequence. A hig";



	 function sentiment_analysis($text){

	$servername = "engr-cpanel-mysql.engr.illinois.edu";
        $username= "backpack_zbc";
        $password="123456";
        $dbname="backpack_user";
	$conn = new mysqli($servername, $username, $password, $dbname);

		$htmlTagArray = ["<div>",'</div>',
				 "<p>","</p>",
				 "<h1>","</h1>",
				 "<h2>","</h2>",
				 "<h3>","</h3>",
				 "<h4>","</h4>",
				 "<h5>","</h5>",
				 "<h6>","</h6>",
				 "<a>","</a>",
				 "<b>","</b>",
				 "<br>","</br>","!","?",";","@","#","$","%","^","&","*","(",")",
				 "<em>","</em>",
				 "<article>","</article>",
				 "<aside>","</aside>",
				 "<base>","</base>",
				 "<strong>","</strong>",
				 "<i>","</i>",
				 "<dt>","</dt>",
				 "<dd>","</dd>",
				 "<blockquote>","</blockquote>",
				 "<ul>","</ul>",
				 "<li>","</li>",
				 "<figure>","</figure>",
				 "<ol>","</ol>",
				 "<br>","<br />",'\n'];
	
	//$text =  mysqli_real_escape_string($conn,$text);
				 
	//echo $text;
	// clear crawled data 
	foreach($htmlTagArray as $htmlTag)
		$text = str_replace($htmlTag, ".", $text);

	$text = preg_replace('/<\/?a[^>]*>/',' ',$text);
	$text = preg_replace('/<\/?img[^>]*>/',' ',$text);
	$text = preg_replace('/<\/?audio[^>]*>/',' ',$text);
	$description = preg_replace("/\r\n|\r|\n/",'',$description);
	$text = str_replace("..", ". ", $text);
        $text = str_replace(". .", ". ", $text);
	$text = str_replace(" .", ". ", $text);
	$text = str_replace("..", ". ", $text);
        $text = str_replace(". .", ". ", $text);
	$text = str_replace(" .", ". ", $text);
	$text = str_replace(".,", ",", $text);	
	echo $text;
	
	//$len = strlen( $text );
	//for( $i = 0; $i <= $len; $i++ ) {
    	//	$char = substr( $text, $i, 1 );
    	//	if($char=='"'|| $char=='''){
    			
    	//	}
    	//}
    	
	// sentiment analysis on sentence base - phpInsight & SentimentAnalysis
	$sentenceArray = explode(".", $text);

	// insight & SA
	
	// require_once __DIR__ . '/sentiment/src/test/style.php';
	require_once __DIR__ . '/sentiment/src/SentimentAnalyzer.php';
	require_once __DIR__ . '/insight/autoload.php';

	$insightVer= new \PHPInsight\Sentiment();
	$sat = new SentimentAnalyzerTest(new SentimentAnalyzer());

	$positive = 0;
	$negative = 0;
	$counter = 0;


	$sat->trainAnalyzer('/home/backpacker/public_html/sentiment/trainingSet/data.neg', 'negative', 5000); //training with negative data
	$sat->trainAnalyzer('/home/backpacker/public_html/sentiment/trainingSet/data.pos', 'positive', 5000); //training with positive data

	$text = mb_convert_encoding($text, "UTF-8");


	foreach ($sentenceArray as $sentence) {
		if(strlen(trim($sentence))){

			$sentimentAnalysisOfSentence1 = $sat->analyzeSentence($sentence);

			$resultofAnalyzingSentence1 = $sentimentAnalysisOfSentence1['sentiment'];
			$probabilityofSentence1BeingPositive = $sentimentAnalysisOfSentence1['accuracy']['positivity'];
			$probabilityofSentence1BeingNegative = $sentimentAnalysisOfSentence1['accuracy']['negativity'];	

			$scoresSA = $probabilityofSentence1BeingPositive - $probabilityofSentence1BeingNegative;
			
			
			if($scoresSA > 0.8)
				$positive+=5;
			else if($scoresSA > 0.6)
				$positive+=4;
			else if($scoresSA > 0.4)
				$positive+=3;
			else if($scoresSA > 0.2)
				$positive+=2;
			else if($scoresSA > 0.0)
				$positive+=1;
			else if( $scoresSA > -0.2)
				$negative+=1;
			else if($scoresSA > -0.4)
				$negative+=2;
			else if($scoresSA> -0.6)
				$negative+=3;
			else if($scoresSA> -0.8)
				$negative+=4;
			else if($scoresSA > -1.0)
				$negative+=5;
				
			$scoresInsight = $insightVer->score($sentence);
			$classInsight = $insightVer->categorise($sentence);

			$positive += ($scoresInsight[pos]+$scoresInsight[neu]/2) * 5; //positiveness rated by 5 
			$negative += ($scoresInsight[neg]+$scoresInsight[neu]/2) * 5; //negativeness rated by 5
			// $neutural += $scoresInsight[neu];
			
			//echo "sentence:  ".$sentence."<br>";
			//echo "SA positiveness:  ".$probabilityofSentence1BeingPositive." negativeness:  ".$probabilityofSentence1BeingNegative."<br>";
			//echo "Insight positiveness:  ".$scoresInsight[pos]." negativeness:  ".$scoresInsight[neg]." neuturalness:  ".$scoresInsight[neu]."<br><br>";			
			
			
		}
		$counter++;
	}


	 $positive=$positive/(2*$counter);
	 $negative=-$negative/(2*$counter);
	 	
	if(($positive + $negative)>=0){
		//echo $positive;
		return $positive*2.5+5;
	}
	else{
		//echo $negative;
		return $negative*2.5+5;	
	}
	//$negative=$negative/$counter;
	
	//echo $counter."<br>";
	//echo "resultant postiveness:  ".$positive."<br>";
	//echo "resultant negativeness:  ".$negative."<br>";
	
 }

?>