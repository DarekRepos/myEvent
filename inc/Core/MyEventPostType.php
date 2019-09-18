<?php


namespace MyEvent\Core;


use MyEvent\Core\MetaBoxFactory;

Class MyEventPostType {
	public function register() {
		$type = 'myevents';
		$labels = [
			'name'          => esc_html__( 'MyEvent' ),
			'singular_name' => esc_html__( 'MyEvent' )
		];
		$args   = [
			'labels'               => $labels,
			'public'               => true,
			'has_archive'          => true,
			'supports'             => [ 'title', 'editor', 'excerpt' ],
			'register_meta_box_cb' => [ $this, 'myevents_metaboxes_callback' ]
		];
		//TODO: fix permanent links
		register_post_type( $type, $args );
	}

	public function myevents_metaboxes_callback() {
		//TODO add languages support
		$template_location = plugin_dir_path( __DIR__ ) . 'Views/location-metabox-view.php';
		$template_date     =  plugin_dir_path( __DIR__ ) .'Views/date-metabox-view.php';
		$template_time     =  plugin_dir_path( __DIR__ ) .'Views/time-metabox-view.php';

		$meta_box_location = MetaBoxFactory::create( 'myEvents_location', esc_html__('Event Location'), $template_location, 'myevents', 'normal' );
		$meta_box_date     = MetaBoxFactory::create( 'myEvents_date', esc_html__('Event date'), $template_date, 'myevents', 'side' );
		$meta_box_time     = MetaBoxFactory::create( 'myEvents_time', esc_html__('Event time'), $template_time, 'myevents', 'side' );

		add_meta_box( $meta_box_location->getId(),
			$meta_box_location->getTitle(),
			$meta_box_location->getCallback(),
			$meta_box_location->getScreens(),
			$meta_box_location->getContext(),
			$meta_box_location->getPriority() );

		add_meta_box( $meta_box_date->getId(),
			$meta_box_date->getTitle(),
			$meta_box_date->getCallback(),
			$meta_box_date->getScreens(),
			$meta_box_date->getContext(),
			$meta_box_date->getPriority() );

		add_meta_box( $meta_box_time->getId(),
			$meta_box_time->getTitle(),
			$meta_box_time->getCallback(),
			$meta_box_time->getScreens(),
			$meta_box_time->getContext(),
			$meta_box_time->getPriority() );

	}
}
