<?php 
// =========================================================================
// Include config
// =========================================================================
require('config.php');

// =========================================================================
// Remove wordpress adminbar
// =========================================================================
add_filter('show_admin_bar', '__return_false');

// =========================================================================
// Write to debug.log - http://www.stumiller.me/sending-output-to-the-wordpress-debug-log/
// =========================================================================
if ( ! function_exists('solarmade_after_setup_theme') ) {
    
    // Write Log
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
    
}


// =========================================================================
// Init
// =========================================================================
if ( ! function_exists('solarmade_after_setup_theme') ) {

    // Init
    function solarmade_init() {

        // Register navigation menu's
        register_nav_menus(array(
            'primary' => __( 'Header Navigation', 'solarmade' ),
        ));
        
    }
    add_action('init', 'solarmade_init');
}

// =========================================================================
// Cleaner WordPress
// =========================================================================
if ( ! function_exists('solarmade_cleaner_wordpress') ) {
    
    // Cleaner WordPress
    function solarmade_cleaner_wordpress() {
    
        // Remove WordPress header junk - https://scotch.io/tutorials/removing-wordpress-header-junk
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

        // Remove Emoji - http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    
    }    
    add_action( 'init', 'solarmade_cleaner_wordpress' );

}


// =========================================================================
// Enqueue scripts
// =========================================================================
if ( ! function_exists('solarmade_enqueue_scripts') ) {
    
    // Enqueue scripts
    function solarmade_enqueue_scripts() {

        wp_enqueue_script('solarmade_main', get_template_directory_uri() . '/build/js/main.min.js', array('jquery'), false, true);
        wp_enqueue_script('jquery_fullPage_min_js', get_template_directory_uri() . '/build/js/vendor/jquery.fullPage.min.js', array('jquery'), false, true);

    }
    add_action('wp_enqueue_scripts', 'solarmade_enqueue_scripts');
    
}


// =========================================================================
// Enqueue styles
// =========================================================================
if ( ! function_exists('solarmade_enqueue_styles') ) {
    
    // Enqueue styles
    function solarmade_enqueue_styles() {

        wp_enqueue_style('solarmade_styles', get_template_directory_uri() . '/style.min.css', array(), '3.0.3', 'all');
        wp_enqueue_style('jquery_fullPage_min_css', get_template_directory_uri() . '/build/css/jquery.fullPage.min.css');

    }
    add_action('wp_enqueue_scripts', 'solarmade_enqueue_styles');
    
}

add_theme_support( 'post-thumbnails' ); 
// =========================================================================
// After setup theme
// =========================================================================
if ( ! function_exists('solarmade_after_setup_theme') ) {

    // After setup theme
    function solarmade_after_setup_theme()  {

        // Add theme support for Automatic Feed Links
        add_theme_support( 'automatic-feed-links' );

        // Add theme support for Post Formats
        add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

        // Add theme support for Featured Images
        add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

        // Add theme support for HTML5 Semantic Markup
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

        // Add theme support for document Title tag
        add_theme_support( 'title-tag' );

        // Add theme support for custom CSS in the TinyMCE visual editor
        add_editor_style();

        // Add theme support for Translation
        load_theme_textdomain( 'solarmade', get_template_directory() . '/languages' );
    
    }
    add_action( 'after_setup_theme', 'solarmade_after_setup_theme' );

}

