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

$active_plugins = get_option( 'active_plugins' );

$buddy_boss_exists               = in_array( 'buddyboss-platform/bp-loader.php', $active_plugins, true );
$gamipress_exists                = in_array( 'gamipress/gamipress.php', $active_plugins, true );
$gamipress_bb_integration_exists = in_array( 'gamipress-buddyboss-integration/gamipress-buddyboss.php', $active_plugins, true );

require 'utilities/gamipress-buddyboss-not-activated.php';

if ( $buddy_boss_exists && $gamipress_exists && $gamipress_bb_integration_exists ) {

	// Setup.
	DEFINE( 'TBA_PATH', __FILE__ );

	// Includes.
	require 'includes/activation.php';
	require 'process/tba-save-reply-meta.php';
	require 'shortcodes/display-like-button.php';
	require 'process/tba-add-user-meta.php';
	require 'includes/enqueue.php';
	require 'frontend/forum-reply.php';
	require 'process/tba-like-reply.php';
	require 'utilities/tba-add-post-meta.php';
	require 'utilities/add-badges-and-ranks.php';
	require 'wp-cron-jobs/tba-run-hourly-jobs.php';
	require 'wp-cron-jobs/tba-run-weekly-jobs.php';
	require 'admin/columns.php';
	require 'shortcodes/display-leaderboards.php';
	require 'utilities/set-options.php';
	require 'admin/register-tba-menu.php';
	require 'admin/display-approve-topics.php';
	require 'admin/display-tba-menu.php';
	require 'process/tba-set-topics-for-approval.php';
	require 'admin/tba-admin-enqueue.php';
	require 'process/tba-approve-topic.php';
	require 'process/send-tba-settings.php';
	require 'process/tba-redirect-user.php';

	// Hooks.
	register_activation_hook( __FILE__, 'tba_plugin_activate' );
	add_action( 'save_post_topic', 'tba_set_topics_for_approval', 10, 3 );
	add_action( 'user_register', 'tba_add_user_meta', 10, 2 );
	add_action( 'save_post_reply', 'tba_save_reply_meta', 10, 3 );
	add_action( 'wp_enqueue_scripts', 'tba_enqueue' );
	add_action( 'bbp_theme_after_reply_content', 'tba_add_like_button' );
	add_action( 'wp_ajax_tba_like_reply', 'tba_like_reply' );
	add_action( 'wp_ajax_send_tba_settings', 'send_tba_settings' );
	add_action( 'tba_run_weekly_jobs', 'tba_run_weekly_jobs' );
	add_action( 'tba_run_hourly_jobs', 'tba_run_hourly_jobs' );
	// add_action( 'wp_login', 'tba_redirect_user', 10, 2 );
	add_filter( 'manage_users_columns', 'tba_add_points_column' );
	add_filter( 'manage_users_custom_column', 'tba_add_points_column_data', 10, 3 );
	add_filter(
		'wp_mail_content_type',
		function( $content_type ) {
			return 'text/html';
		}
	);
	add_filter( 'login_redirect', 'tba_redirect_user', 10, 3 );
	add_action( 'admin_menu', 'register_tba_menu' );
	add_action( 'admin_enqueue_scripts', 'tba_admin_enqueue' );
	add_action( 'wp_ajax_tba_approve_topic', 'tba_approve_topic' );
	// ShortCodes.
		add_shortcode( 'display_like_button', 'display_like_button' );
		add_shortcode( 'display_leaderboards', 'display_leaderboards' );

} else {

	add_action( 'admin_notices', 'gamipress_buddyboss_not_activated' );
}
