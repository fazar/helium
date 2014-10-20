<?php
	class HL_sidebar_hidden extends DC_parts_base{
		function __construct(){
			parent::__construct();
			add_action('hl_after_footer', array($this, 'display'));
			add_filter('wp_nav_menu_items',array($this, 'toggle') );
		}
		function display(){
			$options = $this->options;
			$color = !empty( $options['wae_hidden-sidebar_color'] ) ? $options['wae_hidden-sidebar_color'] : 'light-color';
			if(array_key_exists('wae_hidden-sidebar', $options) && $options['wae_hidden-sidebar']){
				$position = !empty( $options['wae_hidden-sidebar_position'] ) ?
					 $options['wae_hidden-sidebar_position'] : 'right';
				echo '<aside class="off-sidebar '. $color .' '.$position.'-pos">';
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('hidden-sidebar')) :
					echo '<p>there is not any widgets registered</p>';
				endif;
				echo '</aside>';
			}
		}

		function toggle($items){
			$options = $this->options;
			if(array_key_exists('wae_hidden-sidebar', $options) && $options['wae_hidden-sidebar']){
				$position = !empty( $options['wae_hidden-sidebar_position'] ) ?
					 $options['wae_hidden-sidebar_position'] : 'right';
				if($position == 'right'){
					return $items.'<li class="hidden-sidebar-toggle">
		                  <a href="#" class="off-sidebar-control right-off-sidebar">
		                    <span class="bar">
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    </span>
		                  </a>
		                </li>';
				}else{
					return '<li class="hidden-sidebar-toggle">
		                  <a href="#" class="off-sidebar-control left-off-sidebar">
		                    <span class="bar">
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    </span>
		                  </a>
		                </li>'.$items;
				}
			}
			return $items;
		}
	}
?>