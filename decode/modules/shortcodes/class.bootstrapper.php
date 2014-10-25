<?php
	class DC_shortcodes_bootstrapper extends DC_boostrapper{
		function __construct(){
			$this->instantiate('audio');
			$this->instantiate('video');
		}
	}
?>