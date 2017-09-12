<?php
/**
 * WordPress Batch Processing
 *
 * @package WordPress Batch Processing
 * @since 1.0.0
 */

if( ! class_exists( 'WP_Batch_Processing' ) ) :

	/**
	 * WordPress Batch Processing
	 *
	 * @since 1.0.0
	 */
	class WP_Batch_Processing {

		/**
		 * Instance
		 *
		 * @access private
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 * @return object initialized object of class.
		 */
		public static function set_instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			
			// Background Processing.
			require_once WP_BATCH_PROCESSING_DIR . 'classes/vendor/wp-async-request.php';
			require_once WP_BATCH_PROCESSING_DIR . 'classes/vendor/wp-background-process.php';
			
			// Example of WordPress Batch Processing.
			require_once WP_BATCH_PROCESSING_DIR . 'classes/class-wp-batch-processing-example.php';

			add_action( 'admin_head', 	array( $this, 'start_batch_process' ) );
		}

		/**
		 * Start Batch Processing
		 *
		 * @since 1.0.0
		 */
		function start_batch_process() {
			
			// delete_option( 'wp-batch-processed'  );

			$already_proceed = get_option( 'wp-batch-processed', 'no' );

			if( 'no' === $already_proceed ) {

				$process_all = new WP_Batch_Processing_Example();

				$all_posts = $this->get_posts_data();

				if ( is_array( $all_posts ) ) {
					foreach ( $all_posts as $key => $single_post ) {
						$process_all->push_to_queue( $single_post );
					}
					$process_all->save()->dispatch();
				}

				// Set proceed status!
				update_option( 'wp-batch-processed', 'yes' );
			}
		}

		/**
		 * Get Posts Data.
		 * 
		 * @since 1.0.0
		 */
		function get_posts_data() {

			// Create post object
			return array(
				array(
					'post_title'   => 'One',
					'post_content' => 'Sample post content.',
					'post_status'  => 'publish',
				),
				array(
					'post_title'   => 'Two',
					'post_content' => 'Sample post content.',
					'post_status'  => 'publish',
				)
			);
		}

	}

	/**
	 * Kicking this off by calling 'set_instance()' method
	 */
	WP_Batch_Processing::set_instance();

endif;