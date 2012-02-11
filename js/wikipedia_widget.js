function wikipedia_call(terms,url,max){
		
	jQuery(document).ready(function($) {
														
			var data = {
				action: 'wikipedia_search',
				wiki_url: url,
				no_items:max,
				keywords:terms
			};		
						
			jQuery.post(ajaxurl, data, 
							
			function(response){
				
				if(response.length!=0){
				
					document.getElementById('wikipedia_search_and_display_widget').innerHTML = "<p>Searching Wikipedia for " + terms + "</p>" + response;
					
				}
								
			});
								
	});
			
}