// =========================================================================
// Register custom post types
// =========================================================================
function solarmade_register_custom_post_type_projects() {

    $labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'solarmade' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'solarmade' ),
        'menu_name'             => __( 'Projects', 'solarmade' ),
        'name_admin_bar'        => __( 'Projects', 'solarmade' ),
        'archives'              => __( 'Projects archieven', 'solarmade' ),
        'parent_item_colon'     => __( 'Parent Item', 'solarmade' ),
        'all_items'             => __( 'All projects', 'solarmade' ),
        'add_new_item'          => __( 'Add new project', 'solarmade' ),
        'add_new'               => __( 'Add new project', 'solarmade' ),
        'new_item'              => __( 'Add new project', 'solarmade' ),
        'edit_item'             => __( 'Edit project', 'solarmade' ),
        'update_item'           => __( 'Update project', 'solarmade' ),
        'view_item'             => __( 'View project', 'solarmade' ),
        'search_items'          => __( 'Search in projects', 'solarmade' ),
        'not_found'             => __( 'Not found', 'solarmade' ),
        'not_found_in_trash'    => __( 'No projects found in trash', 'solarmade' ),
        'featured_image'        => __( 'Featured image', 'solarmade' ),
        'set_featured_image'    => __( 'Set featured image', 'solarmade' ),
        'remove_featured_image' => __( 'Remove featured image', 'solarmade' ),
        'use_featured_image'    => __( 'Use as featured image', 'solarmade' ),
        'insert_into_item'      => __( 'Insert into project', 'solarmade' ),
        'uploaded_to_this_item' => __( 'Uploaded to this project', 'solarmade' ),
        'items_list'            => __( 'Projects list', 'solarmade' ),
        'items_list_navigation' => __( 'Projects list navigation', 'solarmade' ),
        'filter_items_list'     => __( 'Filter projects', 'solarmade' ),
    );
    $args = array(
        'label'                 => __( 'Project', 'solarmade' ),
        'description'           => __( 'Projects post type', 'solarmade' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', ),
        'taxonomies'            => array( ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-store',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'Projects', $args );

}

add_action( 'init', 'solarmade_register_custom_post_type_projects', 0 ); 

function solarmade_register_custom_post_type__category_projects() {
  $labels = array(
    'name'              => _x( 'Projects Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Projects Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Projects Categories' ),
    'all_items'         => __( 'All Projects Categories' ),
    'parent_item'       => __( 'Parent Projects Category' ),
    'parent_item_colon' => __( 'Parent Projects Category:' ),
    'edit_item'         => __( 'Edit Projects Category' ), 
    'update_item'       => __( 'Update Projects Category' ),
    'add_new_item'      => __( 'Add New Projects Category' ),
    'new_item_name'     => __( 'New Projects Category' ),
    'menu_name'         => __( 'Projects Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'projects_category', 'projects', $args );
}
add_action( 'init', 'solarmade_register_custom_post_type__category_projects', 0 );

function solarmade_register_custom_post_type_research() {

    $labels = array(
        'name'                  => _x( 'Research', 'Post Type General Name', 'solarmade' ),
        'singular_name'         => _x( 'Researcn Item', 'Post Type Singular Name', 'solarmade' ),
        'menu_name'             => __( 'Research', 'solarmade' ),
        'name_admin_bar'        => __( 'Research', 'solarmade' ),
        'archives'              => __( 'Research archieven', 'solarmade' ),
        'parent_item_colon'     => __( 'Parent Item', 'solarmade' ),
        'all_items'             => __( 'All Research', 'solarmade' ),
        'add_new_item'          => __( 'Add new research item', 'solarmade' ),
        'add_new'               => __( 'Add new research item', 'solarmade' ),
        'new_item'              => __( 'Add new research item', 'solarmade' ),
        'edit_item'             => __( 'Edit research item', 'solarmade' ),
        'update_item'           => __( 'Update research item', 'solarmade' ),
        'view_item'             => __( 'View research item', 'solarmade' ),
        'search_items'          => __( 'Search in Research', 'solarmade' ),
        'not_found'             => __( 'Not found', 'solarmade' ),
        'not_found_in_trash'    => __( 'No Research found in trash', 'solarmade' ),
        'featured_image'        => __( 'Featured image', 'solarmade' ),
        'set_featured_image'    => __( 'Set featured image', 'solarmade' ),
        'remove_featured_image' => __( 'Remove featured image', 'solarmade' ),
        'use_featured_image'    => __( 'Use as featured image', 'solarmade' ),
        'insert_into_item'      => __( 'Insert into research item', 'solarmade' ),
        'uploaded_to_this_item' => __( 'Uploaded to this research item', 'solarmade' ),
        'items_list'            => __( 'Research list', 'solarmade' ),
        'items_list_navigation' => __( 'Research list navigation', 'solarmade' ),
        'filter_items_list'     => __( 'Filter Research', 'solarmade' ),
    );
    $args = array(
        'label'                 => __( 'Research', 'solarmade' ),
        'description'           => __( 'Research post type', 'solarmade' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', ),
        'taxonomies'            => array( 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-store',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'Research', $args );

}
add_action( 'init', 'solarmade_register_custom_post_type_research', 0 ); 
?>