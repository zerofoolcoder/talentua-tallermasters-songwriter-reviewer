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

	private $tal_tm_swr_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		//spl_autoload_register(array($this, 'loadDependency'));

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->tal_tm_swr_options = get_option($this->plugin_name);
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
		wp_localize_script( $this->plugin_name, 'tal_tm_swr_review_candidate', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));

	}

	// Shortcode function to load / save the songwriter reviewer form
	public function tal_tm_swr_reviewer($atts) {
		if (is_admin()) return;

		// If we have a ninja form to work with, then continue
		$status = shortcode_atts( array('status' => ''), $atts );
		if(!empty($this->tal_tm_swr_options['selected_ninja_form'])) $this->display_plugin_reviewer_page($status['status']);
	}

	// Shortcode function to show a list of candidates
	public function tal_tm_swr_list() {
		if (is_admin()) return;

		// Check if we need to apply a filter
		$statusEnum = Tal_Tm_Swr_Abstract_Status_Enum::enum();
		$filter = null;
		if($this->form_submitted()) $filter = $statusEnum[$_GET['filter']];

		$this->display_plugin_list_page($filter);
	}

	// Action function to update the status of a candidate
	public function tal_tm_swr_review_candidate() {
		$this->update_candidate($_POST['sub_id'], $_POST['status']);
		$response = new WP_Ajax_Response;

		// Proceed, again we are checking for permissions
		$response->add( array(
			'data'	=> 'success',
			'supplemental' => array(
				'sub_id' => $_POST['sub_id'],
				'status' => $_POST['status'],
				'message' => 'This candidate has been updated successfully',
			),
		));

		// Whatever the outcome, send the Response back
		$response->send();

		// Always exit when doing Ajax
		exit();
	}

	/**
	 * Render the reviewer page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_reviewer_page($status) {
		$Casting = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Casting);
		$Casting->loadCandidates($this->tal_tm_swr_options['selected_ninja_form'], $status);

		include_once( 'partials/tal-tm-swr-public-display.php' );
	}

	public function display_plugin_list_page($filter) {
		$Casting = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Casting);
		$Casting->loadCandidates($this->tal_tm_swr_options['selected_ninja_form'], $filter);

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

  private function update_candidate($sub_id, $status) {
		Tal_Tm_Swr_Model::updateCandidate($sub_id, $status);
  }

	private function form_submitted() {
		if ( (isset($_GET['_post_id']) && isset($_GET['status'])) ||
				 (isset($_GET['filter']))) return true;

		return false;
	}

}
