<?php


namespace MyEvent\Core;


abstract class MyEventAdminPageRender implements MyEventAdminPageConfigurationInterface {
	protected $template_path;

	public function __construct( $template_path ) {
		$this->template_path = rtrim( $template_path, '/' );
	}

	public function renderPage() {
		$this->renderTemplate( 'page' );
	}

	public function renderOptionField() {
		$this->renderTemplate( 'option_field' );
	}

	public function renderTextColorOptionField() {
		$this->renderTemplate( 'text_color_option_field' );
	}

	public function renderHoverOptionField() {
		$this->renderTemplate( 'hover_option_field' );
	}

	public function renderEventSection() {
		$this->renderTemplate( 'event_section' );
	}

	public function renderEffectSection() {
		$this->renderTemplate( 'effect_section' );
	}

	protected function renderTemplate( $template ) {
		$template_file = $this->template_path . '/' . $template . '.php';

		if ( ! is_readable( $template_file ) ) {
			return;
		}

		include $template_file;
	}
}