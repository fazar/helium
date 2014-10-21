<?php
/*
Template Name: Page With Slider
*/
get_header('topbg');
	do_action('dc_slider');
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
get_footer();
?>