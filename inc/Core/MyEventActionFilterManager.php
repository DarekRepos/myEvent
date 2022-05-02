<?php

namespace MyEvent\Core;

use MyEvent\EventManagement\ActionHookSubscriberInterface;
use MyEvent\EventManagement\FilterHookSubscriberInterface;
use MyEvent\EventManagement\PluginAPIManager;

class MyEventActionFilterManager implements ActionHookSubscriberInterface, FilterHookSubscriberInterface
{



	public static function getActions()
	{
		return array(
			'wp_loaded' =>  'load'
		);
	}

	public static function getFilters()
	{
		// TODO: Implement getActions() method.
	}

	//add_action( 'wp_loaded', [ $plugin, 'load' ] );
}
