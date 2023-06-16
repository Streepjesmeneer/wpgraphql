<?php

declare(strict_types=1);

namespace ProductAPI\Handlers;

class RouteHandler
{
    /**
     * DEMO ROUTE
     * Method: GET
     * Endpoint: /products
     */
    public static function get_products()
    {
        $products = file_get_contents(WPG_PLUGIN_PATH . '/demo/products.json');

        return wp_send_json(json_decode($products));
    }
}
