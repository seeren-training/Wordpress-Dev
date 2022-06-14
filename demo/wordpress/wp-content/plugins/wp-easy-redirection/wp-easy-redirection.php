<?php

/**
 * Plugin Name: WP Easy Redirection
 * 
 * Requires PHP: 8.1
 * Version: 0.0.1
 * Text Domain: wp-easy-redirection
 * License: MIT
 */

use WpEasyRedirection\Controller\Admin\AdminController;

require __DIR__ . '/vendor/autoload.php';

define('WP_EASY_REDIRECTION_FILE', __FILE__);

if (is_admin()) {
    $controller = new AdminController();
    $controller->show();
}
