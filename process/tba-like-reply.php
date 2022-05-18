<?php
/**
 * Adds like to a reply
 *
 * @return void
 */
function tba_like_reply() {

	check_ajax_referer( 'verify_like_button' );

	$output['status'] = 0;

	if ( ! isset( $_POST['reply_id'] ) ) {
		wp_send_json( $output );
	}

	$reply_id = intval( $_POST['reply_id'] );

	$reply = get_post( $reply_id );

	$tba_like_reply = get_post_meta( $reply_id, 'tba_reply_meta' );

	$replying_user_id = get_current_user_id();

	$comment_author = $reply->post_author;

	$tba_points_info = get_user_meta( $comment_author, 'tba_points_info' );

	$first_like = 5;

	$other_like = 1;

	$like_change = 1;

	$tba_liker = get_user_meta( $replying_user_id, 'tba_points_info' );

	if ( $tba_liker[0]['available_likes'] < 1 ) {
		wp_send_json( $output );
	}

	if ( empty( $tba_like_reply ) ) {

		tba_save_reply_meta( $reply_id, $reply, false );

		$tba_like_reply = get_post_meta( $reply_id, 'tba_reply_meta' );

	}

	if ( in_array( $replying_user_id, $tba_like_reply[0]['people_liked'], true ) ) {
		$key = array_search( $replying_user_id, $tba_like_reply[0]['people_liked'], true );
		unset( $tba_like_reply[0]['people_liked'][ $key ] );
		$first_like  = -$first_like;
		$other_like  = -$other_like;
		$like_change = -$like_change;

		$user_liked = false;

	} else {
		$tba_like_reply[0]['people_liked'][] = $replying_user_id;
		$user_liked                          = true;
		$first_like                          = 5;
		$other_like                          = 1;
		$like_change                         = 1;

	}

	if ( count( $tba_like_reply[0]['people_liked'] ) == 1 ) {

		$tba_points_info_new = array(
			'points'              => intval( $tba_points_info[0]['points'] ) + $first_like,
			'last_question_asked' => intval(
				$tba_points_info[0]['last_question_asked'],
			),
			'available_likes'     => intval( $tba_points_info[0]['available_likes'] ),
		);
	} else {

		$tba_points_info_new = array(
			'points'              => intval( $tba_points_info[0]['points'] ) + $other_like,
			'last_question_asked' => intval(
				$tba_points_info[0]['last_question_asked'],
			),
			'available_likes'     => intval( $tba_points_info[0]['available_likes'] ),
		);
	}

	update_user_meta( $comment_author, 'tba_points_info', $tba_points_info_new );

	// $tba_like_reply[0]['people_liked'][] = $replying_user_id.;

	$total_likes = count( $tba_like_reply[0]['people_liked'] );

	$tba_like_reply_new = array(
		'people_liked' => $tba_like_reply[0]['people_liked'],
		'total_likes'  => $total_likes,
	);

	update_post_meta( $reply_id, 'tba_reply_meta', $tba_like_reply_new );

	$tba_liker = get_user_meta( $replying_user_id, 'tba_points_info' );

	$tba_liker_new = array(
		'points'              => intval( $tba_liker[0]['points'] ),
		'last_question_asked' => intval(
			$tba_liker[0]['last_question_asked'],
		),
		'available_likes'     => intval( $tba_liker[0]['available_likes'] ) - $like_change,
	);

	update_user_meta( $replying_user_id, 'tba_points_info', $tba_liker_new );

	wp_send_json(
		array(
			'user_liked'  => $user_liked,
			'total_likes' => $total_likes,
		)
	);

}
