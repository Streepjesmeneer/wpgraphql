<?php

declare(strict_types=1);

namespace ProductAPI;
use \Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

if (!defined('WPP_PLUGIN_URI')) {
    define('WPP_PLUGIN_URI', __DIR__);
}

if(!defined('WPP_PLUGIN_PATH')) {
    define('WPP_PLUGIN_PATH', plugin_dir_url(__FILE__));
}

if (!defined('ROUTE_NAMESPACE')) {
    define('ROUTE_NAMESPACE', $_ENV['ROUTE_NAMESPACE'] ?? 'productapi');
}

/**
 * @author  Kris van Hes <kris@socialbrothers.nl>
 *
 * @wordpress-plugin
 * Plugin Name:       ProductAPI
 * Description:       Simple API request demo
 * Version:           0.0.1
 * Author:            Kris van Hes
 * Author URI:        streepjesmeneer.nl
 * Update URI:        false
 */

defined('ABSPATH') || exit('Forbidden');

/**
 * Registering routes for the API
 * This function registers custom API endpoints based on the configuration defined in config/endpoints.php file.
 */

add_action('rest_api_init', function (): void {
    $endpoints = include_once __DIR__ . '/config/endpoints.php';
    foreach ($endpoints as $method => $endpoints) {
        foreach ($endpoints as $name => $callback) {
            register_rest_route(ROUTE_NAMESPACE, $name, [
                'methods'               => $method,
                'callback'              => sprintf('\ProductAPI\Handlers\RouteHandler::%s', $callback),
                'permission_callback'   => '__return_true'
            ]);
        }
    }
}, 10, 0);

add_action('wp_enqueue_scripts', function(): void {
	wp_enqueue_script( 'productapi', sprintf('%s/dist/assets/main.js', WPP_PLUGIN_PATH), [], (string) time());
});
