<?PHP
		
	/**
	 * Add actions for both logged in and not logged in users
	 */
	add_action('wp_ajax_nopriv_wikipedia_search', 'wikipedia_get');
	add_action('wp_ajax_wikipedia_search', 'wikipedia_get');
	
	function wikipedia_get(){

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$_POST['wiki_url'] . "/w/api.php?format=xml&action=opensearch&search=" . $_POST['keywords'] . "&limit=" . $_POST['no_items']);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_MAXREDIRS,10);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,100);
		curl_setopt($ch,CURLOPT_USERAGENT,"wikipedia search and display widget");
		curl_setopt($ch,CURLOPT_HTTP_VERSION,'CURLOPT_HTTP_VERSION_1_1');
		$data = curl_exec($ch);		
		
		$xml = simplexml_load_string($data);
		
		if($xml){
		
			foreach($xml->Section->Item as $data => $value){
			
				echo "<li>";
				echo "<p><span><a href='" . $value->Url . "'><img src='" . $value->Image[0]['source'] . "' /></a><p><a href='" . $value->Url . "'>" . $value->Text . "</a> | <a title='click to expand' onclick='javascript:if(this.parentNode.childNodes[2].style.display==\"block\"){this.parentNode.childNodes[2].style.display=\"none\"}else{this.parentNode.childNodes[2].style.display=\"block\"};'>+</a>";
				echo "<span>" . $value->Description . "</span></p></li>";
								
			
			}
		
		}
		
		die(); // this is required to return a proper result
		
	}
	
?>