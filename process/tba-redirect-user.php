<?php
/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function tba_redirect_user( $redirect_to, $request, $user ) {

	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		// Check for Intended Parent.
		if ( in_array( 'intended_parent', $user->roles ) ) {
			$url = site_url( '/member-login-intended-parents/', 'https' );
			return $url;
		}
		// Check for Surrogate.
		if ( in_array( 'surrogate', $user->roles ) ) {
			$url = site_url( '/member-login-surrogate/', 'https' );
			return $url;
		}
	} else {
		return $redirect_to;
	}
}
