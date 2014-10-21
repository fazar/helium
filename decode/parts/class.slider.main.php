<?php
	class DC_slider_main extends DC_parts_base{

		function __construct(){
			parent::__construct();
			add_action('dc_slider', array($this, 'display_slider' ));
		}

		function display_slider(){
			$options = $this->options;
			$skin = !empty($options['slider_skin']) ? $options['slider_skin'] : 'circle' ;
			DC::resolves(array('dcslider', 'videofit'));
			$slides = $this->get_data();
			if(!$slides) return;
			?>
			<div id="full-slider" class="dc-slider fullscreen <?php echo $skin ?>">
			  <div class="items">
			  	<?php
		  		foreach ($slides as $key => $slide):
		  			$active = $key  == 0 ? 'active' : '';
		  			$title_style = $slide['title_style'] == 'regular' ? 'regular' : 'with-'.$slide['title_style'];
		  			$subtitle_style = $slide['subtitle_style'] == 'regular' ? 'regular' : 'with-'. $slide['subtitle_style'];
		  			?>
		  			<div class="item <?php echo $active ?> <?php echo $slide['color_scheme'] ?>">
		  				<?php if ( !empty($slide['mp4']) || !empty($slide['ogv']) ) : ?>
	  					 <div class="item-bg">
		  					<video class="videofit" preload="auto" autoplay="autoplay" loop="loop">
		  					  <?php if ( !empty($slide['mp4']) ) : ?>
		  					  <source src="<?php echo $slide['mp4'] ?>" type="video/mp4">
	  						  <?php endif; ?>
	  						  <?php if( !empty($slide['ogv'])  ) : ?>
		  					  <source src="<?php echo $slide['ogv'] ?>" type="video/ogg">
  							  <?php endif;?>
		  					</video>
		  				 </div>
		  				<?php else : ?>
		  				  <div class="item-bg"style="background-image:url(<?php echo $slide['image'] ?>)"></div>
		  				<?php endif; ?>
		  				<div class="item-content content-<?php echo $slide['alignment'] ?>">
		  				  <div class="animate">
			  				  <h1><span class="<?php echo $title_style ?>"><?php echo $slide['title'] ?></span></h1>
			  				  <p><span class="<?php echo $subtitle_style ?>"><?php echo $slide['subtitle'] ?></span></p>
		  				  </div>
		  				</div>
		  			</div>
		  		<?php
		  			endforeach;
			  	?>
			  </div>
			  <a class="left-control slider-nav" href="#full-slider">
			    <span class="icon-arrow-left"></span>
			    <?php
			    	if($skin == 'square'){
			    		echo '<div class="slide-counter">';
			    		echo '<span class="slide-index">1</span>';
			    		echo '<div class="diagonal-line"></div>';
			    		echo '<span class="slide-total">'.count($slides).'</span>';
			    		echo '</div>';
			    	}
			     ?>
			  </a>
			  <a class="right-control slider-nav" href="#full-slider">
			  	<?php
			    	if($skin == 'square'){
			    		echo '<div class="slide-counter">';
			    		echo '<span class="slide-index">1</span>';
			    		echo '<div class="diagonal-line"></div>';
			    		echo '<span class="slide-total">'.count($slides).'</span>';
			    		echo '</div>';
			    	}
			     ?>
			    <span class="icon-arrow-right"></span>
			  </a>
			  <?php $this->generate_indicators(count($slides)); ?>
			</div>
			<?php
		}

		function generate_indicators($length){
			echo "<ol class='dc-slider-indicators' >";
				echo '<li class="active"></li>';
			for($x=$length; $x > 1; $x--){
				echo "<li></li>";
			}
			echo "</ol>";
		}

		function get_data(){
			$query = new WP_Query( array( 'post_type' => 'dc_slider') );
			$results = array();
			while ($query->have_posts()) : $query->next_post();
				$content = get_post_meta( $query->post->ID, '_dc_slider_content', true );
				$options = get_post_meta( $query->post->ID, '_dc_slider_options', true );
				$title_options = get_post_meta($query->post->ID, '_dc_slider_title', true);
				$subtitle_options = get_post_meta($query->post->ID, '_dc_slider_subtitle', true);
				$buttons_options = get_post_meta($query->post->ID, '_dc_slider_buttons', true);
				$buttons = array();
				if ( !empty($content['button_1']) ){
					$buttons[] = array(
						'text' => $content['button_1'],
						'link' => $content['button_link_1']
					);
				}
				if ( !empty($content['button_2']) ){
					$buttons[] = array(
						'text' => $content['button_2'],
						'link' => $content['button_link_2']
					);
				}

				$results[] = array(
					'image' => $content['image'],
					'mp4' => $content['mp4'],
					'ogv' => $content['ogv'],
					'title' => $content['title'],
					'subtitle' => $content['subtitle'],
					'buttons' => $buttons,
					'alignment' => $options['alignment'],
					'color_scheme' => $options['color_scheme'],
					'title_style' => $title_options['style'],
					'titla_animation' => $title_options['animation'],
					'subtitle_style' => $subtitle_options['style'],
					'subtitle_animation' => $subtitle_options['animation'],
					'buttons_style' => $buttons_options['style'],
					'buttons_animation' => $buttons_options['animation']
				);
			endwhile;
			wp_reset_postdata();
			return $results;
		}

	}
?>