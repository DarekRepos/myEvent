<?php


namespace MyEvent\EventManagement;

//TODO: add unit test

/**
 * PluginAPIManager handles registering actions and hooks with the
 * WordPress Plugin API.
 */
class PluginAPIManager {
	/**
	 * Adds a callback to a specific hook of the WordPress plugin API.
	 *
	 * @uses add_filter()
	 *
	 * @param $hook_name
	 * @param $callback
	 * @param $priority
	 * @param $accepted_args
	 * @return void
	 */
	public function addCallback($hook_name, $callback, $priority = 10, $accepted_args = 1 ) {
		add_filter( $hook_name, $callback, $priority, $accepted_args );
	}

	/**
	 * Executes all the callbacks registered with the given hook.
	 *
	 * @return mixed
	 * @uses do_action()
	 *
	 * @param string $hook_name
	 *
	 */
	public function execute() {
		$args = func_get_args();

		return call_user_func_array( 'do_action', $args );
	}

	/**
	 * Filters the given value by applying all the changes from the callbacks
	 * registered with the given hook. Returns the filtered value.
	 *
	 * @uses apply_filters()
	 *
	 * @param string $hook_name
	 * @param mixed  $value
	 *
	 * @return mixed
	 */
	public function filter() {
		$args = func_get_args();

		return call_user_func_array( 'apply_filters', $args );
	}

	/**
	 * Get the name of the hook that WordPress plugin API is executing. Returns
	 * false if it isn't executing a hook.
	 *
	 * @uses current_filter()
	 *
	 * @return string|bool
	 */
	public function getCurrentHook() {
		return current_filter();
	}

	/**
	 * Checks the WordPress plugin API to see if the given hook has
	 * the given callback. The priority of the callback will be returned
	 * or false. If no callback is given will return true or false if
	 * there's any callbacks registered to the hook.
	 *
	 * @param string $hook_name
	 * @param mixed  $callback
	 *
	 * @return bool|int
	 * @uses has_filter()
	 *
	 */
	public function hasCallback(string $hook_name, $callback = false )
	{
		return has_filter( $hook_name, $callback );
	}

	/**
	 * Removes the given callback from the given hook. The WordPress plugin API only
	 * removes the hook if the callback and priority match a registered hook.
	 *
	 * @param string   $hook_name
	 * @param callable $callback
	 * @param int $priority
	 *
	 * @return bool
	 * @uses remove_filter()
	 *
	 */
	public function removeCallback(string $hook_name, $callback, int $priority = 10 ): bool
	{
		return remove_filter( $hook_name, $callback, $priority );
	}

	/**
	 * Registers an object with the WordPress Plugin API.
	 *
	 * @param mixed $object
	 */
	public function register($object)
	{
		if ($object instanceof ActionHookSubscriberInterface) {
			$this->registerActions($object);
		}
		if ($object instanceof FilterHookSubscriberInterface) {
			$this->registerFilters($object);
		}
	}

	/**
	 * Registers an object with all its action hooks.
	 *
	 * @param FilterHookSubscriberInterface $object
	 * @return void
	 */
	private function registerFilters(FilterHookSubscriberInterface $object)
	{
		foreach ($object->getFilters() as $name => $parameters) {
			$this->registerFilter($object, $name, $parameters);

		}
	}

	/**
	 * Registers an object with all its filter hooks.
	 *
	 * @param ActionHookSubscriberInterface $object
	 * @return void
	 */
	private function registerActions(ActionHookSubscriberInterface $object)
	{
		foreach ($object->getActions() as $name => $parameters) {
			$this->registerAction($object, $name, $parameters);
		}
	}

	/**
	 * Register an object with a specific action hook.
	 *
	 * @uses add_filter()
	 *
	 * @param FilterHookSubscriberInterface $object
	 * @param string $name
	 * @param $parameters
	 * @return void
	 */
	private function registerFilter(FilterHookSubscriberInterface $object, string $name, $parameters)
	{
		if (is_string($parameters)) {
			add_filter($name, array($object, $parameters));
		} elseif (is_array($parameters) && isset($parameters[0])) {
			add_filter($name, array($object, $parameters[0]), isset($parameters[1]) ? $parameters[1] : 10, isset($parameters[2]) ? $parameters[2] : 1);
		}
	}

	/**
	 * Register an object with a specific filter hook.
	 *
	 * @uses add_action()
	 *
	 * @param ActionHookSubscriberInterface $object
	 * @param string $name
	 * @param $parameters
	 * @return void
	 */
	private function registerAction(ActionHookSubscriberInterface $object, string $name, $parameters)
	{
		if (is_string($parameters)) {
			add_action($name, array($object, $parameters));
		} elseif (is_array($parameters) && isset($parameters[0])) {
			add_action($name, array($object, $parameters[0]), isset($parameters[1]) ? $parameters[1] : 10, isset($parameters[2]) ? $parameters[2] : 1);
		}
	}

}
