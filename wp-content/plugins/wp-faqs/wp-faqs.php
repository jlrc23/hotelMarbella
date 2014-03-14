<?php
/*
Plugin Name: Ninety Degrees FAQs
Plugin URI: http://codecanyon.net/item/wordpress-faqs/137349?sso?WT.ac=portfolio_item&WT.seg_1=portfolio_item&WT.z_author=ninetydegrees
Description: Easily create FAQ pages within your WordPress blog.
Version: 1.1.2
Author: Ninety Degrees
Author URI: http://codecanyon.net/user/ninetydegrees
*/

if ( ! class_exists( 'Ninety_Base' ) )
	include_once( 'classes/class-ninety-base.php' );

/**
 * Ninety_FAQS class.
 */
class Ninety_FAQS extends Ninety_Base {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$this->plugin_id = 'ninety-faqs';
		$this->file      = __FILE__;

		// Localise
		load_plugin_textdomain( 'ninety-faqs', false, dirname( plugin_basename( __FILE__ ) ).'/languages' );

		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( &$this, 'scripts' ) );
			add_action( 'init', array( &$this, 'styles' ) );
		} else {
			add_action( 'admin_print_styles', array( &$this, 'admin_styles' ) );
			add_filter( 'manage_edit-faq-item_columns', array( &$this, 'admin_columns' ) );
			add_action( 'manage_posts_custom_column',  array( &$this, 'admin_custom_columns' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );
			add_filter( 'request', array( &$this, 'menu_order' ) );
		}

		add_action( 'wp_ajax_faq_item_ordering', array( &$this, 'ajax_ordering' ) );

		// Init post types
		add_action( 'init', array( &$this, 'register_post_types' ) );

		// Init shortcodes
		add_shortcode( 'faq', array( &$this, 'faq_shortcode' ) );
	}

	/**
	 * register_post_types function.
	 *
	 * @access public
	 * @return void
	 */
	function register_post_types() {

		register_taxonomy( 'faq-group',
	        array('faq-item'),
	        array(
	            'hierarchical'           => true,
	            'labels'                 => array(
	                'name'               => __( 'FAQ Groups', 'ninety-faqs' ),
	                'singular_name'      => __( 'FAQ Group', 'ninety-faqs' ),
	                'search_items'       => __( 'Search FAQ Groups', 'ninety-faqs' ),
	                'all_items'          => __( 'All FAQ Groups', 'ninety-faqs' ),
	                'parent_item'        => __( 'Parent FAQ Group', 'ninety-faqs' ),
	                'parent_item_colon'  => __( 'Parent FAQ Group:', 'ninety-faqs' ),
	                'edit_item'          => __( 'Edit FAQ Group', 'ninety-faqs' ),
	                'update_item'        => __( 'Update FAQ Group', 'ninety-faqs' ),
	                'add_new_item'       => __( 'Add New FAQ Group', 'ninety-faqs' ),
	                'new_item_name'      => __( 'New FAQ Group Name', 'ninety-faqs' )
	            ),
	            'show_ui'                => true,
	            'query_var'              => true,
	            'rewrite'                => false,
	        )
	    );

		register_post_type( 'faq-item',
	        array(
	            'labels'                 => array(
	                'name'               => __( 'FAQ Items', 'ninety-faqs' ),
	                'singular_name'      => __( 'FAQ Item', 'ninety-faqs' ),
	                'add_new'            => __( 'Add New', 'ninety-faqs' ),
	                'add_new_item'       => __( 'Add New FAQ Item', 'ninety-faqs' ),
	                'edit'               => __( 'Edit', 'ninety-faqs' ),
	                'edit_item'          => __( 'Edit FAQ Item', 'ninety-faqs' ),
	                'new_item'           => __( 'New FAQ Item', 'ninety-faqs' ),
	                'view'               => __( 'View FAQ Items', 'ninety-faqs' ),
	                'view_item'          => __( 'View FAQ Item', 'ninety-faqs' ),
	                'search_items'       => __( 'Search FAQ Items', 'ninety-faqs' ),
	                'not_found'          => __( 'No FAQ Items found', 'ninety-faqs' ),
	                'not_found_in_trash' => __( 'No FAQ Items found in trash', 'ninety-faqs' ),
	                'parent'             => __( 'Parent FAQ Item', 'ninety-faqs' ),
	            ),
	            'description'            => __( 'This is where you can create new FAQ Items for your site.', 'ninety-faqs' ),
	            'public'                 => true,
	            'show_ui'                => true,
	            'capability_type'        => 'post',
	            'publicly_queryable'     => true,
	            'exclude_from_search'    => false,
	            'menu_icon'              => $this->plugin_url() . '/img/faq-icon.png',
	            'hierarchical'           => false,
	            'rewrite'                => false,
	            'query_var'              => true,
	            'supports'               => array( 'title', 'editor' ),
	        )
	    );
	}

	/**
	 * scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function scripts() {
		wp_enqueue_script( 'folding_faq', $this->plugin_url() . '/js/folding.js', array( 'jquery' ), '1.1.0', true );
	}

	/**
	 * styles function.
	 *
	 * @access public
	 * @return void
	 */
	function styles() {
		wp_enqueue_style( 'folding_css',  $this->plugin_url() . '/css/faq.css' );
	}

	/**
	 * admin_styles function.
	 *
	 * @access public
	 * @return void
	 */
	function admin_styles() {
		global $typenow, $post;

		if ( $typenow == 'post' && isset( $_GET['post'] ) && ! empty( $_GET['post'] ) ) {
			$typenow = $post->post_type;
		} elseif ( empty( $typenow ) && ! empty( $_GET['post'] ) ) {
	        $post    = get_post($_GET['post']);
	        $typenow = $post->post_type;
	    }

		if ( $typenow == '' || $typenow == "faq-item" ) {
			wp_enqueue_style( 'faq_admin_css',  $this->plugin_url() . '/css/admin.css' );
		}
	}

	/**
	 * faq_shortcode function.
	 *
	 * @access public
	 * @return void
	 */
	function faq_shortcode( $atts ) {

		extract( shortcode_atts( array(
			'id'         => '',
			'folding'    => true,
			'show_index' => true,
			'name'       => '',
			'slug'       => '',
			'orderby'    => 'title'
		), $atts ) );

		$group_args = array();
		$order_args = array();

		// Get slug from passed data
		if ( empty( $slug ) && ! empty( $name ) ) {
			$term = get_term_by( 'name', $name, 'faq-group' );
			$slug = $term->slug;
		} elseif ( empty( $slug ) && ! empty( $id ) ) {
			$term = get_term_by( 'id', $id, 'faq-group' );
			$slug = $term->slug;
		}

		// Ordering
		if ( $orderby == 'menu_order' ) {
			$order_args = array(
				'orderby' 	=> 'menu_order',
				'order' 	=> 'asc'
			);
		} else {
			$order_args = array(
				'orderby' 	=> 'title',
				'order' 	=> 'asc'
			);
		}

		// If we have a slug then show this bad boy
		if ( ! empty( $slug ) )
			$group_args = array(
				'faq-group' 	=> $slug,
			);

		$args = array_merge( $order_args, $group_args, array(
			'post_type'        => 'faq-item',
			'post_status'      => 'publish',
			'numberposts'      => -1
		) );

		$faq_items = get_posts( $args );

		if ( ! empty( $faq_items ) ) {

			ob_start();

			$this->get_template( 'faq-list.php', array(
				'slug'       => $slug,
				'show_index' => $show_index,
				'faq_items'  => $faq_items,
				'folding'    => $folding
			) );

			$faqs = ob_get_clean();

			return $faqs;
		}

		return __( '[Invalid/Empty FAQ Group ID supplied]', 'ninety-faqs' );
	}

	/**
	 * admin_columns function.
	 *
	 * @access public
	 * @return void
	 */
	function admin_columns( $columns ) {
		$columns = array(
			"cb"                 => "<input type=\"checkbox\" />",
			"title"              => __('Question', 'ninety-faqs' ),
			"answer"             => __("Answer", 'ninety-faqs' ),
			"faq-group"          => __("Group", 'ninety-faqs' ),
			"date"               => __("Date", 'ninety-faqs' ),
		);
		return $columns;
	}

	/**
	 * admin_custom_columns function.
	 *
	 * @access public
	 * @param mixed $column
	 * @return void
	 */
	function admin_custom_columns( $column ) {
		global $post;
		$custom = get_post_custom();
		switch ( $column ) {
			case "faq-group" :
				if ( $groups = get_the_term_list( $post->ID, 'faq-group', '', ', ','' ) )
					echo $groups;
				else
					echo '-';
			break;
			case "answer" :
				if ( strlen( $post->post_content ) > 200 )
					echo wpautop( strip_tags( substr( $post->post_content, 0, 200 ) ) . '[...]' );
				else
					echo wpautop( $post->post_content );
			break;
		}
	}

	/**
	 * menu_order function.
	 *
	 * @access public
	 * @param mixed $vars
	 * @return void
	 */
	function menu_order( $vars ) {

		if ( $vars['post_type'] != 'faq-item' || ! empty( $vars['orderby'] ) )
			return $vars;

		$vars['orderby'] = 'menu_order';
		$vars['order'] = 'asc';

		return $vars;
	}

	/**
	 * admin_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function admin_scripts() {
		$screen = get_current_screen();

		if ( current_user_can( 'edit_others_pages' ) && $screen->id == 'edit-faq-item' && empty( $_GET['orderby'] ) ) {

			wp_enqueue_script( 'faq-item-ordering', $this->plugin_url() . '/js/ordering.js', array('jquery-ui-sortable'), '1.0', true );

		}
	}

	/**
	 * Ajax request handling for faq item ordering
	 *
	 * @access public
	 * @return void
	 */
	function ajax_ordering() {
		global $wpdb;

		// check permissions again and make sure we have what we need
		if ( ! current_user_can('edit_others_pages') || empty( $_POST['id'] ) || ( ! isset( $_POST['previd'] ) && ! isset( $_POST['nextid'] ) ) )
			die(-1);

		// real post?
		if ( ! $post = get_post( $_POST['id'] ) )
			die(-1);

		$previd = isset( $_POST['previd'] ) ? $_POST['previd'] : false;
		$nextid = isset( $_POST['nextid'] ) ? $_POST['nextid'] : false;
		$new_pos = array(); // store new positions for ajax

		$siblings = $wpdb->get_results( $wpdb->prepare( "
			SELECT ID, menu_order FROM {$wpdb->posts} AS posts
			WHERE 	posts.post_type 	= 'faq-item'
			AND 	posts.post_status 	IN ( 'publish', 'pending', 'draft', 'future', 'private' )
			AND 	posts.ID			NOT IN (%d)
			ORDER BY posts.menu_order ASC, posts.ID DESC
		", $post->ID ) );

		$menu_order = 0;

		foreach( $siblings as $sibling ) {

			// if this is the post that comes after our repositioned post, set our repositioned post position and increment menu order
			if ( $nextid == $sibling->ID ) {
				$wpdb->update(
					$wpdb->posts,
					array(
						'menu_order' => $menu_order
					),
					array( 'ID' => $post->ID ),
					array( '%d' ),
					array( '%d' )
				);
				$new_pos[ $post->ID ] = $menu_order;
				$menu_order++;
			}

			// if repositioned post has been set, and new items are already in the right order, we can stop
			if ( isset( $new_pos[ $post->ID ] ) && $sibling->menu_order >= $menu_order )
				break;

			// set the menu order of the current sibling and increment the menu order
			$wpdb->update(
				$wpdb->posts,
				array(
					'menu_order' => $menu_order
				),
				array( 'ID' => $sibling->ID ),
				array( '%d' ),
				array( '%d' )
			);
			$new_pos[ $sibling->ID ] = $menu_order;
			$menu_order++;

			if ( ! $nextid && $previd == $sibling->ID ) {
				$wpdb->update(
					$wpdb->posts,
					array(
						'menu_order' => $menu_order
					),
					array( 'ID' => $post->ID ),
					array( '%d' ),
					array( '%d' )
				);
				$new_pos[$post->ID] = $menu_order;
				$menu_order++;
			}

		}

		die( json_encode( $new_pos ) );
	}
}

$GLOBALS['Ninety_FAQS'] = new Ninety_FAQS();