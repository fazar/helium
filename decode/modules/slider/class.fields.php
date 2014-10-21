<?php
	class DC_slider_fields extends DC_meta_boxes{
		function __construct(){
			parent::__construct();
		}

		function meta_boxes_config(){
			$this->meta_boxes[] = array(
				'id' => 'dc_slider_content',
				'title' => 'Slide Cotent',
				'post_type' => 'dc_slider',
				'fields' => array(
					array(
						'id' => 'image',
						'title' => 'Slide Image',
						'subtitle' => 'Upload your image slide',
						'type' => 'image',
					),
					array(
						'id' => 'mp4',
						'title' => 'Mp4 File',
						'subtitle' => 'Upload your mp4 file here',
						'type' => 'video'
					),
					array(
						'id' => 'ogg',
						'title' => 'Ogg File',
						'subtitle' => 'Upload your ogg file here',
						'type' => 'video'
					),
					array(
						'id' => 'title',
						'title' => 'Title',
						'subtitle' => 'Type your title here',
						'type' => 'text'
					),
					
					array(
						'id' => 'subtitle',
						'title' => 'Subtitle',
						'subtitle' => 'Enter your subtitle here',
						'type' => 'textarea'
					)
				)
			);
			$this->meta_boxes[] = array(
				'id' => 'dc_slider_options',
				'title' => 'General Settings',
				'context' => 'side',
				'post_type' => 'dc_slider',
				'fields' => array(
					array(
						'id' => 'alignment',
						'type' => 'radio',
						'title' => 'Alignment',
						'default' => 'center',
						'options' => array(
							'left' => 'Left',
							'center' => 'Center',
							'right' => 'Right'
						)
					),
					array(
						'id' => 'color_scheme',
						'type' => 'radio',
						'title' => 'Color Scheme',
						'default' => 'light',
						'options' => array(
							'light' => 'Light',
							'right' => 'Right'
						)
					)
				)
			);

			$this->meta_boxes[] = array(
				'id' => 'dc_slider_title',
				'title' => 'Title Settings',
				'post_type' => 'dc_slider',
				'fields' => array(
					array(
						'id' => 'title_style',
						'type' => 'custom',
						'title' => 'Style',
						'callback' => 'caption_style'
					),
					array(
						'id' => 'title_animation',
						'type' => 'custom',
						'title' => 'Animation',
						'callback' => 'caption_animation'
					),
				)
			);
			$this->meta_boxes[] = array(
				'id' => 'dc_slider_subtitle',
				'title' => 'Subtitle Settings',
				'post_type' => 'dc_slider',
				'fields' => array(
					array(
						'id' => 'title_style',
						'type' => 'custom',
						'title' => 'Style',
						'callback' => 'caption_style'
					),
					array(
						'id' => 'title_animation',
						'type' => 'custom',
						'title' => 'Animation',
						'callback' => 'caption_animation'
					),
				)
			);
			$this->meta_boxes[] = array(
				'id' => 'dc_slider_buttons',
				'title' => 'Buttons Settings',
				'post_type' => 'dc_slider',
				'fields' => array(
					array(
						'id' => 'title_style',
						'type' => 'custom',
						'title' => 'Style',
						'callback' => 'caption_style'
					),
					array(
						'id' => 'title_animation',
						'type' => 'custom',
						'title' => 'Animation',
						'callback' => 'caption_animation'
					),
				)
			);
		}

		function caption_style( $meta_box_id, $meta_value, $field ){
			$default_value = empty($field['default']) ? '' : $field['default'] ;
			$field_value = empty($meta_value) || empty($meta_value[$field['id']]) ? $default_value : $meta_value[$field['id']] ;
			?>
				<tr>
					<td>
						<label><?php echo esc_html__( $field['title'], THEMENAME ) ?></label>
						<select  name="<?php echo $meta_box_id.'['.$field['id'] .']'; ?>" id="<?php echo $field['id'] ?>">
							<option value="regular" <?php selected($field_value, 'regular', true)  ?>>Regular</option>
							<option value="border" <?php selected($field_value, 'border', true)  ?>>Border</option>
							<option value="background" <?php selected($field_value, 'background', true)  ?>>Background</option>
						</select>
					
			<?php
		}

		function caption_animation( $meta_box_id, $meta_value, $field ){
			$default_value = empty($field['default']) ? '' : $field['default'] ;
			$field_value = empty($meta_value) || empty($meta_value[$field['id']]) ? $default_value : $meta_value[$field['id']] ;
			?>
					<td>
						<label><?php echo esc_html__( $field['title'], THEMENAME ) ?></label>
						<select  name="<?php echo $meta_box_id.'['.$field['id'] .']'; ?>" id="<?php echo $field['id'] ?>">
							<option value="regular" <?php selected($field_value, 'regular', true)  ?>>Regular</option>
							<option value="border" <?php selected($field_value, 'border', true)  ?>>Border</option>
							<option value="background" <?php selected($field_value, 'background', true)  ?>>Background</option>
						</select>
					</td>
				</tr>
			<?php
		}
	}
?>