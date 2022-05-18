<?php
/**
 * Sets Initial Values of the plugin.
 *
 * @return void
 */
function tba_plugin_activate() {
	$wp_user_query = 'SELECT * FROM wp_users';

	global $wpdb;

	// Get the results
	$users = $wpdb->get_results( $wp_user_query );
	// Check for results
	if ( ! empty( $users ) ) {

		// loop trough each author
		foreach ( $users as $user ) {
			if ( array() === get_user_meta( $user->ID, 'tba_points_info' ) ) {

				$tba_points_info = array(
					'points'              => 0,
					'last_question_asked' => 0,
					'available_likes'     => 5,
				);

				add_user_meta( $user->ID, 'tba_points_info', $tba_points_info, true ); // 5 = number of points existing users will get
			}
		}
	}

	$next_monday = strtotime( 'next monday' );

	$args = array( 'false' );

	if ( ! wp_next_scheduled( 'tba_run_weekly_jobs' ) ) {

		wp_schedule_event( $next_monday + 43200, 'weekly', 'tba_run_weekly_jobs' );
	}

}
