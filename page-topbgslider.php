<?php
/*
Template Name: Page With Slider
*/
get_header('topbg');
	?><div class="main-content"><?php
	do_action('dc_slider');
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
	?></div><?php
get_footer();
?>