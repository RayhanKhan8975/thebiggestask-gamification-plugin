<?php
/**
 * Adds our new column.
 *
 * @param [type] $column
 * @return void
 */
function tba_add_points_column( $column ) {
		$column['Points']          = 'Points';
		$column['Available Likes'] = 'Available Likes';
		return $column;
}
/**
 * Adds the data to the column
 *
 * @param [type] $val
 * @param [type] $column_name
 * @param [type] $user_id
 * @return void
 */
function tba_add_points_column_data( $val, $column_name, $user_id ) {
	switch ( $column_name ) {
		case 'Points':
			$user_meta = get_user_meta( $user_id, 'tba_points_info' );
			return isset( $user_meta[0]['points'] ) ? intval( $user_meta[0]['points'] ) : 0;
			break;
		case 'Available Likes':
			$user_meta = get_user_meta( $user_id, 'tba_points_info' );
			return isset( $user_meta[0]['available_likes'] ) ? intval( $user_meta[0]['available_likes'] ) : 0;
			break;

		default:
	}
	return $val;
}
