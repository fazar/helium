		<?php
			do_action( 'hl_before_footer' );
		?>
		<footer id="footer" class="footer">
			<?php do_action( 'hl_main_footer' ); ?>
		</footer>
		</div>
		<?php 
			wp_footer(); //do not remove, used by the theme and many plugins
			do_action( 'hl_after_footer' ); 
		?>
	</body>
</html>