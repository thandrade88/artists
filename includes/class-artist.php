<?php
/*
 * Main class
 */
/**
 * Class Artist
 *
 * This class creates the option page and add the web app script
 */

class Artist {

  // Put all your add_action, add_shortcode, add_filter functions in __construct()
  // For the callback name, use this: array($this,'<function name>')
  // <function name> is the name of the function within this class, so need not be globally unique
  // Some sample commonly used functions are included below
    public function __construct() {

  // TODO: Edit the calls here to only include the ones you want, or add more

         // Admin page calls:
        add_action( 'init', array( $this, 'registerPostType' ) );
        add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );    

        // Add Javascript and CSS for admin screens
        add_action('admin_enqueue_scripts', array($this,'enqueueAdmin'));

        // Add Javascript and CSS for front-end display
        add_action('wp_enqueue_scripts', array($this,'enqueue'));

        $this->load_dependencies();
    }

    public function load_dependencies() {    	
    	require_once ARTIST_PATH.'includes/admin/class-admin-artist.php';
    }

    /* ENQUEUE SCRIPTS AND STYLES */
    // This is an example of enqueuing a JavaScript file and a CSS file for use on the admin display    
    private function enqueueAdmin() {
        $screen = get_current_screen();
        if (!($screen->base == 'post' && $screen->post_type == 'artist')) return;

        wp_enqueue_script('very-descriptive-name', plugins_url('js/artist-post-editor.js', __FILE__), array('jquery'), '1.0', true);
        wp_enqueue_style('very-exciting-name', plugins_url('css/artist-post-editor.css', __FILE__), null, '1.0');
    }

    // This is an example of enqueuing a JavaScript file and a CSS file for use on the front end display
    private function enqueue() {
        
        wp_enqueue_script('descriptive-name', plugins_url('js/somefile.js', __FILE__), array('jquery'), '1.0', true);

        wp_enqueue_style('other-descriptive-name', plugins_url('css/somefile.css', __FILE__), null, '1.0');

        
        wp_localize_script( 'artist-ajax', 'artistAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));

    }

    /**
     * Register custom post type Artist
     */
    private function registerPostType()
    {

        $labels = array(
            'name'                  => _x( 'Artists', 'Post type general name', 'artist' ),
            'singular_name'         => _x( 'Artist', 'Post type singular name', 'artist' ),
            'menu_name'             => _x( 'Artists', 'Admin Menu text', 'artist' ),
            'name_admin_bar'        => _x( 'Artist', 'Add New on Toolbar', 'artist' ),
            'add_new'               => __( 'Add New', 'artist' ),
            'add_new_item'          => __( 'Add New Artist', 'artist' ),
            'new_item'              => __( 'New Artist', 'artist' ),
            'edit_item'             => __( 'Edit Artist', 'artist' ),
            'view_item'             => __( 'View Artist', 'artist' ),
            'all_items'             => __( 'All Artists', 'artist' ),
            'search_items'          => __( 'Search Artists', 'artist' ),
            'parent_item_colon'     => __( 'Parent Artists:', 'artist' ),
            'not_found'             => __( 'No Artists found.', 'artist' ),
            'not_found_in_trash'    => __( 'No Artists found in Trash.', 'artist' ),
            'featured_image'        => _x( 'Artist Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'artist' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'artist' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'artist' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'artist' ),
            'archives'              => _x( 'Artist archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'artist' ),
            'insert_into_item'      => _x( 'Insert into Artist', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'artist' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Artist', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'artist' ),
            'filter_items_list'     => _x( 'Filter Artists list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'artist' ),
            'items_list_navigation' => _x( 'Artists list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'artist' ),
            'items_list'            => _x( 'Artists list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'artist' ),
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => false,
            'show_in_menu'       => false,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'artist' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        );
     
        register_post_type( 'artist', $args );
        
    }

    /**
     * Adds the Artists label to the WordPress Admin Sidebar Menu
     */
    public function addAdminMenu()
    {
        add_menu_page(
        __( 'Artist', 'artist' ),
        __( 'Artist', 'artist' ),
        'manage_options',
        'artist',
        //array($this, 'adminLayout'),
        AdminArtist::adminLayout(),
        'dashicons-groups',
        2
         );
    }
}
