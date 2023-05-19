<?php

declare(strict_types=1);

defined('ABSPATH') || exit('Forbidden');

// TODO: make this configurable
// TODO: return instead of variable
$router_namespace = 'wpgraphql';

$endpoints = [
    'GET' => [
        'products'  => 'get_products'
    ],
];
