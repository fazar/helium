<?php 
	/**
	* Fires the theme : constants definition, core classes loading
	*
	* 
	* @package      Helium
	* @subpackage   classes
	* @since        1.0
	* @author       Decode <decode.pdf@gmail.com>
	* @copyright    Copyright (c) 2014, Decode PDF
	* @link         http://decodepdf.com/helium
	* @license      http://www.gnu.org/licenses/gpl-3.0.html
	*/
	
	require_once( dirname(__FILE__). '/decode/functions.php' );
 	class Helium extends DC {
		
		function __construct(){
			parent::__construct();
			$this->add_images_size();
			add_action( 'vc_before_init', array( $this, 'vc_as_theme' ) );			
			add_filter( 'wp_list_categories', array( $this, 'cat_count_span' ));
			add_filter( 'get_archives_link', array( $this, 'archive_count_span' ) );
			$this->fire_bootstrapper();
		}

		function define_config(){
			$config = array(
				'class-prefix' => 'HL_',
				'admin-class' => 'helium_admin_config',
				'include-widgets' => array(
					'about',
					'popular_posts',
					'recent_comments',
					'instagram',
					'recent_posts'
				),
				'nav-menus' => array(
					'primary' => __( 'Primary Menu', THEMENAME ),
					'footer' => __( 'Footer Menu', THEMENAME )
				),
				'sidebar-widget-areas' => array(
    				array(
    					'name' => __( 'Main Sidebar', THEMENAME),
    					'id' => 'main-sidebar'
    				),
    				array(
    					'name' => __( 'Hidden Sidbar', THEMENAME ),
    					'id' => 'hidden-sidebar'
    				)		
    			),
				'include-modules' => array(
					'page_options',
					'post_format',
					'slider',
					'visual_composer',
				),
				'include-parts' => array(
					'header',
					'footer',
					// 'content',
					// 'comment',
					// 'social',
					 'slider'
				),
				'global-options' => 'helium',
			);
			$this->config = array_merge( $this->config, $config );
		}

		function load_parts(){
			$this->load_part( array('header', 'main') );
			$this->load_part( array('header', 'topbg') );
			$this->load_part( array('sidebar', 'hidden' ) ); 
			$this->load_part( array('footer', 'main') );
		}

		function add_images_size(){
			add_image_size( 'landscape', 600, 185, array('center', 'center') );
			add_image_size( 'main-thumbnail', 600);
		}

		function vc_as_theme(){
			vc_set_as_theme();
		}

		function fire_bootstrapper(){
			require_once(DC_BASE . 'bootstrapper/class.public.resolves.php');
			new HL_public_resolves;
		}

		function cat_count_span($links) {			
			$links = str_replace('</a> (', '<span>', $links);
			$links = str_replace(')', '</span></a>', $links);
			return $links;
		}

		function archive_count_span($links) {			
			//$links = str_replace('(', "", $links);
			$links = str_replace('</a>&nbsp;(', '<span>', $links);
			$links = str_replace(')', '</span></a>', $links);
			//$links = str_replace('&nbsp;', '', $links);
			return $links;
		}

	}

	new Helium;