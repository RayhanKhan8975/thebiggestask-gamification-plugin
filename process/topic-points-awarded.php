<?php
/**
 * Awards points to the user that created a question.
 *
 * @return void
 */
function tba_topic_points_awarded( $post_id, $post, $update ) {

	if ( false === $update ) {
		$author_id = $post->post_author;

		$tba_points_info = get_user_meta( $author_id, 'tba_points_info' );

		if ( empty( $tba_points_info ) ) {
			tba_add_user_meta( $author_id );
			$tba_points_info = get_user_meta( $author_id, 'tba_points_info' );
		}
		// First Time question is asked or a day has passed since last question was asked.
		if ( 0 === intval( $tba_points_info[0]['last_question_asked'] ) || time() - intval( $tba_points_info[0]['last_question_asked'] ) > DAY_IN_SECONDS ) {

			$tba_points_info[0]['last_question_asked'] = time();
			$tba_points_info_new                       = array(
				'points'              => intval( $tba_points_info[0]['points'] ) + 5,
				'last_question_asked' => intval( $tba_points_info[0]['last_question_asked'] ),
				'available_likes'     => intval( $tba_points_info[0]['available_likes'] ),
			);

			$user_meta = update_user_meta( $author_id, 'tba_points_info', $tba_points_info_new );
		}
	}

}
