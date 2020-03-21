<?php
/**
 * Plugin Name:       myEvent
 * Plugin URI:        https://github.com/DarekRepos/myEvent
 * Description:       This is the widget displays events dates.
 * Version:           1.0.0
 * Author:            Darek Duda
 * Author URI:        https://dudawebsite.com
 * License:           GPL-2.0+ or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       myEvent
 * Domain Path:       /languages
 */


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


	public function __construct( $file ) {
		$this->pluginsbasename     = plugin_basename( $file );
		$this->myeventposttype     = new MyEventPostType();
		$this->myeventpostypehooks = new MyEventPostTypeHooks();
		//TODO: refactor Widget subscriber - needed instance of object
		$this->myeventwidget = new MyEventWidgetSubscriber();
		$this->myeventwidget->registerMyeventWidget();
		$this->pluginmanager = new EventManager();
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
