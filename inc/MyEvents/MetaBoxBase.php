<?php


namespace MetaBox;

use WP_Post;

class MetaBoxBase {
	private $id;
	private $title;
	private $screens;
	private $context;
	private $priority;
	private $template;

	public function __construct( $id, $title, $template, $screens = [], $context = 'advanced', $priority = 'default' ) {
		if ( is_string( $screens ) ) {
			$screens = (array) $screens;
		}
		$this->id       = $id;
		$this->title    = $title;
		$this->template = rtrim( $template, '/' );
		$this->screens  = $screens;
		$this->context  = $context;
		$this->priority = $priority;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getContext(): string {
		return $this->context;
	}

	/**
	 * @return array|string|WP_Screen
	 */
	public function getScreens() {
		return $this->screens;
	}

	/**
	 * @return string
	 */
	public function getPriority(): string {
		return $this->priority;
	}

	public function get_callback() {
		return [ $this, 'render' ];
	}

	public function render( WP_Post $post ) {
		if ( ! is_readable( $this->template ) ) {
			return;
		}
		include $this->template;
	}
}
