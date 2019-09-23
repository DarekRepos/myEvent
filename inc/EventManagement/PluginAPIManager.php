<?php


namespace MyEvent\EventManagement;


class PluginAPIManager {
	public function addCallback( $hook_name, $callback, $priority = 10, $accepted_args = 1 ) {
		add_filter( $hook_name, $callback, $priority, $accepted_args );
	}

	public function execute() {
		$args = func_get_args();

		return call_user_func_array( 'do_action', $args );
	}

	public function filter() {
		$args = func_get_args();

		return call_user_func_array( 'apply_filters', $args );
	}

	public function getCurrentHook() {
		return current_filter();
	}

	public function hasCallback( $hook_name, $callback = false ) {
		return has_filter( $hook_name, $callback );
	}

	public function removeCallback( $hook_name, $callback, $priority = 10 ) {
		return remove_filter( $hook_name, $callback, $priority );
	}
}