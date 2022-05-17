<?php
	/**
	 * Shows the Error Message
	 *
	 * @return void
	 */
function gamipress_buddyboss_not_activated() {
	$class   = 'notice notice-error';
	$message = __( 'Gamification Plugin for The Biggest Ask requires both the Gamipress and BuddyBoss Plugin.', 'TBA' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
