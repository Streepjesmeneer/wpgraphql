<?php

declare(strict_types=1);

namespace WPgraphql;
use \Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

if (!defined('WPG_PLUGIN_PATH')) {
    define('WPG_PLUGIN_PATH', __DIR__);
}

if (!defined('ROUTE_NAMESPACE')) {
    define('ROUTE_NAMESPACE', $_ENV['ROUTE_NAMESPACE'] ?? 'wpgraphql');
}

/**
 * @author  Kris van Hes <kris@socialbrothers.nl>
 *
 * @wordpress-plugin
 * Plugin Name:       WPGraphQL demo
 * Description:       Simple API request demo
 * Version:           0.0.1
 * Author:            Kris van Hes
 * Author URI:        streepjesmeneer.nl
 * Update URI:        false
 */

defined('ABSPATH') || exit('Forbidden');

/**
 * Check if WPGraphQL is active
 * otherwise return error
 */
register_activation_hook(__FILE__, function (): void {
    if (!is_plugin_active('wp-graphql/wp-graphql.php')) {
        _e('ERROR: Plugin WPGraphQL needs to be active to this plugin to work', 'WPG');
        die;
    }
});

/**
 * Registering routes for the API
 * This function registers custom API endpoints based on the configuration defined in config/endpoints.php file.
 */
// add_action('rest_api_init', function (): void {
add_action('init', function (): void {
    $endpoints = include_once __DIR__ . '/config/endpoints.php';
    foreach ($endpoints as $method => $endpoints) {
        foreach ($endpoints as $name => $callback) {
            register_rest_route(ROUTE_NAMESPACE, $name, [
                'methods'               => $method,
                'callback'              => sprintf('\WPgraphql\Handlers\RouteHandler::%s', $callback),
                'permission_callback'   => '__return_true'
            ]);
        }
    }
});
