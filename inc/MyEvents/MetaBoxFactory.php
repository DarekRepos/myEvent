<?php


namespace MetaBox;

class MetaBoxFactory {
	public static function create( $id, $title, $template, $screens = [], $context = 'advanced', $priority = 'default' ) {
		return new MetaBoxBase( $id, $title, $template, $screens, $context, $priority );
	}
}