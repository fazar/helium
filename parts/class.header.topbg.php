<?php
	class HL_header_topbg extends DC_parts_base{
		function __construct(){
			parent::__construct();
			add_action('hl_header_bg', array($this, 'display'));
		}

		function display(){
			global $post;
			$page_header = get_post_meta($post->ID, '_dc_page_header', true);
			?>
			<div class="top-header-bg 
				<?php echo $page_header['color_scheme'] ?> 
				<?php echo $page_header['display'] ?>" 
				style="background-image:url(<?php echo $page_header['background_img'] ?>)">
					<div class="top-header-content content-<?php echo $page_header['align'] ?>">
						<h1 class="title"><?php echo $page_header['title'] ?></h1>
						<p class="subtitle"><?php echo $page_header['subtitle'] ?></p>
					</div>
			</div>
			<?php
		}
	}

?>