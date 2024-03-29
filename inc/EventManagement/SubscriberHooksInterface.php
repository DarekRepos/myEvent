<?php


namespace MyEvent\EventManagement;

/**
 * SubscriberHooksInterface is used by a class that needs to
 * define which hooks they want to listen to
 */
interface SubscriberHooksInterface {
	/**
	 * Returns an array of hooks that this subscriber wants to register with the WordPress plugin API.
	 *
	 * The array key is the name of the hook. The value can be:
	 * * The method name
	 * * An array with the method name and priority
	 * * An array with the method name, priority and number of accepted arguments
	 *
	 * For instance:
	 * * array('hook_name' => 'method_name')
	 * * array('hook_name' => array('method_name', $priority))
	 * * array('hook_name' => array('method_name', $priority, $accepted_args))
	 *
	 * @return array
	 */
	public static function getSubscribedHooks();
}
