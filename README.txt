Mail wil be send automatically using system cron. Before use it, disable wp cron by adding following in wp-config.php

define('DISABLE_WP_CRON', true) ;

Then add below line inside crontab file and save it.

 * * * * *  wget -q -O - http://your_site_domain.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
This will schedule at every minute
