<?php
/**
 * Enqueues Necessary Scripts and Styles to Front End.
 *
 * @return void
 */
function tba_enqueue() {
	wp_register_script( 'tba_script', plugins_url( 'assets/script.js', TBA_PATH ), array( 'jquery' ), time(), true );

	wp_register_style( 'tba_style', plugins_url( 'assets/style.css', TBA_PATH ), false, time() );

	wp_enqueue_script( 'tba_script' );
	wp_enqueue_style( 'tba_style' );

	wp_localize_script( 'tba_script', 'tba', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
