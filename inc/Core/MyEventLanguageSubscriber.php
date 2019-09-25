<?php


namespace MyEvent\Core;


use MyEvent\EventManagement\SubscriberHooksInterface;

class MyEventLanguageSubscriber implements SubscriberHooksInterface {

	public static function getSubscribedHooks() {
		return [
			'plugin_loaded' => 'loadTextDomain'
		];
	}

	Public function loadTextDomain() {
		load_plugin_textdomain( 'myEvents',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/lang' );
	}
}