<?php
/**
 * Processes the Topic Approval Form.
 *
 * @return void
 */
function tba_approve_topic() {
	$output = array( 'status' => false );
	// var_dump( isset( $_POST['topic_id'] ) );
	if ( current_user_can( 'activate_plugins' ) && isset( $_POST['topic_id'] ) ) {

		$topic_id                      = intval( wp_unslash( $_POST['topic_id'] ) );
		$get_topics_for_approval_array = get_option( 'topics_for_approval' );
		$post                          = get_post( $topic_id );
		$author_id                     = $post->post_author;
		$approval                      = rest_sanitize_boolean( $_POST['approve'] );
		$tba_points_info               = get_user_meta( $author_id, 'tba_points_info' );
		$start_conversation_points     = get_option( 'tba_start_conversation' );

		if ( true === $approval ) {

			if ( empty( $tba_points_info ) ) {
				tba_add_user_meta( $author_id );
				$tba_points_info = get_user_meta( $author_id, 'tba_points_info' );}

			// First Time question is asked or a day has passed since last question was asked.
			if ( 0 === intval( $tba_points_info[0]['last_question_asked'] ) || time() - intval( $tba_points_info[0]['last_question_asked'] ) > DAY_IN_SECONDS ) {

				$tba_points_info[0]['last_question_asked'] = time();
				$tba_points_info_new                       = array(
					'points'              => intval( $tba_points_info[0]['points'] ) + $start_conversation_points,
					'last_question_asked' => intval( $tba_points_info[0]['last_question_asked'] ),
					'available_likes'     => intval( $tba_points_info[0]['available_likes'] ),
					'gifts_recieved'      => intval( $tba_points_info[0]['gifts_recieved'] ),
				);

				$user_meta = update_user_meta( $author_id, 'tba_points_info', $tba_points_info_new );
			}

			if ( true === $user_meta ) {
				$key = array_search( $topic_id, $get_topics_for_approval_array, true );
				unset( $get_topics_for_approval_array[ $key ] );

				update_option( 'topics_for_approval', $get_topics_for_approval_array );

				$output['status'] = true;
				wp_send_json( $output );
			}
		}

		if ( false === $approval || time() - intval( $tba_points_info[0]['last_question_asked'] ) < DAY_IN_SECONDS ) {
			$key = array_search( $topic_id, $get_topics_for_approval_array, true );
			unset( $get_topics_for_approval_array[ $key ] );

			update_option( 'topics_for_approval', $get_topics_for_approval_array );

			$output['status'] = true;

			wp_send_json( $output );
		}
	}

	wp_send_json( $output );
}
