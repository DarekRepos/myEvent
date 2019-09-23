<?php


namespace MyEvent\Core;


class MyEventAdminPage extends MyEventAdminPageRender implements MyEventAdminPageConfigurationInterface {

	public function getParentSlug() {
		return 'edit.php?post_type=myevents';
	}

	public function getPageTitle() {
		return 'Myevent plugin settings';
	}

	public function getMenuTitle() {
		return 'Settings';
	}

	public function getCapability() {
		return 'manage_options';
	}

	public function getSlug() {
		return 'myevents_admin_page';
	}

	public function configure() {

		$options = new MyEventOptions;

		//TODO: add sanitazon settings
		//TODO: change MyEventOptions
		//TODO: unninstal delete atribute settings, posts delete database
		//TODO: check is admin , can edit page

		register_setting( $this->getSlug() . '-group', $options->getOptionName( 'myevent_option' ) );

		add_settings_section( $this->getSlug() . '-event-section',
			esc_html__( 'Events', 'myevent' ),
			[
				$this,
				'renderEventSection'
			],
			$this->getSlug() );
		add_settings_section( $this->getSlug() . '-effect-section',
			esc_html__( 'Effects', 'myevent' ),
			[
				$this,
				'renderEffectSection'
			],
			$this->getSlug() );
		add_settings_field( $this->getSlug() . '-amount',
			esc_html__( 'Number of events', 'myevent' ),
			[
				$this,
				'renderOptionField'
			],
			$this->getSlug(),
			$this->getSlug() . '-event-section'
		);
		add_settings_field( $this->getSlug() . '-hover-option',
			esc_html__( 'Hover effect', 'myevent' ),
			[
				$this,
				'renderHoverOptionField'
			],
			$this->getSlug(),
			$this->getSlug() . '-effect-section'
		);
		add_settings_field( $this->getSlug() . '-text-color-option',
			esc_html__( 'Text color', 'myevent' ),
			[
				$this,
				'renderTextColorOptionField'
			],
			$this->getSlug(),
			$this->getSlug() . '-effect-section'
		);
	}
}
