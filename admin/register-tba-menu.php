<?php
/**
 * Registers the Menu
 *
 * @return void
 */
function register_tba_menu() {

	add_menu_page( 'TBA plugin Settings', 'TBA Settings', 'activate_plugins', 'tba-settings', 'display_tba_menu' );
	add_submenu_page( 'tba-settings', 'Approve Topics', 'Approve Topics', 'activate_plugins', 'approve-topics', 'display_approve_topics' );
}
