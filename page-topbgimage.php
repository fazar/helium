<?php
/*
Template Name: Page With Header Background
*/
get_header('topbg');
?>
	<div class="main-content">
	<?php
		do_action('hl_header_bg');
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>
	</div>
<?php
get_footer();
?>
