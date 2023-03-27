<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mahesh-d.wisdmlabs.net
 * @since      1.0.0
 *
 * @package    Post_Details_Via_Mail
 * @subpackage Post_Details_Via_Mail/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Post_Details_Via_Mail
 * @subpackage Post_Details_Via_Mail/includes
 * @author     Mahesh Dubal <mahesh.dubal@wisdmlabs.com>
 */
class Post_Details_Via_Mail_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if (!wp_next_scheduled('my_daily_event')) {
			wp_schedule_event(time(), '1minute', 'my_daily_event');
		  }
		
	}

}
