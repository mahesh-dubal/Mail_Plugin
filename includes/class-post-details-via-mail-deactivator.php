<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://mahesh-d.wisdmlabs.net
 * @since      1.0.0
 *
 * @package    Post_Details_Via_Mail
 * @subpackage Post_Details_Via_Mail/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Post_Details_Via_Mail
 * @subpackage Post_Details_Via_Mail/includes
 * @author     Mahesh Dubal <mahesh.dubal@wisdmlabs.com>
 */
class Post_Details_Via_Mail_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		wp_clear_scheduled_hook('my_daily_event');
	}
}
