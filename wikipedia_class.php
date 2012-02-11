<?php 

/**
 * RSS widget class
 *
 * @since 2.8.0
 */
class wikipedia_search_and_display extends WP_Widget_RSS {

	function wikipedia_search_and_display() {
	
		$widget_ops = array( 'description' => __('Displays Wikipedia Content') );
		$this->WP_Widget( 'wikipedia_search_and_display', __('Wikipedia search and display'), $widget_ops);
		
	}

	function widget($args, $instance) {
	
		global $post;

		if ( isset($instance['error']) && $instance['error'] )
			return;
						
		if(!is_home()){
		
			$words = array();
		
			$post_categories = wp_get_post_categories($post->ID);
			
			foreach($post_categories as $data => $value){
			
				$data = get_category($value);
				array_push($words,$data->name);
			
			}
		
		}else{		
		
			$words = array();
		
			$post_categories = get_categories();
			
			foreach($post_categories as $data => $value){
			
				array_push($words,$value->name);
			
			}
						
		}
		?>
			<script type="text/javascript" language="javascript">
				wikipedia_call('<?PHP echo implode(",",$words); ?>','<?PHP echo $instance["wiki_url"]; ?>','<?PHP echo $instance["number_links"]; ?>');	
			</script>				
			<ul id='wikipedia_search_and_display_widget'></ul>
		<?
				
	}

	function form($instance) {		
		
		echo '<p><label for="' . $this->get_field_id("wiki_url") .'">Wikipedia URL :</label>';
		echo '<input type="text" name="' . $this->get_field_name("wiki_url") . '" '; 
		echo 'id="' . $this->get_field_id("wiki_url") . '" value="' . $instance["wiki_url"] . '" size="35" /></p>';	
		echo '<p><label for="' . $this->get_field_id("number_links") .'">Number of links:</label>';
		echo '<input type="text" name="' . $this->get_field_name("number_links") . '" '; 
		echo 'id="' . $this->get_field_id("number_links") . '" value="' . $instance["number_links"] . '" /></p>';

	}

	
	
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;		
		$instance['wiki_url'] = $new_instance['wiki_url'];
		$instance['number_links'] = $new_instance['number_links'];	
		return $instance;
	}
	
}

 ?>