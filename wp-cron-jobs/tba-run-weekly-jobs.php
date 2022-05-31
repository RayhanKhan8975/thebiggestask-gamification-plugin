<?php
/**
 * Runs the weekly cron jobs for the plugin.
 *
 * @return void
 */
function tba_run_weekly_jobs() {
	global $wpdb;

	$wp_user_query = 'SELECT * FROM ' . $wpdb->prefix . 'users';

	$weekly_winners = array();

	$likes_awarded_every_week = get_option( 'tba_likes_every_week' );
	$points_for_giftcard      = get_option( 'tba_points_for_giftcard' );

	// Get the results
	$users = $wpdb->get_results( $wp_user_query );
	// Check for results
	if ( ! empty( $users ) ) {

		// loop trough each author.
		foreach ( $users as $user ) {

			$tba_points_info = get_user_meta( $user->ID, 'tba_points_info' );

				$tba_points_info_new = array(
					'points'              => intval( $tba_points_info[0]['points'] ),
					'last_question_asked' => intval( $tba_points_info[0]['last_question_asked'] ),
					'available_likes'     => $likes_awarded_every_week,
					'gifts_recieved'      => intval( $tba_points_info[0]['gifts_recieved'] ),
				);
				$points              = intval( $tba_points_info_new['points'] );
				$gifts_recieved      = intval( $tba_points_info_new['gifts_recieved'] );
				if ( ( $tba_points_info_new['points'] < 2 * ( $points_for_giftcard ) && $tba_points_info_new['gifts_recieved'] === 0 && $tba_points_info_new['points'] > $points_for_giftcard ) || ( $points / ( $gifts_recieved + 1 ) >= $points_for_giftcard ) ) {

					$weekly_winners[]                       = array(
						'user_name' => $user->display_name,
						'email'     => $user->user_email,
						'points'    => $tba_points_info_new['points'],
					);
					$tba_points_info_new['gifts_recieved'] += 1;

				}

				update_user_meta( $user->ID, 'tba_points_info', $tba_points_info_new ); // adds user_meta with appropriate_info.

		}
		if ( ! empty( $weekly_winners ) ) {
			$content = '<table class="table">
	<thead>
	  <tr>
		<th scope="col">Name</th>
		<th scope="col">Email</th>
		<th scope="col">Points</th>
	  </tr>
	</thead>
	<tbody>
	  ';

			foreach ( $weekly_winners as $weekly_winner ) {

				$content .= '
		<tr>
		<td>' . $weekly_winner['user_name'] . '</td>
		<td>' . $weekly_winner['email'] . '</td>
		<td>' . $weekly_winner['points'] . '</td>
	  </tr>';
			}

			$content .= '
	</tbody>
  </table>';

			wp_mail( get_option( 'admin_email' ), 'Weekly Winners', $content );

		}
	}
}

