<?php

namespace MyEvent\Core;

use MyEvent\EventManagement\ActionHookSubscriberInterface;
use MyEvent\EventManagement\FilterHookSubscriberInterface;

/**
 *
 */
class MyEventActionFilterManager implements ActionHookSubscriberInterface, FilterHookSubscriberInterface
{


	/**
	 * Get the action hooks Plugin subscribes to.
	 *
	 * @return string[]
	 */
	public static function getActions()
	{
		return array(
			'wp_loaded' => 'load',
			'init' => 'loadTextDomain',
			'widgets_init' => 'registerMyeventWidget'
		);
	}

	/**
	 * Get the filter hooks Plugin subscribes to.
	 *
	 * @return array|void
	 */
	public static function getFilters()
	{
		// TODO: Implement getFilters method.
	}

	/**
	 * Loading language files and register text doain
	 * @return void
	 */
	public function loadTextDomain()
	{
        //TODO:use filter method from MyEventActionFilterManager class
		$locale = apply_filters("plugin_locale", get_locale(), 'my-event-lang');
		if (file_exists(dirname(__FILE__) . '/languages/' . $locale . '.mo')) {
			load_textdomain('my-event-lang', dirname(plugin_basename(__FILE__)) . '/languages/' . $locale . '.mo');

		}

		load_plugin_textdomain('my-event-lang',	false,	dirname(plugin_basename(__FILE__),3) . '/languages');

	}

	/**
	 * Loading the widget
	 * @return void
	 */
	public function registerMyeventWidget()
	{
		register_widget(MyEventWidget::class);
	}

}

