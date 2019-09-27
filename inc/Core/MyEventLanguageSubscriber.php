<?php


namespace MyEvent\Core;


use MyEvent\EventManagement\SubscriberHooksInterface;

class MyEventLanguageSubscriber implements SubscriberHooksInterface {

	public static function getSubscribedHooks() {

		return [
			'init' => 'loadTextDomain'
		];

	}

	Public static function loadTextDomain() {
		load_plugin_textdomain( 'myEvent',
			false,
			dirname( __FILE__, 3 )  . '/lang/' );


	}

}