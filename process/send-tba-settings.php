<?php
/**
 * Saves Options.
 *
 * @return void
 */
function send_tba_settings() {

	$output = array( 'status' => 0 );

	check_admin_referer( 'verify_tba_values' );

	if ( current_user_can( 'activate_plugins' ) && isset( $_POST['tba_start_conversation'], $_POST['tba_answer_question_like'], $_POST['tba_answer_question_like_additonal'], $_POST['tba_likes_every_week'], $_POST['tba_points_for_giftcard'], $_POST['tba_es_questions'], $_POST['tba_eip_questions'], $_POST['tba_cs_questions'], $_POST['tba_vc_likes'] ) ) {

		$sc   = intval( $_POST['tba_start_conversation'] );
		$aq   = intval( $_POST['tba_answer_question_like'] );
		$aqa  = intval( $_POST['tba_answer_question_like_additonal'] );
		$lew  = intval( $_POST['tba_likes_every_week'] );
		$pfg  = intval( $_POST['tba_points_for_giftcard'] );
		$esq  = intval( $_POST['tba_es_questions'] );
		$eipq = intval( $_POST['tba_eip_questions'] );
		$csq  = intval( $_POST['tba_cs_questions'] );
		$vcl  = intval( $_POST['tba_vc_likes'] );

		update_option( 'tba_start_conversation', $sc );
		update_option( 'tba_answer_question_like', $aq );
		update_option( 'tba_answer_question_like_additonal', $aqa );
		update_option( 'tba_likes_every_week', $lew );
		update_option( 'tba_points_for_giftcard', $pfg );
		update_option( 'tba_es_questions', $esq );
		update_option( 'tba_eip_questions', $eipq );
		update_option( 'tba_cs_questions', $csq );
		update_option( 'tba_vc_likes', $vcl );

		$output['status'] = 1;

		wp_send_json( $output );

	}

	wp_send_json( $output );

}
