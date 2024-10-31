<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://nguyenduyhoang.com/
 * @since      1.0.0
 *
 * @package    Ndh_Ointil
 * @subpackage Ndh_Ointil/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ndh_Ointil
 * @subpackage Ndh_Ointil/includes
 * @author     Nguyễn Duy Hoàng <hoanghaiz159@gmail.com>
 */
class Ndh_Ointil_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ndh-ointil',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
