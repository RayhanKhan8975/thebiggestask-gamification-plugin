<?php
/**
 *
 * Adds the Necessary Scripts and Styles to the admin section.
 *
 * @return void
 */
function tba_admin_enqueue() {

	if ( ( isset( $_GET['page'] ) && $_GET['page'] === 'approve-topics' ) || ( isset( $_GET['page'] ) && $_GET['page'] === 'tba-settings' ) ) {

		wp_register_style( 'tba_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', false, time() );

		wp_register_script( 'tba_script', plugins_url( 'assets/script.js', TBA_PATH ), array( 'jquery' ), time(), true );

		wp_register_style( 'tba_style', plugins_url( 'assets/style.css', TBA_PATH ), false, time() );

		wp_enqueue_script( 'tba_script' );
		wp_enqueue_style( 'tba_style' );

		wp_localize_script( 'tba_script', 'tba', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		wp_enqueue_style( 'tba_bootstrap' );
	}

}
