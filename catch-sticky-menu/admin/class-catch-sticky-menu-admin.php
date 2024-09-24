<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Sticky_Menu
 * @subpackage Catch_Sticky_Menu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Catch_Sticky_Menu
 * @subpackage Catch_Sticky_Menu/admin
 * @author     Catch Plugins <www.catchplugins.com>
 */
class Catch_Sticky_Menu_Admin {

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
		$this->version     = $version;

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
		 * defined in Catch_Sticky_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Catch_Sticky_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		if( isset( $_GET['page'] ) && 'catch-sticky-menu' == $_GET['page'] ) {
			wp_enqueue_style( $this->plugin_name. '-display-dashboard', plugin_dir_url( __FILE__ ) . 'css/catch-sticky-menu-admin.css', array(), $this->version, 'all' );
		}
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
		 * defined in Catch_Sticky_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Catch_Sticky_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( isset( $_GET['page'] ) && 'catch-sticky-menu' == $_GET['page'] ) {
			wp_enqueue_script( 'matchHeight', plugin_dir_url( __FILE__ ) . 'js/jquery-matchHeight.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/catch-sticky-menu-admin.js', array( 'jquery', 'matchHeight', 'jquery-ui-tooltip' ), $this->version, false );
			 wp_enqueue_script( 'catch-sticky-menu-color-picker', plugin_dir_url( __FILE__ ) . 'js/wp-color-picker.js', array( 'wp-color-picker', 'jquery' ), $this->version, false );
		}

	}

	/**
	 * Catch Sticky Menu: action_links
	 * Catch Sticky Menu Settings Link function callback
	 *
	 * @param arrray $links Link url.
	 *
	 * @param arrray $file File name.
	 */
	public function action_links( $links, $file ) {
		if ( $file === $this->plugin_name . '/' . $this->plugin_name . '.php' ) {
			$settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=catch-sticky-menu' ) ) . '">' . esc_html__( 'Settings', 'catch-sticky-menu' ) . '</a>';

			array_unshift( $links, $settings_link );
		}
		return $links;
	}

	public function add_plugin_settings_menu() {
		add_menu_page(
			esc_html__( 'Catch Sticky Menu', 'catch-sticky-menu' ), // $page_title.
			esc_html__( 'Catch Sticky Menu', 'catch-sticky-menu' ), // $menu_title.
			'manage_options', // $capability.
			'catch-sticky-menu', // $menu_slug.
			array( $this, 'settings_page' ), // $callback_function.
			'dashicons-pressthis', // $icon_url.
			'99.01564' // $position.
		);
		add_submenu_page(
			'catch-sticky-menu', // $parent_slug.
			esc_html__( 'Catch Sticky Menu', 'catch-sticky-menu' ), // $page_title.
			esc_html__( 'Settings', 'catch-sticky-menu' ), // $menu_title.
			'manage_options', // $capability.
			'catch-sticky-menu', // $menu_slug.
			array( $this,'settings_page' ) // $callback_function.
		);
	}


	public function settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'catch-sticky-menu' ) );
		}
		require plugin_dir_path( __FILE__ ) . 'partials/catch-sticky-menu-admin-display.php';
	}

	public function register_settings() {
		register_setting(
			'catch-sticky-menu-group',
			'catch_sticky_menu_options',
			array( $this, 'sanitize_callback' )
		);
	}

	public function sanitize_callback( $input ) {
		if ( isset( $input['reset'] ) && $input['reset'] ) {
			//If reset, restore defaults
			return catch_sticky_menu_default_options();
		}
		$message = null;
		$type    = null;

		// Verify the nonce before proceeding.
	    if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	    	|| ( ! isset( $_POST['catch_sticky_menu_nounce'] )
	    	|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['catch_sticky_menu_nounce'] ) ), basename( __FILE__ ) ) )
	    	|| ( ! check_admin_referer( basename( __FILE__ ), 'catch_sticky_menu_nounce' ) ) ) {
	    	if ( null !== $input ) {

					$input['status']                       = ( isset( $input['status'] ) && '1' == $input['status'] ) ? '1' : '0';
					if ( isset( $input['sticky_desktop_menu_selector'] ) ) {
					$input['sticky_desktop_menu_selector'] = sanitize_text_field( $input['sticky_desktop_menu_selector'] );
					}
					if ( isset( $input['sticky_mobile_menu_selector'] ) ) {
					$input['sticky_mobile_menu_selector']  = sanitize_text_field( $input['sticky_mobile_menu_selector'] );
					}
					if ( isset( $input['sticky_background_color'] ) && $input['sticky_background_color'] ) {
					$input['sticky_background_color']      = sanitize_hex_color( $input['sticky_background_color'] );
					}
					if ( isset( $input['sticky_text_color'] ) && $input['sticky_text_color'] ) {
					$input['sticky_text_color']            = sanitize_hex_color( $input['sticky_text_color'] );
					}
					if ( isset( $input['sticky_z_index'] ) && $input['sticky_z_index'] ) {
					$input['sticky_z_index']               = intval( $input['sticky_z_index'] );
					}
					if ( isset( $input['sticky_opacity'] ) && $input['sticky_opacity'] ) {
					$input['sticky_opacity']               = floatval( $input['sticky_opacity'] );
					}
					if ( isset( $input['enable_only_on_home'] ) && $input['enable_only_on_home'] ) {
					$input['enable_only_on_home']          = sanitize_key( $input['enable_only_on_home'] );
					}
				
			    return $input;
		    } 
		    return 'Invalid Nonce';
		}
	}
	function add_plugin_meta_links( $meta_fields, $file ){
		if( CATCH_STICKY_MENU_BASENAME == $file ) {
			$meta_fields[] = "<a href='https://catchplugins.com/support-forum/forum/catch-sticky-menu/' target='_blank'>Support Forum</a>";
			$meta_fields[] = "<a href='https://wordpress.org/support/plugin/catch-sticky-menu/reviews/#new-post' target='_blank' title='Rate'>
			        <i class='ct-rate-stars'>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "</i></a>";

			$stars_color = "#ffb900";

			echo "<style>"
				. ".ct-rate-stars{display:inline-block;color:" . $stars_color . ";position:relative;top:3px;}"
				. ".ct-rate-stars svg{fill:" . $stars_color . ";}"
				. ".ct-rate-stars svg:hover{fill:" . $stars_color . "}"
				. ".ct-rate-stars svg:hover ~ svg{fill:none;}"
				. "</style>";
		}

		return $meta_fields;
	}
}

