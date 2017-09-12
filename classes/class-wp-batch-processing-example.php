<?php
/**
 * WordPress Batch Processing Example
 *
 * @package WordPress Batch Processing
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Batch_Processing_Example' ) && class_exists( 'WP_Background_Process' ) ) :

	/**
	 * WordPress Batch Processing Example
	 *
	 * @since 1.0.0
	 */
	class WP_Batch_Processing_Example extends WP_Background_Process {

		/**
		 * WordPress Batch Processing Example
		 *
		 * @var string
		 */
		protected $action = 'post_process';

		/**
		 * Task
		 *
		 * Override this method to perform any actions required on each
		 * queue item. Return the modified item for further processing
		 * in the next pass through. Or, return false to remove the
		 * item from the queue.
		 *
		 * @param mixed $single_post_data Queue item to iterate over.
		 *
		 * @return mixed
		 */
		protected function task( $single_post_data ) {

			$single_post_data = (array) $single_post_data;
			// Create Post.
			$post_ID = wp_insert_post( $single_post_data, $wp_error );

			error_log( 'Successfully Created Post #' . $post_ID );

			return false;

		}

		/**
		 * Complete
		 *
		 * Override if applicable, but ensure that the below actions are
		 * performed, or, call parent::complete().
		 */
		protected function complete() {
			parent::complete();

			error_log( 'All Posts Created!' );
		}

	}

endif;
