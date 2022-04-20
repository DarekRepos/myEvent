<?php


namespace MyEvent\Core;


class MyEventBlockGutenbergSubscriber {

	//refactor to block manager classes
	public function register() {
		add_action( 'init', function () {

			wp_register_script('custom-myevent-js',
				plugins_url('assets/js/gutenberg-myEvent-block.js',
			 	dirname(__FILE__, 2)),
				array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor'));

			register_block_type('myeventblock/custom-myevent-js', array(
				'editor_script' => 'custom-myevent-js'
			));
		});
	}

}
