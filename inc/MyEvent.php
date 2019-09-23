<?php

namespace MyEvent;


use MyEvent\Core\MyEventAdminPage;
use MyEvent\Core\MyEventAdminPageSubscriber;
use MyEvent\Core\MyEventAdminStyleSubscriber;
use MyEvent\Core\MyEventFrontStyleSubscriber;
use MyEvent\Core\MyEventLanguageSubscriber;
use MyEvent\Core\MyEventPostType;
use MyEvent\Core\MyEventPostTypeHooks;
use MyEvent\Core\MyEventWidgetSubscriber;
use MyEvent\EventManagement\EventManager;


class MyEvent {

	private $pluginsbasename;
	private $myeventposttype;
	private $pluginmanager;
	private $myeventwidget;
	private $myeventpostypehooks;


//TODO: reduce coupling: depency inversion / injection/ solid
	public function __construct( $file ) {
		$this->pluginsbasename     = plugin_basename( $file );
		$this->myeventposttype     = new MyEventPostType();
		$this->myeventpostypehooks = new MyEventPostTypeHooks();
		//TODO: refactor Widget subscriber - needed instance of object
		$this->myeventwidget = new MyEventWidgetSubscriber();
		$this->myeventwidget->registerMyeventWidget();
		$this->pluginmanager = new EventManager();
		//TODO: Add shortcode
		//TODO: Add init settings
	}

	public function load() {
		$this->myeventposttype->register();
		$this->myeventpostypehooks->init();

		foreach ( $this->getSubscribers() as $subscriber ) {
			$this->pluginmanager->addSubscriber( $subscriber );
		}
	}

	private function getSubscribers() {
		return [
			new MyEventAdminPageSubscriber( [
				new MyEventAdminPage( __DIR__ . '/Views' )
			] ),
			new MyEventAdminStyleSubscriber(),
			new MyEventFrontStyleSubscriber(),
			new MyEventLanguageSubscriber()
		];
	}
}
