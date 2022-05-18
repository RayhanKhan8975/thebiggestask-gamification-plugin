<?php
/**
 * Displays the Like button
 *
 * @return void
 */
function display_like_button() {
	// $reply = get_post( );

	$tba_like_reply = get_post_meta( bbp_get_reply_id(), 'tba_reply_meta' );

	$replying_user_id = get_current_user_id();

	if ( in_array( $replying_user_id, $tba_like_reply[0]['people_liked'], true ) ) {
		$button_inside = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>You liked this ';
	} else {
		$button_inside = '<i class="fa fa-thumbs-up" aria-hidden="true"></i> Like';

	}
	$html = '<div class="like-content">
  

    <button id="tba_like_btn"  data-_wpnonce="' . wp_create_nonce( 'verify_like_button' ) . '" data-reply-id="' . bbp_get_reply_id() . '" data-_wp_http_referer="' . esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" class="btn-secondary like-review">
      ' . $button_inside . '
    </button>
    
  </div>';

	return $html;

}
