<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MJ_Header_Script
 * @subpackage MJ_Header_Script/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MJ_Header_Script
 * @subpackage MJ_Header_Script/admin
 * @author     JP Baroma <jonathanbaroma@mediajel.com>
 */
class MJ_Header_Script_Admin {

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
	 * All options for the MediaJel scripts.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $mediajel_scripts_options    An array of options for the MediaJel Scripts.
	 */
	private $mediajel_scripts_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $MJ_Header_Script       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $MJ_Header_Script, $version ) {

		$this->MJ_Header_Script = $MJ_Header_Script;
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
		 * defined in MJ_Header_Script_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MJ_Header_Script_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->MJ_Header_Script, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );

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
		 * defined in MJ_Header_Script_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MJ_Header_Script_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->MJ_Header_Script, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the MediaJel Scripts page
	 *
	 * @since    1.0.0
	 */

	

	public function jpb_add_mediajel_page() {
		
		add_menu_page(
			'MediaJel Settings', // page_title
			'MediaJel Settings', // menu_title
			'manage_options', // capability
			'mediajel-settings', // menu_slug
			array( $this, 'jpb_mediajel_scripts_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			2 // position
		);
		
	}

	public function jpb_mediajel_scripts_create_admin_page() {
		$this->mediajel_scripts_options = get_option( 'mediajel_scripts_option_name' ); ?>

		<div class="wrap">
			<h2>MediaJel Settings</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'mediajel_scripts_option_group' );
					do_settings_sections( 'mediajel-scripts-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	/**
	 * Add the setting sections and fields
	 *
	 * @since    1.0.0
	 */

	

	public function jpb_register_settings() {
		
		register_setting(
			'mediajel_scripts_option_group', // option_group
			'mediajel_scripts_option_name', // option_name
			array( $this, 'jpb_mediajel_scripts_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'header_scripts_setting_section', // id
			'Universal Tracker (MVP)', // title
			array( $this, 'jpb_header_scripts_section_info' ), // callback
			'mediajel-scripts-admin' // page
		);

		add_settings_field(
			'jpb_header_script_app_id', // id
			'APP ID', // title
			array( $this, 'jpb_header_script_app_id_callback' ), // callback
			'mediajel-scripts-admin', // page
			'header_scripts_setting_section' // section
		);

		add_settings_field(
			'jpb_header_script_testing', // id
			'Testing', // title
			array( $this, 'jpb_header_script_testing_callback' ), // callback
			'mediajel-scripts-admin', // page
			'header_scripts_setting_section' // section
		);
	}
		
	

	public function jpb_mediajel_scripts_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['jpb_header_script_app_id'] ) ) {
			$sanitary_values['jpb_header_script_app_id'] = sanitize_text_field( $input['jpb_header_script_app_id'] );
		}

		if ( isset( $input['jpb_header_script_testing'] ) ) {
			$sanitary_values['jpb_header_script_testing'] = $input['jpb_header_script_testing'];
		}

		return $sanitary_values;
	}

	public function jpb_header_scripts_section_info() {
		
	}

	public function jpb_header_script_app_id_callback() {
		printf(
			'<input class="regular-text" type="text" name="mediajel_scripts_option_name[jpb_header_script_app_id]" id="jpb_header_script_app_id" value="%s">',
			isset( $this->mediajel_scripts_options['jpb_header_script_app_id'] ) ? esc_attr( $this->mediajel_scripts_options['jpb_header_script_app_id']) : ''
		);
	}

	public function jpb_header_script_testing_callback() {
		printf(
			'<input type="checkbox" name="mediajel_scripts_option_name[jpb_header_script_testing]" id="jpb_header_script_testing" value="jpb_header_script_testing" %s> <label for="jpb_header_script_testing">Please have this ticked if on testing mode</label>',
			( isset( $this->mediajel_scripts_options['jpb_header_script_testing'] ) && $this->mediajel_scripts_options['jpb_header_script_testing'] === 'jpb_header_script_testing' ) ? 'checked' : ''
		);
	}




}
