<?php

// DONE:30 Remove unnecessary functionality and add own

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://twitter.com/zerofoolcoder
 * @since      1.0.0
 *
 * @package    Tal_Tm_Swr
 * @subpackage Tal_Tm_Swr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tal_Tm_Swr
 * @subpackage Tal_Tm_Swr/admin
 * @author     0FC <zerofoolcoder@gmail.com>
 */
class Tal_Tm_Swr_Admin {

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

      $this->load_dependencies();
      $this->plugin_name = $plugin_name;
      $this->version = $version;
      $this->tal_tm_swr_options = get_option($this->plugin_name);
      $this->tal_tm_swr_forms = Tal_Tm_Swr_Model::get_forms();

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
         * defined in Tal_Tm_Swr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tal_Tm_Swr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tal-tm-swr-admin.css', array(), $this->version, 'all' );

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
         * defined in Tal_Tm_Swr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tal_Tm_Swr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tal-tm-swr-admin.js', array( 'jquery' ), $this->version, false );

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
        add_options_page( 'Talentua TallerMasters Songwriter Reviewer Setup', 'Tal TM Reviewer', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
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
        include_once( 'partials/tal-tm-swr-admin-display.php' );
    }

    /**
     *  Save the plugin options
     *
     *
     * @since    1.0.0
     */
    public function options_update() {
        register_setting( $this->plugin_name, $this->plugin_name, array($this, 'validate') );
    }


    /**
     * Validate all options fields
     *
     * @since    1.0.0
     */
    public function validate($input) {
        // All checkboxes inputs
        $valid = array();

        //Cleanup
        $valid['selected_ninja_form'] = (isset($input['selected_ninja_form']) && !empty($input['selected_ninja_form'])) ? $input['selected_ninja_form'] : 0;

        return $valid;
    }

    /**
     * Utility functions
     *
     * @since    1.0.0
     */

     private function load_dependencies() {

   		/**
   		 * The function responsible for loading the classes needed by the public-facing side of the site
   		 * core plugin.
   		 */
   		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-model.php';

   	}

}