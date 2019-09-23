<?php


namespace MyEvent\Core;


use MyEvent\EventManagement\SubscriberHooksInterface;

class MyEventAdminStyleSubscriber implements SubscriberHooksInterface {

	public static function getSubscribedHooks() {
		return [
			'admin_enqueue_scripts' => 'loadAdminPagesStyle',
		];
	}

	public function loadAdminPagesStyle( $hook ) {
		$current_screen = get_current_screen();

		if ( ! ( stripos( $current_screen->base, 'edit.php?post_type=myevents' ) === false ) ) {
			return;
		} else {
			wp_enqueue_style( 'main_css',
				plugin_dir_url( dirname( __FILE__, 3 ) . '/assets/css/main.css' ) . 'main.css' );
		}
	}

}