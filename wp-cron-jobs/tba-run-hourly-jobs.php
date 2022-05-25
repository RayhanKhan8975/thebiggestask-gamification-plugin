<?php
/**
 * Runs Hourly Job to award ranks and rewards and other stuff!!
 *
 * @return void
 */
function tba_run_hourly_jobs() {
	$wp_user_query = 'SELECT * FROM wp_users';

	global $wpdb;

	// Get the results.
	$users = $wpdb->get_results( $wp_user_query );
	// Check for results.
	if ( ! empty( $users ) ) {

		$surrogate = get_page_by_title( 'Experienced Surrogate', OBJECT, 'tba-ranks' );

		$intended_parent = get_page_by_title( 'Experienced Intended Parent', OBJECT, 'tba-ranks' );

		$conversation_starter = get_page_by_title( 'Conversation starter', OBJECT, 'self-earned' );

		$valued_contributor = get_page_by_title( 'Valued Contributor', OBJECT, 'self-earned' );

		$leaderboards = array();

		// loop trough each user.
		foreach ( $users as $user ) {
			$tba_points_info = get_user_meta( $user->ID, 'tba_points_info', true );

			$roles = get_user_meta( $user->ID, 'wp_capabilities', true );

			if ( ( isset( $roles['surrogate'] ) && true === $roles['surrogate'] ) && count_user_posts( $user->ID, 'reply', true ) >= 25 && ! gamipress_has_user_earned_rank( $surrogate->ID, $user->ID ) ) {

				gamipress_award_rank_to_user( $surrogate->ID, $user->ID );
			}

			if ( ( isset( $roles['intended-parent'] ) && true === $roles['intended-parent'] ) && count_user_posts( $user->ID, 'reply', true ) >= 25 && ! gamipress_has_user_earned_rank( $intended_parent->ID, $user->ID ) ) {

				gamipress_award_rank_to_user( $intended_parent->ID, $user->ID );
			}

			if ( count_user_posts( $user->ID, 'topic', true ) >= 5 && ! gamipress_has_user_earned_achievement( $conversation_starter->ID, $user->ID ) ) {
				gamipress_award_achievement_to_user( $conversation_starter->ID, $user->ID );
			}

			if ( ! gamipress_has_user_earned_achievement( $valued_contributor->ID, $user->ID ) ) {
				$args = array(
					'author'         => $user->ID,
					'orderby'        => 'post_date',
					'order'          => 'ASC',
					'post_type'      => 'reply',
					'posts_per_page' => 30,
					'post_status'    => 'publish',
				);

				$latest_10_replies = get_posts( $args );

				foreach ( $latest_10_replies as $reply ) {
					$reply_meta = get_post_meta( $reply->ID, 'tba_reply_meta' );

					if ( isset( $reply_meta[0]['total_likes'] ) && $reply_meta[0]['total_likes'] > 4 ) {
						gamipress_award_achievement_to_user( $valued_contributor->ID, $user->ID );
						break;
					}
				}
			}
			$leaderboards[ $user->ID ]     = $tba_points_info['points'];
			$user_id_and_name[ $user->ID ] = $user->display_name;
			$avatars[ $user->ID ]          = get_avatar_url( $user->ID );
		}

		arsort( $leaderboards, SORT_NUMERIC );

		if ( ! empty( $leaderboards ) ) {
			$count             = 0;
			$main_leaderboards = array();
			foreach ( $leaderboards as $user => $points ) {
				++$count;
				$main_leaderboards[] = array(
					'rank'   => $count,
					'avatar' => $avatars[ $user ],
					'Name'   => $user_id_and_name[ $user ],
					'points' => $points,
				);
			}
		}

		update_option( 'tba_leaderboards', $main_leaderboards );
	}
}
