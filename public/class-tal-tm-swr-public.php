<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://twitter.com/zerofoolcoder
 * @since      1.0.0
 *
 * @package    Tal_Tm_Swr
 * @subpackage Tal_Tm_Swr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tal_Tm_Swr
 * @subpackage Tal_Tm_Swr/public
 * @author     0FC <zerofoolcoder@gmail.com>
 */
class Tal_Tm_Swr_Public {

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
	 * The model.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $model    The model of this plugin.
	 */
	private $model;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->tal_tm_swr_options = get_option($this->plugin_name);

		$this->load_dependencies();
		$this->model = new Tal_Tm_Swr_Model();

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
		 * defined in Tal_Tm_Swr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tal_Tm_Swr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tal-tm-swr-public.css' );
		 wp_enqueue_style( $this->plugin_name );
		 //wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tal-tm-swr-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tal-tm-swr-public.js', array( 'jquery' ), $this->version, false );

	}

	// Shortcode function to load / save the songwriter reviewer form
	public function tal_tm_swr_reviewer() {
		if (is_admin()) return;

		// Update Candidate status in case we have submitted information
		if($this->form_submitted()) $this->update_candidate();

		// If we have a ninja form to work with, then continue
		if(!empty($this->tal_tm_swr_options['selected_ninja_form'])) $this->display_plugin_reviewer_page();
	}

	public function tal_tm_swr_list() {
		if (is_admin()) return;
		$this->display_plugin_list_page();
	}

	/**
	 * Render the reviewer page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_reviewer_page() {
		$Casting = Tal_Tm_Swr_Kreator::createCasting(Tal_Tm_Swr_Model::get_submissions($this->tal_tm_swr_options['selected_ninja_form']));

//		$Casting = $this->model->getCastingCandidate($this->tal_tm_swr_options['selected_ninja_form']);
		$Casting->getCastingCandidatesSummary();

		include_once( 'partials/tal-tm-swr-public-display.php' );
	}

	public function display_plugin_list_page() {
		$Casting = Tal_Tm_Swr_Kreator::createCasting(Tal_Tm_Swr_Model::get_submissions($this->tal_tm_swr_options['selected_ninja_form']));

		include_once( 'partials/tal-tm-swr-public-display-list.php' );
	}

	public function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])) {
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        } else if(isset($qs['vi'])) {
            return $qs['vi'];
        }
    }

    if(isset($parts['path'])) {
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }

    return false;
  }

  private function update_candidate() {

		$_post_id = esc_attr($_GET['_post_id']);
		$status = esc_attr($_GET['status']);
		$this->model->updateCandidate($_post_id, $status);

  }

	private function form_submitted() {
		if (isset($_GET['_post_id']) && isset($_GET['status'])) return true;

		return false;
	}

	private function load_dependencies() {

		/**
		 * The function responsible for loading the classes needed by the public-facing side of the site
		 * core plugin.
		 */
		 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-model.php';
		 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-kreator.php';

	}
}
