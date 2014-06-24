<?php
    // Create "VC Testimonials" Post Type and Custom Taxonomies
	if (get_option('ts_vcsc_extend_settings_customTestimonial', 1) == 1) {
		function TS_VCSC_Testimonials_Post_Type() {
			$labels = array(
				'name'                  	=> _x( 'Testimonials',		'post type general name' ),
				'singular_name'         	=> _x( 'Testimonial',		'post type singular name' ),
				'add_new'               	=> _x( 'Add New',			'book' ),
				'add_new_item'          	=> __( 'Add New Testimonial' ),
				'edit_item'             	=> __( 'Edit Testimonial' ),
				'new_item'              	=> __( 'New Testimonial' ),
				'view_item'             	=> __( 'View Testimonial' ),
				'search_items'          	=> __( 'Search Testimonials' ),
				'not_found'             	=> __( 'No Testimonial(s) found' ),
				'not_found_in_trash'    	=> __( 'No Testimonial(s) found in the Trash' ), 
				'parent_item_colon'     	=> '',
				'menu_name'             	=> 'VC Testimonials'
			);
			$args = array(
				'labels'                	=> $labels,
				'description'           	=> 'Add Testimonials to be used with the Visual Composer Extensions plugin.',
				'public'                	=> false,
				'rewrite'               	=> true,
				'exclude_from_search'		=> true,
				'publicly_queryable'    	=> false,
				'show_ui'               	=> true,
				'show_in_menu'          	=> true, 
				'query_var'             	=> true,
				'rewrite'               	=> true,
				'capability_type'       	=> 'post',
				'has_archive'           	=> false, 
				'hierarchical'          	=> false,
				'menu_position'         	=> 5,
				'supports'              	=> array('title', 'editor', 'thumbnail'),
			);
			register_post_type('ts_testimonials', $args);
			
			$labels = array(
				'name'                  	=> __( 'Categories'),
				'singular_name'         	=> __( 'Category'),
				'search_items'          	=> __( 'Search in Categories'),
				'all_items'             	=> __( 'Categories'),
				'parent_item'           	=> __( 'Parent Category'),
				'parent_item_colon'     	=> __( 'Parent Category:'),
				'edit_item'             	=> __( 'Edit Category'), 
				'update_item'           	=> __( 'Update Category'),
				'add_new_item'          	=> __( 'Add New Category'),
				'new_item_name'         	=> __( 'New Category'),
				'menu_name'             	=> __( 'Categories')
			);
			
			register_taxonomy(
				'ts_testimonials_category',
				array('ts_testimonials'),
				array(
					'hierarchical'          => true,
					'public'                => false,
					'labels'                => $labels,
					'show_ui'               => true,
					'rewrite'               => true,
					'show_admin_column'		=> true,
				)
			);
			
			new TS_VCSC_Tax_CTP_Filter(array('ts_testimonials' => array('ts_testimonials_category')));
		}
		add_action('init', 'TS_VCSC_Testimonials_Post_Type');
	}
	
    // Create "VC Team" Post Type and Custom Taxonomies
	if (get_option('ts_vcsc_extend_settings_customTeam', 1) == 1) {
		function TS_VCSC_Team_Post_Type() {
			$labels = array(
				'name'                  	=> _x( 'Members',			'post type general name' ),
				'singular_name'         	=> _x( 'Team Member',		'post type singular name' ),
				'add_new'               	=> _x( 'Add New',			'book' ),
				'add_new_item'          	=> __( 'Add New Teammate' ),
				'edit_item'             	=> __( 'Edit Teammate' ),
				'new_item'              	=> __( 'New Teammate' ),
				'view_item'             	=> __( 'View Teammate' ),
				'search_items'          	=> __( 'Search Teammates' ),
				'not_found'             	=> __( 'No Teammate(s) found' ),
				'not_found_in_trash'    	=> __( 'No Teammate(s) found in the Trash' ), 
				'parent_item_colon'     	=> '',
				'menu_name'             	=> 'VC Team'
			);
			$args = array(
				'labels'                	=> $labels,
				'description'           	=> 'Add Team Information to be used with the Visual Composer Extensions plugin.',
				'public'                	=> false,
				'rewrite'               	=> true,
				'exclude_from_search'		=> true,
				'publicly_queryable'    	=> false,
				'show_ui'               	=> true,
				'show_in_menu'          	=> true, 
				'query_var'             	=> true,
				'rewrite'               	=> true,
				'capability_type'       	=> 'post',
				'has_archive'           	=> false, 
				'hierarchical'          	=> false,
				'menu_position'         	=> 5,
				'supports'              	=> array('title', 'editor', 'thumbnail'),
			);
			register_post_type('ts_team', $args);
			
			$labels = array(
				'name'                  	=> __( 'Team / Group'),
				'singular_name'         	=> __( 'Team / Group'),
				'search_items'          	=> __( 'Search in Teams / Groups'),
				'all_items'             	=> __( 'Teams / Groups'),
				'parent_item'           	=> __( 'Parent Team / Group'),
				'parent_item_colon'     	=> __( 'Parent Team / Group:'),
				'edit_item'             	=> __( 'Edit Team / Group'), 
				'update_item'           	=> __( 'Update Team / Group'),
				'add_new_item'          	=> __( 'Add New Team / Group'),
				'new_item_name'         	=> __( 'New Team / Group Name'),
				'menu_name'             	=> __( 'Teams / Groups')
			);
			
			register_taxonomy(
				'ts_team_category',
				array('ts_team'),
				array(
					'hierarchical'          => true,
					'public'                => false,
					'labels'                => $labels,
					'show_ui'               => true,
					'rewrite'               => true,
					'show_admin_column'		=> true,
				)
			);
			
			new TS_VCSC_Tax_CTP_Filter(array('ts_team' => array('ts_team_category')));
		}
		add_action('init', 'TS_VCSC_Team_Post_Type');
	}

    // Create "VC Skillsets" Post Type and Custom Taxonomies
	if (get_option('ts_vcsc_extend_settings_customSkillset', 1) == 1) {
		function TS_VCSC_Skillsets_Post_Type() {
			$labels = array(
				'name'                  	=> _x( 'Skillsets',			'post type general name' ),
				'singular_name'         	=> _x( 'Skillset',			'post type singular name' ),
				'add_new'               	=> _x( 'Add New',			'book' ),
				'add_new_item'          	=> __( 'Add New Skillset' ),
				'edit_item'             	=> __( 'Edit Skillset' ),
				'new_item'              	=> __( 'New Skillset' ),
				'view_item'             	=> __( 'View Skillset' ),
				'search_items'          	=> __( 'Search Skillsets' ),
				'not_found'             	=> __( 'No Skillset(s) found' ),
				'not_found_in_trash'    	=> __( 'No Skillset(s) found in the Trash' ), 
				'parent_item_colon'     	=> '',
				'menu_name'             	=> 'VC Skillsets'
			);
			$args = array(
				'labels'                	=> $labels,
				'description'           	=> 'Add Skillsets to be used with the Visual Composer Extensions plugin.',
				'public'                	=> false,
				'rewrite'               	=> true,
				'exclude_from_search'		=> true,
				'publicly_queryable'    	=> false,
				'show_ui'               	=> true,
				'show_in_menu'          	=> true, 
				'query_var'             	=> true,
				'rewrite'               	=> true,
				'capability_type'       	=> 'post',
				'has_archive'           	=> false, 
				'hierarchical'          	=> false,
				'menu_position'         	=> 5,
				'supports'              	=> array('title'),
			);
			register_post_type('ts_skillsets', $args);
			
			$labels = array(
				'name'                  	=> __( 'Categories'),
				'singular_name'         	=> __( 'Category'),
				'search_items'          	=> __( 'Search in Categories'),
				'all_items'             	=> __( 'Categories'),
				'parent_item'           	=> __( 'Parent Category'),
				'parent_item_colon'     	=> __( 'Parent Category:'),
				'edit_item'             	=> __( 'Edit Category'), 
				'update_item'           	=> __( 'Update Category'),
				'add_new_item'          	=> __( 'Add New Category'),
				'new_item_name'         	=> __( 'New Category'),
				'menu_name'             	=> __( 'Categories')
			);
			
			register_taxonomy(
				'ts_skillsets_category',
				array('ts_skillsets'),
				array(
					'hierarchical'          => true,
					'public'                => false,
					'labels'                => $labels,
					'show_ui'               => true,
					'rewrite'               => true,
					'show_admin_column'		=> true,
				)
			);
			
			new TS_VCSC_Tax_CTP_Filter(array('ts_skillsets' => array('ts_skillsets_category')));
		}
		add_action('init', 'TS_VCSC_Skillsets_Post_Type');
	}
?>