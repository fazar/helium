<?php
	class HL_header_main extends DC_parts_base{
		function __construct(){
			parent::__construct();
			add_action( 'hl_primary_navigation', array( $this, 'display_primary_menu' ) );			
			// add_filter('wp_nav_menu_items',array($this, 'search_button') );
		}

		function display_primary_menu(){

			$options = $this->options;
			
			if($options['menu_pos'] == '1') {
				if(!empty($options['nav_type'])){
					switch ($options['nav_type']) {
						case '1':
							$this->menu_with_position('right', 'left');
							break;
						
						case '2':
							$this->menu_with_position('left', 'right');
							break;
						

						default:
							$this->menu_with_position('center', '');
							break;
					}
				}	
			} else {
				$this->vertical_menu();
			}
			
		}

		function vertical_menu() {
			$options = $this->options;
			$color_schema = $options['nav_color_schema'];
			$logo_color = $color_schema == 'dark-color' ? 'dark' : 'light';
			$nav_background_pos = $options['nav_background_pos'];
			$inline_nav_background = '';
			if($options['use-nav-background'] == 1 && !empty($this->options['nav_background']) ) {
				$inline_nav_background = "style='background-image:url(\"".$this->options['nav_background']['url']."\");background-size:cover'";	
			}
			
			?>
			<div class="fixed-menu-position fixed-menu-position-right <?php echo $color_schema; ?> <?php echo $nav_background_pos; ?>" <?php echo $inline_nav_background ?>>
				<nav data-topbar role="navigation">									
					<ul class="title-area center">
				    	<li class="name">
				    		<h1><?php do_action( 'dc_logo', $logo_color ) ?></h1>
				    	</li>
				    	<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				    </ul>
				    <section>
						<?php do_action( 'dc_menu', 'primary', 'center') ?>
					</section>
				</nav>							
			</div>

			<?php
		}

		function menu_with_position($menu_side, $logo_side){
			$top_bar_side = ($menu_side == 'center') ? $menu_side : '';		
			$options = $this->options;									
			$color_schema = !empty($options['nav_color_schema']) ? $options['nav_color_schema'] : 'light-color';
			$logo_color = $color_schema == 'dark-color' ? 'dark' : 'light';
			?>

			<div class="contain-to-grid nav-container <?php echo $color_schema ?>">
				<nav class="top-bar <?php echo $top_bar_side; ?>" data-topbar role="navigation">									
					<ul class="title-area <?php echo $logo_side?>">
				    	<li class="name">
				    		<h1><?php do_action( 'dc_logo', $logo_color ) ?></h1>
				    	</li>
				    	<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				    </ul>
				    <section class="top-bar-section <?php echo $this->options['hover_type'] ?>">
						<?php do_action( 'dc_menu', 'primary', $menu_side) ?>
					</section>
				</nav>
			</div>
			<!-- <div class="contain-to-grid full-screen wrapper-header-background" style="background-image:url(<?php bloginfo('template_directory'); ?>/images/5-copy.jpg);min-height:546px"></div> -->
			<!-- <div class="parent-wrapper-nav-sticky"></div> -->
			<?php
		}		

		function search_button($items){
			return $items.'<li class="search-wrapper">
								<form role="search" method="get" id="searchform" action="'. home_url( "/" ) . '">
									<a class="search-button" title="Search" href="#"><i class="fa fa-search"></i></a>
					    			<input type="text" value="'.get_search_query().'"  autocomplete="off" name="s" id="s" />
					        		<a class="close-search-button" title="Search" href="#"><i class="fa fa-times"></i></a>
					    		</form>
							</li>';
		}
	}
?>