<?php


namespace MyEvent\Core;

//Do not support multisite options

class MyEventOptions {

	private $prefix;

	public function __construct( $prefix = '' ) {
		$this->prefix = $prefix;
	}

	public function init( $name ) {
		if ( false == get_option( $this->prefix . $name ) ) {
			add_option( $this->prefix . $name );
		}
	}

	public function remove( $name ) {
		delete_option( $this->getOptionName( $name ) );
	}

	public function getOptionName( $name ) {
		return $this->prefix . $name;
	}

	public function set( $name, $value ) {
		update_option( $this->getOptionName( $name ), $value );
	}

	public function has( $name ) {
		return null !== $this->get( $name );
	}

	public function get( $name, $default = null ) {
		$option = get_option( $this->getOptionName( $name ), $default );

		if ( is_array( $default ) && ! is_array( $option ) ) {
			$option = (array) $option;
		}

		return $option;
	}
}