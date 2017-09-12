<?php
/**
 * Plugin Name: WordPress Batch Processing Example
 * Plugin URI: http://#
 * Description: WordPress Batch Processing Example.
 * Version: 1.0.0
 * Author: Mahesh M. Waghmare
 * Author URI: http://#
 * Text Domain: wp-batch-processing
 *
 * @package WordPress Batch Processing
 */

/**
 * Set constants.
 */
define( 'WP_BATCH_PROCESSING_VER',  '1.0.0' );
define( 'WP_BATCH_PROCESSING_FILE', __FILE__ );
define( 'WP_BATCH_PROCESSING_BASE', plugin_basename( WP_BATCH_PROCESSING_FILE ) );
define( 'WP_BATCH_PROCESSING_DIR',  plugin_dir_path( WP_BATCH_PROCESSING_FILE ) );
define( 'WP_BATCH_PROCESSING_URI',  plugins_url( '/', WP_BATCH_PROCESSING_FILE ) );

require_once WP_BATCH_PROCESSING_DIR . 'classes/class-wp-batch-processing.php';