<?php

/**
 * @package           TBA
 * @author            Aman Khan
 * @license           GPL-2.0-or-later
 * Plugin Name:       Gamification Plugin for The Biggest Ask.
 * Plugin URI:        https://github.com/RayhanKhan8975/thebiggestask-gamification-plugin
 * Description:       The Plugins helps in adding Gamification to the existing BuddyPress and Gamipress Plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Aman Khan
 * Author URI:        https://github.com/RayhanKhan8975
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       TBA
 * Domain Path:       /languages
 */

if ( ! function_exists( 'add_action' ) ) {
	esc_html_e( 'Hi there!  I\'m just a plugin, not much I can do when called directly.', 'codeable' );
	exit;
}

/**
 *  Check if BuddyBoss and Gamipress are active
 */
$buddy_boss_exists = in_array( 'buddyboss-platform/bp-loader.php', get_option( 'active_plugins' ), true );
$gamipress_exists  = in_array( 'gamipress/gamipress.php', get_option( 'active_plugins' ), true );

require 'utilities/gamipress-buddyboss-not-activated.php';

if ( $buddy_boss_exists && $gamipress_exists ) {

	// Setup.
	DEFINE( 'TBA_PATH', __FILE__ );

	// Includes.
	require 'includes/activation.php';
	require 'process/topic-points-awarded.php';
	require 'process/tba-save-reply-meta.php';
	require 'shortcodes/display-like-button.php';
	require 'includes/enqueue.php';
	require 'frontend/forum-reply.php';
	require 'process/tba-like-reply.php';

	// Hooks.
	register_activation_hook( __FILE__, 'tba_plugin_activate' );
	add_action( 'save_post_topic', 'tba_topic_points_awarded', 10, 3 );
	add_action( 'user_register', 'tba_add_user_meta', 10, 1 );
	add_action( 'save_post_reply', 'tba_save_reply_meta', 10, 3 );
	add_action( 'wp_enqueue_scripts', 'tba_enqueue' );
	add_action( 'bbp_theme_after_reply_content', 'tba_add_like_button' );
	add_action( 'wp_ajax_tba_like_reply', 'tba_like_reply' );
	add_action( 'tba_run_weekly_jobs', 'tba_run_weekly_jobs' );

	// ShortCodes.
	add_shortcode( 'display_like_button', 'display_like_button' );



} else {

	add_action( 'admin_notices', 'gamipress_buddyboss_not_activated' );
}




