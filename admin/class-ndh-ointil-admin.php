<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://nguyenduyhoang.com/
 * @since      1.0.0
 *
 * @package    Ndh_Ointil
 * @subpackage Ndh_Ointil/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ndh_Ointil
 * @subpackage Ndh_Ointil/admin
 * @author     Nguyễn Duy Hoàng <hoanghaiz159@gmail.com>
 */
class Ndh_Ointil_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ndh_Ointil_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ndh_Ointil_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ndh-ointil-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ndh_Ointil_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ndh_Ointil_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ndh-ointil-admin.js', array( 'jquery' ), $this->version, false );

	}

	




	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		* Add a settings page for this plugin to the Settings menu.
		*
		* NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		*
		*        Administration Menus: http://codex.wordpress.org/Administration_Menus
		*
		*/
		add_options_page( 'Open In New Tab Internal Link', 'Open In New Tab Internal Link', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
		);
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/ndh-ointil-admin-display.php' );
	}

	public function validate($input) {
		// All checkboxes inputs        
		$valid = array();
	
		$valid['active'] = (isset($input['active']) && !empty($input['active'])) ? 1 : 0;
	
		return $valid;
	}

	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

	public function ointil() {
		$options = get_option($this->plugin_name);
		if(isset($options['active']) && !empty($options['active'])){

			add_filter('the_content', 'ointil_custom_the_content');
			function ointil_custom_the_content($content) {
				$content = ointil_custom_content($content, get_the_ID());
				return $content;
			}

			function ointil_custom_content($content, $post_id) {
				if(!$content) {
					return $content;
				}

				$dom = new \DOMDocument();
				$libxml_previous_state = libxml_use_internal_errors(true);
				$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
				libxml_use_internal_errors($libxml_previous_state);

				$ahrefs = $dom->getElementsByTagName('a');

				foreach($ahrefs as $ahref) {
					$ahref->setAttribute('target', '_blank');
				}
				$content = html_entity_decode($dom->saveHTML());

				return $content;
			}

		}
	}






}
