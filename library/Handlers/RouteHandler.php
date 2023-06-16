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
        $products = file_get_contents(WPP_PLUGIN_URI . '/config/products.json');

        return wp_send_json(json_decode($products));
    }
}
