	<?php 
	function crawl(){
		$url[] = "http://www.travelocity.com/vc/inspire"; // works w/out baseurl
		$url[] = "http://www.theguardian.com/travel"; // works w/ baseurl
		$url[] = "http://www.cnn.com/specials/travel/best-of-travel"; // works w/out baseurl
		$url[] = "http://www.departures.com/luxury-vacations?cid=main_nav"; // works w/ baseurl

		$baseurl[] = "http://www.travelocity.com";
		$baseurl[] = "http://www.theguardian.com";
		$baseurl[] = "http://www.cnn.com";
		$baseurl[] = "http://www.departures.com";

		for($i = 0; $i < 4; $i++)
			crawlAWebsite($url[$i], $baseurl[$i]); 
	}

	?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
  <script src="http://cdn.embed.ly/jquery.embedly-3.1.1.min.js" type="text/javascript"></script> 	
  <script type="text/javascript">
	/*	
		Function: main crawler here.
		
		Flow: 	1. go to - travelocity - 12hrs - the Guardian - and more websites, run every xxx sec.
				2. find a way to select the actual article options, and enter
				3. extract and save into DB (display in this page for now.)
		
		TO DO:  1. select article options: try finding "h1" to "h6" tags that have href links
				2. overall sentiment
	*/	


		/*
			Function: extract the title, content, author, keyword and more of the page
		*/

		function extractContent(url, baseurl){	
			$.embedly.extract(url, {key: '88ec090b983745d98f594820afdbb393'} ).progress(function(obj){
			      // Reset the loading.
			      $("#result").text('loading');
			      $('#result').prop('disabled', false);
			      // If the obj does not have an article, kill in with an aleart.
			      if (! obj.content){
			        return true;
			      }
				 // Limit the number of keywords, authors and entities
				      obj.keywords = obj.keywords.slice(0,5);
				      obj.authors = obj.authors.slice(0,5);

				      //console.log(obj.authors);
				      if(!obj.authors[0]){ 
				      		obj.authors = null;
				      		// $("body").append("<p>"+ url+ " no author "+baseurl+"</p>");
				      	}

/*				 	$("body").append("<br><div style='background-color:gray;'> title: "+obj.title+"<br>"+
				 							"author: "+baseurl+"<br>"+
				 							"content: "+obj.content+"<br>"+
				 					"</div>");
*/
					$.post("new_post_from_crawler.php", 
					{
						title: String(obj.title),
						content: String(obj.content),
						author: String(baseurl),
						locatoin: "undefined"
					}, function(data){
					// console.log(data);
			        });

				});
		}


</script>


<?php 
		
	function crawlAWebsite($url, $baseurl){			
		# Use the Curl extension to query Google and get back a page of results

		/* seems that you have to determine the number you need to get 
		   cuz some website use h1 more and some use h2 more

		   sites that works: travelocity, the guardian, 
		   ones that doesn't work: 12hr
		 */

		$urlRegex = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
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

		$i = 0;
		// echo "start looking for h1 <br />";
		foreach($dom->getElementsByTagName('h1') as $title) {

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

		// echo "<br /> start looking for h2 <br />";
		foreach($dom->getElementsByTagName('h2') as $title) {

			if($title->getElementsByTagName('a')){

		        // echo '     title: '.$title->nodeValue;

				foreach($title->getElementsByTagName('a') as $node){
				    $link = $node->getAttribute('href');
					// echo '     link: '.$link;

					if($i < 10){
						$linkArray[$i] = $link;
						$i++;
					}

				}

		        //echo "<br />";
		    }

		}

		// echo "<br /> start looking for h3 <br />";
		foreach($dom->getElementsByTagName('h3') as $title) {

			if($title->getElementsByTagName('a')){

		        // echo '     title: '.$title->nodeValue;

				foreach($title->getElementsByTagName('a') as $node){
				    $link = $node->getAttribute('href');
					// echo '     link: '.$link;

					if($i < 10){
						$linkArray[$i] = $link;
						$i++;
					}

				}

		        //echo "<br />";
		    }

		}

		// echo "start scraping <br>";
		$i = 0;
		while($linkArray[$i]){

			if(!(substr( $linkArray[$i], 0, 4 ) == "http")){
				// echo $linkArray[$i]." is invalid    <br>";
				$linkArray[$i] = $baseurl.$linkArray[$i];
			}

			 //echo "correct:  ".$linkArray[$i]."<br>";
			echo '<script type="text/javascript"> extractContent("'.$linkArray[$i].'", "'.$baseurl.'"); </script>';

			$i++;

		}

	}

?>