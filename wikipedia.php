<?php

/*
Plugin Name: Wikipedia API search and display Widget
Description: Facilitates the display of Wikipedia Content
Version: 0.000001
Author: pgogy
*/
 
require_once( 'wikipedia_ajax.php' ); 

add_action("wp_head","wikipedia_add_scripts");		
	
function wikipedia_add_scripts(){
	
	?><script type='text/javascript' src='<?PHP echo site_url(); ?>/wp-includes/js/jquery/jquery.js'></script>
	<link rel="stylesheet" href="<?PHP echo plugins_url("/css/wikipedia_widget.css" , __FILE__ ); ?>" />
	<script type="text/javascript" language="javascript" src="<?PHP echo plugins_url("/js/wikipedia_widget.js" , __FILE__ ); ?>"></script>
	<script type="text/javascript" language="javascript">
	var ajaxurl = '<?PHP echo site_url(); ?>/wp-admin/admin-ajax.php';	
	</script>
	<?PHP
	
}
 

function wikipedia_search_and_display_widget() {
	require_once( 'wikipedia_class.php' );
	register_widget( 'wikipedia_search_and_display' );
}
add_action( 'widgets_init', 'wikipedia_search_and_display_widget', 1 );


?>