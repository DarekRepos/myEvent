<?php


namespace MetaBox;

class MetaBoxFactory {
	public static function create( $id, $title, $template, $screens = [], $context = 'advanced', $priority = 'default' ) {
		return new MyEvent_MetaBox( $id, $title, $template, $screens, $context, $priority );
	}
}