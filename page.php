<?php
/**
* The main template file. Includes the loop.
*
*
* @package Helium
* @since Helium 1.0
*/
	get_header();
	/* Start the Loop */
	?>
	<div class="row main-content">		
		<div class="large-12 medium-12 columns">
		<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
		?>
		</div>
	</div>
	<?php  
		get_footer();
	?>
	