<?php
/**
 * Sets up Badges and Ranks for the Plugin
 *
 * @return void
 */
function add_badges_and_ranks() {
	if ( post_exists( 'Admin Awarded', '', '', 'achievement-type' ) == 0 ) {
		$admin_awarded_post = array(
			'post_title'   => 'Admin Awarded',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_author'  => get_current_user_id(),
			'post_name'    => 'admin-awarded',
			'post_type'    => 'achievement-type',
		);

		$admin_awarded_post_result = wp_insert_post( $admin_awarded_post, true );

		if ( ! is_wp_error( $admin_awarded_post_result ) ) {

			$admin_awarded_post_id = get_post( $admin_awarded_post_result );

			update_post_meta( $admin_awarded_post_result, '_gamipress_plural_name', 'Admin Awarded' );
			update_post_meta( $admin_awarded_post_result, '_gamipress_bp_create_achievement_activity', 'on' );
			$team_leader_post        = array(
				'post_title'   => 'Team Leader',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'post_name'    => 'team-leader',
				'post_type'    => 'admin-awarded',
			);
			$team_leader_post_result = wp_insert_post( $team_leader_post, true );

			tba_add_post_meta( $team_leader_post_result );

			$empowering_others_post = array(
				'post_title'   => 'Empowering Others',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'post_name'    => 'empowering-others',
				'post_type'    => 'admin-awarded',
			);

			$empowering_others_post_result = wp_insert_post( $empowering_others_post, true );

			tba_add_post_meta( $empowering_others_post_result );

		}
	}
	if ( post_exists( 'Self Earned', '', '', 'achievement-type' ) == 0 ) {
		$self_earned_post = array(
			'post_title'   => 'Self Earned',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_author'  => get_current_user_id(),
			'post_name'    => 'self-earned',
			'post_type'    => 'achievement-type',
		);

		$self_earned_post_result = wp_insert_post( $self_earned_post, true );

		if ( ! is_wp_error( $self_earned_post_result ) ) {

			// $self_earned_post_id = get_post( $self_earned_post_result );

			update_post_meta( $self_earned_post_result, '_gamipress_plural_name', 'Self Earned' );
			update_post_meta( $self_earned_post_result, '_gamipress_bp_create_achievement_activity', 'on' );
			$convo_starter_post        = array(
				'post_title'   => 'Conversation starter',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'post_name'    => 'conversation-starter',
				'post_type'    => 'self-earned',
			);
			$convo_starter_post_result = wp_insert_post( $convo_starter_post, true );

			tba_add_post_meta( $convo_starter_post_result );

			$valued_contributor_post = array(
				'post_title'   => 'Valued Contributor',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'post_name'    => 'valued-contributor',
				'post_type'    => 'self-earned',
			);

			$valued_contributor_post_result = wp_insert_post( $valued_contributor_post, true );

			tba_add_post_meta( $valued_contributor_post_result );

		}
	}

	if ( post_exists( 'TBA Ranks', '', '', 'rank-type' ) == 0 ) {
		$tba_ranks_post = array(
			'post_title'   => 'TBA Ranks',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_author'  => get_current_user_id(),
			'post_name'    => 'tba-ranks',
			'post_type'    => 'rank-type',
		);

		$tba_ranks_post_result = wp_insert_post( $tba_ranks_post, true );

		if ( ! is_wp_error( $tba_ranks_post_result ) ) {

			// $tba_ranks_post_id = get_post( $tba_ranks_post_result );

			update_post_meta( $tba_ranks_post_result, '_gamipress_plural_name', 'TBA Ranks' );
			update_post_meta( $tba_ranks_post_result, '_gamipress_bp_create_achievement_activity', 'on' );
			$exp_surrogate_post        = array(
				'post_title'   => 'Experienced Surrogate',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'post_name'    => 'experienced-surrogate',
				'post_type'    => 'tba-ranks',
				'menu_order'   => 100,
			);
			$exp_surrogate_post_result = wp_insert_post( $exp_surrogate_post, true );

			tba_add_post_meta( $exp_surrogate_post_result );

			$exp_intended_parent_post = array(
				'post_title'   => 'Experienced Intended Parent',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'post_name'    => 'experienced-intended-parent',
				'post_type'    => 'tba-ranks',
				'menu_order'   => 100,
			);

			$exp_intended_parent_post_result = wp_insert_post( $exp_intended_parent_post, true );

			tba_add_post_meta( $exp_intended_parent_post_result );

			$new_member_post = array(
				'post_title'   => 'New Member',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'post_name'    => 'new-member',
				'post_type'    => 'tba-ranks',
				'menu_order'   => 0,
			);

			$new_member_post_result = wp_insert_post( $new_member_post, true );

			tba_add_post_meta( $new_member_post_result );

		}
	}

}
