<?php

declare(strict_types=1);

namespace WPgraphql;

require_once __DIR__ . '/vendor/autoload.php';

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
