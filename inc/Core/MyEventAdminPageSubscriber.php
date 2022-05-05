<?php


namespace MyEvent\Core;


use MyEvent\EventManagement\SubscriberHooksInterface;

class MyEventAdminPageSubscriber implements SubscriberHooksInterface {
	private $admin_pages;

	public function __construct( array $admin_pages ) {
		$this->admin_pages = [];

		foreach ( $admin_pages as $admin_page ) {
			$this->addAdminPage( $admin_page );
		}
	}

	private function addAdminPage( MyEventAdminPageInterface $admin_page ) {
		$this->admin_pages[] = $admin_page;
	}

	public static function getSubscribedHooks() {
		return [
			'admin_init' => 'adminPagesConfiguration',
			'admin_menu' => 'add_admin_pages'
		];
	}

	public function add_admin_pages() {

		foreach ( $this->admin_pages as $admin_page ) {
			add_submenu_page(
				$admin_page->getParentSlug(),
				$admin_page->getPageTitle(),
				sprintf( esc_html__( 'Moje %s', 'my-event-lang' ), $admin_page->getMenuTitle() ),
				$admin_page->getCapability(),
				$admin_page->getSlug(),
				[
					$admin_page,
					'renderPage'
				]
			);
		}
	}

	public function adminPagesConfiguration() {
		foreach ( $this->admin_pages as $admin_page ) {
			if ( $admin_page instanceof MyEventAdminPageConfigurationInterface ) {
				$admin_page->configure();
			}
		}
	}

}
