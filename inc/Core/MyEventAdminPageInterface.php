<?php


namespace MyEvent\Core;


interface MyEventAdminPageInterface {
	public function getParentSlug();

	public function getPageTitle();

	public function getMenuTitle();

	public function getCapability();

	public function getSlug();

	public function render_page();
}
