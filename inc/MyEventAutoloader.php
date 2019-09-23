<?php

namespace MyEvent\MyEventAutoloader;

use Exception;

class MyEventAutoloader {

	protected $prefixes = [];

	public function register() {

		try {
			spl_autoload_register( [ $this, 'loadClass' ] );
		} catch ( Exception $e ) {
			//do nothing
		}

	}

	public function addNamespace( $prefix, $base_dir, $prepend = false ) {
		$prefix = trim( $prefix, '\\' ) . '\\';

		$base_dir = rtrim( $base_dir, DIRECTORY_SEPARATOR ) . '/';

		if ( isset( $this->prefixes[ $prefix ] ) === false ) {
			$this->prefixes[ $prefix ] = [];
		}

		if ( $prepend ) {
			array_unshift( $this->prefixes[ $prefix ], $base_dir );
		} else {
			array_push( $this->prefixes[ $prefix ], $base_dir );
		}
	}

	public function loadClass( $class ) {
		$prefix = $class;
		while ( false !== $pos = strrpos( $prefix, '\\' ) ) {
			$prefix         = substr( $class, 0, $pos + 1 );
			$relative_class = substr( $class, $pos + 1 );
			$mapped_file    = $this->loadMappedFile( $prefix, $relative_class );
			if ( $mapped_file ) {
				return $mapped_file;
			}
			$prefix = rtrim( $prefix, '\\' );
		}

		return false;
	}

	protected function loadMappedFile( $prefix, $relative_class ) {
		if ( isset( $this->prefixes[ $prefix ] ) === false ) {
			return false;
		}
		foreach ( $this->prefixes[ $prefix ] as $base_dir ) {
			$file = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

			if ( $this->requireFile( $file ) ) {
				return $file;
			}
		}

		return false;
	}

	protected function requireFile( string $file ) {
		if ( file_exists( $file ) ) {
			require $file;

			return true;
		}

		return false;
	}
}