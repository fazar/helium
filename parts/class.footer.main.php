<?php
	class HL_footer_main extends DC_parts_base {
		function __construct() {
			parent::__construct();
			add_action( 'hl_main_footer', array( $this, 'display_main_footer') );
			add_action( 'widgets_init', array( $this, 'register_widget_area' ) );
		}

		function register_widget_area(){
			$footer_columns = $this->get_footer_columns();
			for ($i=1; $i <= $footer_columns ; $i++) { 
				register_sidebar(array(
					'name' => 'footer_' . $i,
					'before_widget' => '<div class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h2>',
					'after_title' => '</h2>'
					));
			}
		}

		function display_main_footer() {
			$options = $this->options;
			if( !(!empty( $options['enable-main-footer-area'] ) && $options['enable-main-footer-area']) )
				return;
			$footer_columns = $this->get_footer_columns();
			$class_maps = array(
				2 => 'large-6',
				3 => 'large-4',
				4 => 'large-3'
			);
			$color_scheme = !empty( $options['footer_color_scheme'] ) ? $options['footer_color_scheme'] : 'light-color' ;
			?>
			<div class="main-footer <?php echo $color_scheme ?> first-row">
				<div class="row">
					<?php for ($i=1; $i <= $footer_columns; $i++ ) : ?>
						<div class="medium-4 <?php echo $class_maps[$footer_columns] ?> columns">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar( 'footer_' . $i )) :
								echo '<p>there is not any widgets registered</p>';					
							endif;
							?>
						</div>
					<?php endfor; ?>
				</div>
			</div>
			<?php
		}

		private function get_footer_columns(){
			$options = $this->options;
			$footer_columns = 3;
			if ( !empty( $options['footer_columns'] ) ) $footer_columns = $options['footer_columns'];
			return $footer_columns;
		}
	}
?>