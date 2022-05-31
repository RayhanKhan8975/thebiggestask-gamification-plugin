<?php
/**
 *
 *
 * @return void
 */
function set_options() {

	if ( empty( get_option( 'topics_for_approval' ) ) ) {
		add_option( 'topics_for_approval', array() );
	}

	if ( empty( get_option( 'tba_start_conversation' ) ) ) {
		add_option( 'tba_start_conversation', 5 );
	}

	if ( empty( get_option( 'tba_answer_question_like' ) ) ) {
		add_option( 'tba_answer_question_like', 5 );
	}

	if ( empty( get_option( 'tba_answer_question_like_additonal' ) ) ) {
		add_option( 'tba_answer_question_like_additonal', 1 );
	}

	if ( empty( get_option( 'tba_likes_every_week' ) ) ) {
		add_option( 'tba_likes_every_week', 5 );
	}

	if ( empty( get_option( 'tba_points_for_giftcard' ) ) ) {
		add_option( 'tba_points_for_giftcard', 100 );
	}

	if ( empty( get_option( 'tba_es_questions' ) ) ) {
		add_option( 'tba_es_questions', 25 );
	}

	if ( empty( get_option( 'tba_eip_questions' ) ) ) {
		add_option( 'tba_eip_questions', 25 );
	}

	if ( empty( get_option( 'tba_cs_questions' ) ) ) {
		add_option( 'tba_cs_questions', 5 );
	}

	if ( empty( get_option( 'tba_vc_likes' ) ) ) {
		add_option( 'tba_vc_likes', 5 );
	}

}
