<?php
/**
 * Adds Post Meta to the badges and achievements
 *
 * @param [type] $post_id
 * @return void
 */
function tba_add_post_meta( $post_id ) {

	if ( ! get_post_meta( $post_id, '_gamipress_earned_by', true ) ) {

		$post = get_post( $post_id );

		update_post_meta( $post_id, '_gamipress_congratulations_text', 'Congratulation now you have earned the "' . $post->post_title . '" Achievement.' );
		update_post_meta( $post_id, '_gamipress_points_to_unlock', '0' );
		update_post_meta( $post_id, '_gamipress_points_type_to_unlock', '' );
		update_post_meta( $post_id, '_gamipress_maximum_earners', '0' );
		update_post_meta( $post_id, '_gamipress_layout', 'left' );
		update_post_meta( $post_id, '_gamipress_align', 'none' );
		if ( 'tba-ranks' !== $post->post_type ) {

			update_post_meta( $post_id, '_gamipress_points_type_required', '' );
			update_post_meta( $post_id, '_gamipress_maximum_earnings', '1' );
			update_post_meta( $post_id, '_gamipress_global_maximum_earnings', '0' );
			update_post_meta( $post_id, '_gamipress_hidden', 'show' );
			update_post_meta( $post_id, '_gamipress_points', '0' );
			update_post_meta( $post_id, '_gamipress_points_type', '' );
			update_post_meta( $post_id, '_gamipress_earned_by', 'admin' );
			update_post_meta( $post_id, '_gamipress_points_required', '0' );
		}
	}

}
