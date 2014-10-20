<?php
/**
 * The Header for Helium
 *
 * Displays all of the <head> section and everything up till main content
 *
 * @package Helium
 * @since Helium 1.0
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<?php do_action( 'dc_html_head' ) ?>
	<body <?php body_class( 'main-wrapper' ) ?>>
		<div class="main-container fullscreen-bg-enabled">
		<?php do_action( 'hl_primary_navigation' ) ?>
			