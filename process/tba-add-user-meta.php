<?php
/**
 * Adds User Meta to the new user.
 *
 * @return void
 */
function tba_add_user_meta( $user_id ) {

	$tba_points_info = array(
		'points'              => 0,
		'last_question_asked' => 0,
		'available_likes'     => 5,
	);

	add_user_meta( $user->ID, 'tba_points_info', $tba_points_info, true );

}
