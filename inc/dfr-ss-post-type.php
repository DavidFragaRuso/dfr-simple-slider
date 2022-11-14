<?php
//Creater post type Slider
add_action( 'init', 'create_slider_post_type' );

function create_slider_post_type() {
    register_post_type( 'slider', [
        // Post type arguments.
        'public' => true,
        'publicly_queryable' => true,
        'show_in_rest' => false, //True activate gutterberg block editor for this post type
        'show_in_nav_menus' => false, //Show post type in menu builder
        'show_in_admin_bar' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' =>  6, //Set the position in the administration menu
        'menu_icon' => 'dashicons-media-interactive',
        'hierarchical' => false,
        'has_archive' => false,
        'query_var' =>  'slider',
        'capability_type'   =>  'post', //Can change to "Slide" per diferent user capabilities
        'map_meta_cap' => true,
        // The rewrite handles the URL structure.
        'rewrite' => [
            'slug' => 'slides', // Customize the permastruct slug. Defaults to $post_type key.
            'with_front' => false,
            'pages'      => false, // Whether the permastruct should provide for pagination. Default true.
			'feeds'      => false,
            'ep_mask'    => EP_PERMALINK,
        ],
        // Features the post type supports.
        'supports' => [
            'title'
        ],
        // Text labels.
        'labels' => [
            'name' => __('Sliders', 'dfr_simple_slider'),
            'singular_name' => __('Slider', 'dfr_simple_slider'),
            'menu_name' => __( 'Slider', 'dfr_simple_slider' ),
            'add_new'   =>  __('Add Slider', 'dfr_simple_slider'),
            'add_new_item'  =>  __('New Slider', 'dfr_simple_slider'),
            'edit_item' =>  __('Edit Slider', 'dfr_simple_slider'),
            'new_item'  =>  __('New Slider', 'dfr_simple_slider'),
            'view_item' =>  __('See Slider', 'dfr_simple_slider'),
            'search_item'   =>  __('Search Sliders', 'dfr_simple_slider'),
            'not_found' =>  __('There is no Sliders', 'dfr_simple_slider'),
            'not_found_in_trash'    =>  __('There are no Sliders in the recycle bin', 'dfr_simple_slider'),
            'all_items' => __('All Sliders', 'dfr_simple_slider'),
            'archive' => __('Sliders archive', 'dfr_simple_slider'),
            'attributes' => __('Slider attributes', 'dfr_simple_slider'),
            'insert_into_item' => __('Insert in Slider', 'dfr_simple_slider'),
            'uploaded_to_this_item' => __('Updated on entry', 'dfr_simple_slider'),
            'featured_image' => __('Add Slider Featured Image (Mobile devices)', 'dfr_simple_slider'),
            'set_featured_image' => __('Slider Featured Image (For mobile devices)', 'dfr_simple_slider'),
            'remove_featured_image' => __('Delete image', 'dfr_simple_slider'),
            'use_featured_image' => __('Use as featured image', 'dfr_simple_slider'),
            'menu_name' => __('Slider', 'dfr_simple_slider'),
            'filter_items_list' => __('Sliders List', 'dfr_simple_slider'),
            'items_list_navigation' => __('List navigation', 'dfr_simple_slider'),
            'items_list' => __('Slider List', 'dfr_simple_slider'),
            'name_admin_bar' => __('Slider', 'dfr_simple_slider')
        ]
    ] );
}