<?php
/**
 * Saves Meta Data for reply
 *
 * @return void
 */
function tba_save_reply_meta( $post_id, $post, $update ) {

	if ( false == $update ) {
		$tba_reply_meta = array(
			'total_likes'  => 0,
			'people_liked' => array(),
		);

		add_post_meta( $post_id, 'tba_reply_meta', $tba_reply_meta );
	}

}
