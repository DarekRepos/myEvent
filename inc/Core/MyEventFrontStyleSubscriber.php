<?php


namespace MyEvent\Core;


use MyEvent\EventManagement\SubscriberHooksInterface;

class MyEventFrontStyleSubscriber implements SubscriberHooksInterface {

	public static function getSubscribedHooks() {
		return [
			'wp_enqueue_scripts' => 'loadFrontPagesStyle'
		];
	}

	public function loadFrontPagesStyle( ) {
		wp_enqueue_style( 'widget_css',
			plugin_dir_url( dirname( __FILE__, 3 ) . '/assets/css/widget.css' ) . 'widget.css' );


		$options = get_option( 'myevent_option' );

		$border_value = (
		    empty( $options['myevents_admin_page-hover-option'] )
			? 'none' :
			$options['myevents_admin_page-hover-option']
		);

		$color      = '#ddd';
		$custom_css = '';

		if ( $border_value == 'border' ) {
			$custom_css = "
                .events-box:hover{
                        border: 1px solid {$color};
                }";
		}

		$text_color_value = (
		empty( $options['myevents_admin_page-text-color-option'] )
			? 'none' :
			$options['myevents_admin_page-text-color-option']
		);

		$custom_css .= "
            .events-box {
            color: " . $text_color_value. ";
            }";

		wp_add_inline_style( 'widget_css', $custom_css );
	}
}