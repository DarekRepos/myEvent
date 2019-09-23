<?php


namespace MyEvent\EventManagement;


class EventManager extends PluginAPIManager {
	public function addSubscriber( SubscriberHooksInterface $subscriber ) {
		foreach ( $subscriber->getSubscribedHooks() as $hook_name => $parameters ) {
			$this->addSubscriberCallback( $subscriber, $hook_name, $parameters );
		}
	}

	private function addSubscriberCallback( SubscriberHooksInterface $subscriber, $hook_name, $parameters ) {
		if ( is_string( $parameters ) ) {
			$this->addCallback( $hook_name, [ $subscriber, $parameters ] );
		} elseif ( is_array( $parameters ) && isset( $parameters[0] ) ) {
			$this->addCallback( $hook_name,
				[ $subscriber, $parameters[0] ],
				isset( $parameters[1] ) ? $parameters[1] : 10,
				isset( $parameters[2] ) ? $parameters[2] : 1 );
		}
	}

	private  function removeSubscriber(SubscriberHooksInterface $subscriber){
		foreach ( $subscriber->getSubscribedHooks() as $hook_name => $parameters ) {
			$this->removeSubscriberCallback( $subscriber, $hook_name, $parameters );
		}
	}

	private function removeSubscriberCallback( SubscriberHooksInterface $subscriber, $hook_name, $parameters ) {
		if ( is_string( $parameters ) ) {
			$this->removeCallback( $hook_name, [ $subscriber, $parameters ] );
		} elseif ( is_array( $parameters ) && isset( $parameters[0] ) ) {
			$this->removeCallback( $hook_name,
				[ $subscriber, $parameters[0] ],
				isset( $parameters[1] ) ? $parameters[1] : 10,
				 );
		}
	}
}