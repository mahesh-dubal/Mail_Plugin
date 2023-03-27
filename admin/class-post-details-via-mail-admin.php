<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mahesh-d.wisdmlabs.net
 * @since      1.0.0
 *
 * @package    Post_Details_Via_Mail
 * @subpackage Post_Details_Via_Mail/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Post_Details_Via_Mail
 * @subpackage Post_Details_Via_Mail/admin
 * @author     Mahesh Dubal <mahesh.dubal@wisdmlabs.com>
 */
class Post_Details_Via_Mail_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Details_Via_Mail_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Details_Via_Mail_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/post-details-via-mail-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Details_Via_Mail_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Details_Via_Mail_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/post-details-via-mail-admin.js', array('jquery'), $this->version, false);
	}
	function custom_cron_schedules($schedules)
	{
		if (!isset($schedules['1minute'])) {
			$schedules['1minute'] = array(
				'interval' => 60,
				'display' => __('Once every minute')
			);
		}

		return $schedules;
	}
	//To send daily post details
	public function send_daily_post_details()
	{

		$to = get_option('admin_email');
		$subject = 'Daily Post Details';
		$post_details = "m";//get_daily_post_details();
		$message = '';

		// foreach ($post_details as $post_data) {
		// 	$message .= 'Post Title: ' . $post_data['post_title'] . "\n";
		// 	$message .= 'Post URL: ' . $post_data['post_url'] . "\n";
		// 	$message .= 'Meta Title: ' . $post_data['meta_title'] . "\n";
		// 	$message .= 'Meta Description: ' . $post_data['meta_description'] . "\n";
		// 	$message .= 'Meta Keywords: ' . $post_data['meta_keywords'] . "\n";
		// 	$message .= 'Page Speed Score: ' . $post_data['page_speed'] . " seconds \n";
		// 	$message .= "\n";
		// }
		$headers = array(
			'From: mahesh.dubal@wisdmlabs.com',
		);

		wp_mail($to, $subject, $message, $headers);
	}

	//To get google page speed score
	function get_page_speed_score($url)
	{

		$api_key = "416ca0ef-63e4-4caa-a047-ead672ecc874"; // Google Cloud Platform API key
		$result_url = "http://www.webpagetest.org/runtest.php?url=" . $url . "&runs=1&f=xml&k=" . $api_key;
		$run_result = simplexml_load_file($result_url);
		$test_id = $run_result->data->testId;

		$status_code = 100;

		while ($status_code != 200) {
			sleep(10);
			$xml_result = "http://www.webpagetest.org/xmlResult/" . $test_id . "/";
			$result = simplexml_load_file($xml_result);
			$status_code = $result->statusCode;
			$page_speed_score = (float) ($result->data->median->firstView->loadTime) / 1000;
		}


		return $page_speed_score;
	}


	//To get details of all posts published on a day
	function get_daily_post_details()
	{

		$args = array(
			'date_query' => array(
				array(
					'after' => '24 hours ago',
				),
			),
		);

		$query = new WP_Query($args);
		$posts = $query->posts;
		$post_details = array();

		foreach ($posts as $post) {

			$meta_title_of_post = get_post_meta($post->ID, '_yoast_wpseo_title', true);
			if (empty($meta_description)) {
				$meta_title_of_post = "No Meta title found";
			}

			$meta_description = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
			if (empty($meta_description)) {
				$meta_description = "No meta description available";
			}

			$meta_keywords = get_post_meta($post->ID, '_yoast_wpseo_focuskw', true);
			if (empty($meta_keywords)) {
				$meta_keywords = "No meta keywords available";
			}


			$post_data = array(
				'post_title' => $post->post_title,
				'post_url' => get_permalink($post->ID),
				'meta_title' => $meta_title_of_post,
				'meta_description' => $meta_description,
				'meta_keywords' => $meta_keywords,
				'page_speed' => 1,//get_page_speed_score(get_permalink($post->ID)),
			);
			array_push($post_details, $post_data);
		}

		return $post_details;
	}
}
