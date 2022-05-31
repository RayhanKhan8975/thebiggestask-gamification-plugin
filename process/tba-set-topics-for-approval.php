<?php
/**
 * Sets the Points for approval
 *
 * @return void
 */
function tba_set_topics_for_approval( $post_id, $post, $update ) {

	if ( $update === false ) {
		$post      = get_post( $post_id );
		$author_id = $post->post_author;

			$tba_points_info = get_user_meta( $author_id, 'tba_points_info' );

		if ( 0 === intval( $tba_points_info[0]['last_question_asked'] ) || time() - intval( $tba_points_info[0]['last_question_asked'] ) > DAY_IN_SECONDS ) {
			$get_topics_for_approval_array = get_option( 'topics_for_approval' );

			$get_topics_for_approval_array[] = $post_id;

			update_option( 'topics_for_approval', $get_topics_for_approval_array );

		}
	}

}
