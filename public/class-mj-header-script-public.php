<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MJ_Header_Script
 * @subpackage MJ_Header_Script/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    MJ_Header_Script
 * @subpackage MJ_Header_Script/public
 * @author     JP Baroma <jonathanbaroma@mediajel.com>
 */
class MJ_Header_Script_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $MJ_Header_Script    The ID of this plugin.
	 */
	private $MJ_Header_Script;

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
	 * @param      string    $MJ_Header_Script       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $MJ_Header_Script, $version ) {

		$this->MJ_Header_Script = $MJ_Header_Script;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in MJ_Header_Script_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MJ_Header_Script_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->MJ_Header_Script, plugin_dir_url( __FILE__ ) . 'css/plugin-name-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in MJ_Header_Script_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MJ_Header_Script_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->MJ_Header_Script, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the script on the header.
	 *
	 * @since    1.0.0
	 */
	public function jpb_display_header_script() {

		/**
		 * Display the header script
		 */
		$mj_scripts_options = get_option( 'mediajel_scripts_option_name' ); // Array of All Options

		$hs_app_id = $mj_scripts_options['jpb_header_script_app_id'];
		$hs_testing = $mj_scripts_options['jpb_header_script_testing'];

		if ($hs_testing == "jpb_header_script_testing") {
			echo '<script src="https://tags.mediajel.ninja/?appId='.$hs_app_id.'"></script>';
		}
		else {
			echo '<script src="https://tags.cnna.io/?appId='.$hs_app_id.'"></script>';
		}

		

	}

	

}
