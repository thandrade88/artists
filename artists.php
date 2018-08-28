<?php
/**
 * Plugin Name:       Artists
 * Description:       Plugin for artists casting!
 * Version:           1.0.0
 * Author:            Thales Andrade
 * Author URI:        https://thalesandrade.com
 * Text Domain:       thalesandrade
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/thandrade88/artists
 */
 
/*
 * Plugin constants
 */
if(!defined('ARTIST_URL'))
	define('ARTIST_URL', plugin_dir_url( __FILE__ ));
if(!defined('ARTIST_PATH'))
	define('ARTIST_PATH', plugin_dir_path( __FILE__ ));
 
/*
 * Main class
 */
/**
 * Class Artist
 *
 * This class creates the option page and add the web app script
 */
class Artist
{
 
    /**
     * Artist constructor.
     *
     * The main plugin actions registered for WordPress
     */
    public function __construct()
    {
 
    }
 
}
 
/*
 * Starts our plugin class, easy!
 */
new Artist();