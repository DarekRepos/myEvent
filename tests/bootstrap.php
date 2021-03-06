<?php
// phpcs:disable
/**
 * This is the bootstrap file for Unit Tests -- run using composer unit-tests
 */

//Manually include plugin
include_once dirname(__FILE__, 2) . '/myEvent.php';


/** Translation compatibility */
if (! function_exists('translate')) {
	/**
	 * @param string $text
	 * @return string mixed
	 */
	function translate($text)
	{
		return $text;
	}
}
if (! function_exists('__')) {
	/**
	 * @param string $text   Text to translate.
	 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
	 *                       Default 'default'.
	 * @return string Translated text.
	 */
	function __($text, $domain = 'default')
	{
		return translate($text, $domain);
	}
}
