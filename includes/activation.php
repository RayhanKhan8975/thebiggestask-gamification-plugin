<?php
/**
 * Sets Initial Values of the plugin.
 *
 * @return void
 */
function tba_plugin_activate() {

	global $wpdb;

	$wp_user_query = 'SELECT * FROM ' . $wpdb->prefix . 'users';

	set_options();

	// Get the results
	$users = $wpdb->get_results( $wp_user_query );
	// Check for results
	if ( ! empty( $users ) ) {

		// loop trough each author
		foreach ( $users as $user ) {
			$user_meta = get_user_meta( $user->ID, 'tba_points_info' );
			if ( empty( $user_meta ) ) {

				$tba_points_info = array(
					'points'              => 0,
					'last_question_asked' => 0,
					'available_likes'     => 5,
					'gifts_recieved'      => 0,
				);

				add_user_meta( $user->ID, 'tba_points_info', $tba_points_info, true ); // adds user_meta with appropriate_info
			}
		}
	}

	$next_monday = strtotime( 'next monday' );

	$args = array( 'false' );

	if ( ! wp_next_scheduled( 'tba_run_weekly_jobs' ) ) {

		wp_schedule_event( $next_monday + 43200, 'weekly', 'tba_run_weekly_jobs' );
	}

	if ( ! wp_next_scheduled( 'tba_run_hourly_jobs' ) ) {

		wp_schedule_event( time(), 'hourly', 'tba_run_hourly_jobs' );
	}

	// Setting up the achievements and ranks for the plugin.

	add_badges_and_ranks();

}

