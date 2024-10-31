<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.andyboehm.com
 * @since      1.0.0
 *
 * @package    Multisites_In_Link_Search
 * @subpackage Multisites_In_Link_Search/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Multisites_In_Link_Search
 * @subpackage Multisites_In_Link_Search/admin
 * @author     Andy Boehm <boehmgraphics@gmail.com>
 */
class Multisites_In_Link_Search_Admin {

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
		 * defined in Multisites_In_Link_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Multisites_In_Link_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/multisites-in-link-search-admin.css', array(), $this->version, 'all' );

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
		 * defined in Multisites_In_Link_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Multisites_In_Link_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/multisites-in-link-search-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function chech_has_internal_links_plugin() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'better-internal-link-search/better-internal-link-search.php' ) ) {
			add_action( 'admin_notices', function(){
				?><div class="error"><p>Sorry, but Multisites In Link Search requires the Better Internal Link Search plugin to be installed and active.</p></div><?php
			} );
			//die($this->plugin_name);
			deactivate_plugins( "multisites-in-better-link-search/multisites-in-link-search.php"); 
	
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}

	}

	public function chech_is_multisite() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_multisite() ) {
			add_action( 'admin_notices', function(){
				?><div class="error"><p>Sorry, but Multisites In Link Search only works for multisite installs of wordpress.</p></div><?php
			} );
			//die($this->plugin_name);
			deactivate_plugins( "multisites-in-better-link-search/multisites-in-link-search.php"); 
	
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}

	}


	public function ab_default_modifier_help( $results ) {
		$modifiers = array(
			'sites' => array(
				'title'     => sprintf(
					'<strong>-sites {query}</strong></span><span class="item-description">%s</span>',
					__( 'Search the multisites', 'better-internal-link-search' )
				),
				'permalink' => 'https://codex.wordpress.org/',
				'info'      => __( 'Multisites in blog', 'better-internal-link-search' ),
			),
		);

		return array_merge( (array) $results, $modifiers );
	}

	public function ab_multisite_search( $results, $args ) {
		
		//$args['s']
		
		//$username = ( ! empty( $args['s'] ) ) ? $args['s'] : 'bradyvercher';

		$search_args = array(
			'page'     => $args['page'],
			'per_page' => $args['per_page'],
		);
		$searchArgs = array();
		//todo - makes this work for search name and description too
		// currently only searchs path/domain which is misleading since the site name is shown
		if (!empty($args['s'])){
			$searchArgs = array(
				"search" => $args['s']
			);
		}
		$response = get_sites($searchArgs);

		//die("<pre>".print_r($response->results->hits->hit,1)."</pre>");

		foreach($response as $key => $value){
			$subsite_id = $value->blog_id;
			$subsite_name = get_blog_details($subsite_id)->blogname;
			$substie_url = get_blog_details($subsite_id)->siteurl;

			$results[] = array(
				'title'     => trim( esc_html( $subsite_name) ),
				'permalink' => esc_url( $substie_url ),
				'info'      => esc_html( "Multisite" ),
			);
		}


		return $results;
	}


}
