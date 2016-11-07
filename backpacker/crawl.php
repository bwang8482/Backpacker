<?php		
		$url='http://www.yelp.com/search?find_desc=Restaurants&find_loc=london';
		$url1='http://www.zagat.com/baltimore';
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$html = curl_exec($ch);
		curl_close($ch);

		# Create a DOM parser object
		$dom = new DOMDocument();

		# Parse the HTML from Google.
		# The @ before the method call suppresses any warnings that
		# loadHTML might throw because of invalid HTML in the page.
		@$dom->loadHTML($html);
		
		$linkArray = array();
		
		$xpath = new DOMXpath($dom);
  		$articles = $xpath->query('//div[@class="search-result-title"]');
  		foreach($articles as $container) {
    			echo $articles;
    			$arr = $container->getElementsByTagName("a");
    			echo $container->nodeValude;
    			
    			foreach($arr as $item) {
      				$href =  $item->getAttribute("href");
      			$text = trim(preg_replace("/[\r\n]+/", " ", $item->nodeValue));
    }
  }
  		
  		
  		

		$i = 0;
		// echo "start looking for h1 <br />";
		foreach($dom->getElementsByTagName('') as $title) {
			//echo $title->nodeValue;
			if($title->getElementsByTagName('a')){

		        // echo '     title: '.$title->nodeValue;

				foreach($title->getElementsByTagName('a') as $node){
				    $link = $node->getAttribute('href');
					//echo '     link: '.$link;

					if($i < 10){
						$linkArray[$i] = $link;
						$i++;
					}

				}

		        //echo "<br />";
		    }

		}
?>