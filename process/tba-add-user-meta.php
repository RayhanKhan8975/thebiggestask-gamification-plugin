<?php
/**
 * Adds User Meta to the new user.
 *
 * @return void
 */
function tba_add_user_meta( $user_id, $userdata ) {

	$available_likes = get_option( 'tba_likes_every_week' );

	$tba_points_info = array(
		'points'              => 0,
		'last_question_asked' => 0,
		'available_likes'     => $available_likes,
		'gifts_recieved'      => 0,
	);

	add_user_meta( $user_id, 'tba_points_info', $tba_points_info, true );

	$roles = get_user_meta( $user_id, 'wp_capabilities', true );
	if ( isset( $roles['intended_parent'] ) ) {
		$url = site_url( '/member-login-intended-parents/', 'https' );
		header( 'Location:' . $url );
		exit();
	}

	if ( isset( $roles['surrogate'] ) ) {
		$url = site_url( '/member-login-surrogate/', 'https' );
		header( 'Location:' . $url );
		exit();
	}

}
