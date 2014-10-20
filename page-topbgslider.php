<?php
/*
Template Name: Page With Slider
*/
get_header('topbg');
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
get_footer();
?>