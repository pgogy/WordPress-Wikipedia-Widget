<?PHP
		
	/**
	 * Add actions for both logged in and not logged in users
	 */
	add_action('wp_ajax_nopriv_wikipedia_search', 'wikipedia_get');
	add_action('wp_ajax_wikipedia_search', 'wikipedia_get');
	
	function wikipedia_get(){

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$_POST['wiki_url'] . "/w/api.php?format=xml&action=opensearch&search=" . strtolower($_POST['keywords']) . "&limit=" . $_POST['no_items']);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_MAXREDIRS,10);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,100);
		curl_setopt($ch,CURLOPT_USERAGENT,"wikipedia search and display widget");
		curl_setopt($ch,CURLOPT_HTTP_VERSION,'CURLOPT_HTTP_VERSION_1_1');
		$data = curl_exec($ch);		

		$xml = simplexml_load_string($data);
		
		$counter =0;
		
		if($xml){
		
			foreach($xml->Section->Item as $data => $value){
			
				echo "<li>";
				if(isset($value->Image[0]['source'])){
					echo "<p><span><a href='" . $value->Url . "'><img src='" . $value->Image[0]['source'] . "' /></a></p>";
				}
				echo "<p><a href='" . $value->Url . "'>" . $value->Text . "</a> | <a class='wikipedia-widget-link' title='click to expand' onclick='javascript:if(document.getElementById(\"wikipedia_widget_" . $counter. "\").style.display==\"block\"){document.getElementById(\"wikipedia_widget_" . $counter. "\").style.display=\"none\"}else{document.getElementById(\"wikipedia_widget_" . $counter. "\").style.display=\"block\"};'>+</a>";
				echo "<span id='wikipedia_widget_" . $counter++ . "'>" . $value->Description . "</span></p></li>";
								
			
			}
		
		}
		
		die(); // this is required to return a proper result
		
	}
	
?>