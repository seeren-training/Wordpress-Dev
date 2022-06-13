<?php

/**
 * Plugin Name: WP Easy Redirection
 * 
 * Requires PHP: 8.1
 * Version: 0.0.1
 * Text Domain: wp-easy-redirection
 * License: MIT
 */

use WpEasyRedirection\Admin\AdminController;

require __DIR__ . '/vendor/autoload.php';

if (is_admin()) {
    $controller = new AdminController();
    $controller->show(__FILE__);
}