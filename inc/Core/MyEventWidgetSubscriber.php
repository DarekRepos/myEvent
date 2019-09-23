<?php


namespace MyEvent\Core;


class MyEventWidgetSubscriber {

	public static function registerMyeventWidget() {
		add_action( 'widgets_init', function () {
			register_widget( MyEventWidget::class );
		} );
	}


}